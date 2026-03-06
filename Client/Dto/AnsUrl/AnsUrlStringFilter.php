<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Dto\AnsUrl;

readonly class AnsUrlStringFilter
{
    public function __construct(
        private string $filter,
    ) {
    }

    public function getFilter(): string
    {
        return $this->filter;
    }
}
