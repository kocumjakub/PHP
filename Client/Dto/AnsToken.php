<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Dto;

use Symfony\Component\Serializer\Attribute\SerializedName;

readonly class AnsToken
{
    public function __construct(
        private string $token,
        #[SerializedName('validTo')]
        private string $validTo,
        private string $type,
        #[SerializedName('userName')]
        private string $userName,
    ) {
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function redisTimeToLive(): false|int
    {
        return (strtotime($this->validTo) !== false ? strtotime($this->validTo) : time()) - time();
    }

    public function getValidTo(): string
    {
        return $this->validTo;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }
}
