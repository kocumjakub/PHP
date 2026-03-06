<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Dto\AnsUrl;

readonly class AnsUrlFilter
{
    public function __construct(
        private string $attribute,
        private string $condition,
        private string $filter,
    ) {
    }

    public function getAttribute(): string
    {
        return $this->attribute;
    }

    public function getCondition(): string
    {
        return $this->condition;
    }

    public function getFilter(): string
    {
        return $this->filter;
    }
}
