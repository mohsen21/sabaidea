<?php

declare(strict_types=1);

namespace App\Application\Actions\Link;

use Psr\Http\Message\ResponseInterface as Response;

class ViewLinkAction extends LinkAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $link = $this->resolveArg('link');
        if (trim($link) === '') {
            return $this->respondWithData(['message' => 'link not found'], 404);
        }
        $linkObj = $this->linkRepository->findLinkByTag($link);
        var_dump($linkObj);
        exit();

        return $this->respondWithData(['']);
    }
}
