<?php

namespace App\Enum;

enum StatusEnum : string 
{
    case AVAIABLE = 'available';

    case TEMPORARILY_UNAVAILABLE = 'temporarily_unavailable';
    
    case TERMINATED = 'terminated';

    case CLOSED = 'closed';
}