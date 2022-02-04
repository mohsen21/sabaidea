<?php

declare(strict_types=1);

namespace App\Application\Actions\Link;

use App\Application\Actions\Action;
use App\Domain\Link\LinkRepository;
use Psr\Log\LoggerInterface;

abstract class LinkAction extends Action
{
    protected LinkRepository $linkRepository;

    public function __construct(LoggerInterface $logger, LinkRepository $linkRepository)
    {
        parent::__construct($logger);
        $this->linkRepository = $linkRepository;
    }
}
