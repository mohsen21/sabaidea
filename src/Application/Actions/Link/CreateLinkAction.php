<?php

declare(strict_types=1);

namespace App\Application\Actions\Link;

use App\Domain\Link\Link;
use Psr\Http\Message\ResponseInterface as Response;

class CreateLinkAction extends LinkAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $form = $this->getFormData();
        if (!isset($form['tag']) || !isset($form['link'])) {
            return $this->respondWithData(['message' => 'tag and link required'], 400);
        }
        if (trim($form['tag']) !== '' && trim($form['link']) !== '') {
            if ($this->linkRepository->add(new Link($form['tag'], $form['link']))) {
                return $this->respondWithData(['message' => 'success']);
            }
        }
        return $this->respondWithData(['message' => 'tag not uniqe']);
    }
}
