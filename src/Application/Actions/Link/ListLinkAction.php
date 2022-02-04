<?php

declare(strict_types=1);

namespace App\Application\Actions\Link;

use App\Domain\Link\Link;
use Psr\Http\Message\ResponseInterface as Response;

class ListLinkAction extends LinkAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        return $this->respondWithData([$this->linkRepository->findAll()]);
    }
}
