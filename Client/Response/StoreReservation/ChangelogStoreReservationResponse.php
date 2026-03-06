<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Response\StoreReservation;

use Symfony\Component\Serializer\Attribute\SerializedName;

readonly class ChangelogStoreReservationResponse
{
    /**
     * @param array<int,ChangelogStoreReservationResponseItem> $changelogItems
     */
    public function __construct(
        /**
         * @param array<int,ChangelogStoreReservationResponseItem> $changelogItems
         */
        #[SerializedName('data')]
        private array $changelogItems,
    ) {
    }

    /**
     * @return ChangelogStoreReservationResponseItem[]
     */
    public function getChangelogItems(): array
    {
        return $this->changelogItems;
    }
}
