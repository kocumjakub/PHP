<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Request;

use Csag\Bundle\AnsCoreBundle\Client\Request\StoreReservation\CreateStoreReservationRequest;
use Csag\Bundle\AnsCoreBundle\Client\Request\StoreReservation\ReservationPartial\ReservationAddress;
use Csag\Bundle\AnsCoreBundle\Client\Request\StoreReservation\ReservationPartial\ReservationDeliveryAddress;
use Csag\Bundle\AnsCoreBundle\Client\Request\StoreReservation\ReservationPartial\ReservationInvoiceAddress;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class RequestSerializer
{
    public function __construct(
        private NormalizerInterface $normalizer,
    ) {
    }

    /**
     * @return mixed[]
     * @throws ExceptionInterface
     */
    public function serializeRequest(object $request): array
    {
        $normalized = $this->normalizer->normalize($request);
        if (is_array($normalized) === false) {
            return [];
        }

        if ($request instanceof CreateStoreReservationRequest) {
            $this->serializedNameCreateReservationAddress($request, $normalized);
        }

        return $normalized;
    }

    /**
     * @param mixed[] $normalized
     */
    private function serializedNameCreateReservationAddress(CreateStoreReservationRequest $request, array &$normalized): void
    {
        $address = $request->getAddress();

        if (isset($normalized['address'])) {
            $addressData = $normalized['address'];
            unset($normalized['address']);

            if ($address instanceof ReservationDeliveryAddress) {
                $normalized[ReservationDeliveryAddress::NAME] = $addressData;
            } elseif ($address instanceof ReservationInvoiceAddress) {
                $normalized[ReservationInvoiceAddress::NAME] = $addressData;
            } else {
                $normalized[ReservationAddress::NAME] = $addressData;
            }
        }
    }
}
