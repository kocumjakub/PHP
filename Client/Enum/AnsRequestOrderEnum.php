<?php

declare(strict_types=1);

namespace Csag\Bundle\AnsCoreBundle\Client\Enum;

enum AnsRequestOrderEnum: string
{
    case ASCENDING = 'asc';

    case DESCENDING = 'desc';
}
