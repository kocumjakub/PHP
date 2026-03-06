<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Enum;

enum AnsRequestMethod: string
{
    case GET = 'GET';

    case POST = 'POST';

    case DELETE = 'DELETE';

    case PATCH = 'PATCH';
}
