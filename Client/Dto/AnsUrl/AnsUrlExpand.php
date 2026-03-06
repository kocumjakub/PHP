<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Dto\AnsUrl;

readonly class AnsUrlExpand
{
    public function __construct(
        private string $expandValueName,
    ) {
    }

    public function getExpandValueName(): string
    {
        return $this->expandValueName;
    }
}
