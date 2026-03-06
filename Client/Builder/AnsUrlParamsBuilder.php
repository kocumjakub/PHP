<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Builder;

use Csag\Bundle\AnsCoreBundle\Client\Dto\AnsUrl\AnsUrlExpand;
use Csag\Bundle\AnsCoreBundle\Client\Dto\AnsUrl\AnsUrlFilter;
use Csag\Bundle\AnsCoreBundle\Client\Dto\AnsUrl\AnsUrlStringFilter;
use Csag\Bundle\AnsCoreBundle\Client\Dto\AnsUrl\AnsUrlParams;

class AnsUrlParamsBuilder
{
    public function __construct(
        /** @var array<int,AnsUrlFilter> $filters */
        private array $filters = [],
        /** @var array<int,AnsUrlStringFilter> $stringFilters */
        private array $stringFilters = [],
        /** @var array<int,AnsUrlExpand> $expand */
        private array $expand = [],
        private ?string $order = null,
        private int $take = 0,
        private int $skip = 0,
    ) {
    }

    public function addFilter(AnsUrlFilter $filter): self
    {
        $this->filters[] = $filter;

        return $this;
    }

    public function addStringFilter(AnsUrlStringFilter $stringFilter): self
    {
        $this->stringFilters[] = $stringFilter;

        return $this;
    }

    public function addExpand(AnsUrlExpand $expand): self
    {
        $this->expand[] = $expand;

        return $this;
    }

    public function setOrder(string $order): self
    {
        $this->order = $order;

        return $this;
    }

    public function setTake(int $take): self
    {
        $this->take = $take;

        return $this;
    }

    public function setSkip(int $skip): self
    {
        $this->skip = $skip;

        return $this;
    }

    public function build(): AnsUrlParams
    {
        return new AnsUrlParams(
            filters: $this->filters,
            stringFilters: $this->stringFilters,
            expand: $this->expand,
            order: $this->order,
            take: $this->take,
            skip: $this->skip,
        );
    }
}
