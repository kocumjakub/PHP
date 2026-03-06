<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Authentication;

use Csag\Bundle\AnsCoreBundle\Client\Dto\AnsToken;
use Csag\Bundle\AnsCoreBundle\Client\Exception\AbstractAnsException;

class TokenAuthenticator
{
    private AnsToken $ansTokenDto;

    public function __construct(
        private readonly TokenManager $tokenManager,
    ) {
    }

    /**
     * @throws AbstractAnsException
     */
    public function authenticate(): void
    {
        $this->ansTokenDto = $this->tokenManager->getToken();
    }

    /**
     * @return array<string,string>
     */
    public function getAuthenticateHeader(): array
    {
        return [
            'Content-type' => 'application/json',
            'accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->ansTokenDto->getToken(),
        ];
    }
}
