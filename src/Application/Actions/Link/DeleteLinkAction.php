<?php

declare(strict_types=1);

namespace App\Application\Actions\Link;

use App\Domain\Link\Link;
use Psr\Http\Message\ResponseInterface as Response;

class DeleteLinkAction extends LinkAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $id = (int)$this->resolveArg('id');
        if ($this->linkRepository->delete($id)) return $this->respondWithData(['message' => 'delete success']);
        return $this->respondWithData(['message' => 'not found link']);
    }
}
