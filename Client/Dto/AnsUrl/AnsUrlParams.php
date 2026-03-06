<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Dto\AnsUrl;

readonly class AnsUrlParams
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

    /**
     * @return array<int,AnsUrlFilter>
     */
    public function getFilters(): array
    {
        return $this->filters;
    }

    /**
     * @return array<int,AnsUrlStringFilter>
     */
    public function getStringFilters(): array
    {
        return $this->stringFilters;
    }

    /**
     * @return array<int,AnsUrlExpand>
     */
    public function getExpand(): array
    {
        return $this->expand;
    }

    public function getOrder(): ?string
    {
        return $this->order;
    }

    public function getTake(): int
    {
        return $this->take;
    }

    public function getSkip(): int
    {
        return $this->skip;
    }
}
