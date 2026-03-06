<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Utils;

use Csag\Bundle\AnsCoreBundle\Client\Dto\AnsUrl\AnsUrlExpand;
use Csag\Bundle\AnsCoreBundle\Client\Dto\AnsUrl\AnsUrlFilter;
use Csag\Bundle\AnsCoreBundle\Client\Dto\AnsUrl\AnsUrlStringFilter;
use Csag\Bundle\AnsCoreBundle\Client\Dto\AnsUrl\AnsUrlParams;

class AnsUrlCreator
{
    public function createUrlEndpoint(string $endpoint, ?AnsUrlParams $params): string
    {
        if ($params === null) {
            return $endpoint;
        }

        $urlQueryParams = '';
        $urlQuerySeparator = '?';

        if ($params->getFilters() !== []) {
            $urlQueryParams = sprintf(
                '%s%sfilter=%s',
                $urlQueryParams,
                $urlQuerySeparator,
                implode(
                    '+and+',
                    array_map(
                        function (AnsUrlFilter $filter): string {
                            if (str_contains($filter->getFilter(), 'DateTime') === true) {
                                return urlencode(sprintf('%s %s %s', $filter->getAttribute(), $filter->getCondition(), $filter->getFilter()));
                            }

                            return urlencode(sprintf('%s %s "%s"', $filter->getAttribute(), $filter->getCondition(), $filter->getFilter()));
                        },
                        $params->getFilters()
                    )
                )
            );
        }

        if ($params->getStringFilters() !== []) {
            if ($urlQueryParams !== '') {
                $urlQuerySeparator = '+and+';
            } else {
                $urlQuerySeparator = '?filter=';
            }
            $urlQueryParams = sprintf(
                '%s%s%s',
                $urlQueryParams,
                $urlQuerySeparator,
                implode(
                    '+and+',
                    array_map(
                        function (AnsUrlStringFilter $stringFilter): string {
                            return urlencode($stringFilter->getFilter());
                        },
                        $params->getStringFilters()
                    )
                )
            );
        }

        if ($params->getExpand() !== []) {
            if ($urlQueryParams !== '') {
                $urlQuerySeparator = '&';
            }

            $urlQueryParams = sprintf(
                '%s%sexpand=%s',
                $urlQueryParams,
                $urlQuerySeparator,
                implode(
                    '+AND+',
                    array_map(
                        function (AnsUrlExpand $expand): string {
                            return $expand->getExpandValueName();
                        },
                        $params->getExpand()
                    )
                )
            );
        }

        if ($params->getOrder() !== null) {
            if ($urlQueryParams !== '') {
                $urlQuerySeparator = '&';
            }

            $urlQueryParams = sprintf('%s%sorder=%s', $urlQueryParams, $urlQuerySeparator, $params->getOrder());
        }

        if ($params->getTake() !== 0) {
            $urlQueryParams = sprintf('%s&take=%s', $urlQueryParams, $params->getTake());
        }

        if ($params->getSkip() !== 0) {
            $urlQueryParams = sprintf('%s&skip=%s', $urlQueryParams, $params->getSkip());
        }

        return sprintf('%s%s', $endpoint, $urlQueryParams);
    }
}
