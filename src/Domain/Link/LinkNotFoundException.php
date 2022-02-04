<?php

declare(strict_types=1);

namespace App\Domain\Link;

use App\Domain\DomainException\DomainRecordNotFoundException;

class LinkNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The Link you requested does not exist.';
}
