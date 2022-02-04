<?php

declare(strict_types=1);

namespace App\Domain\Link;

interface LinkRepository
{
    /**
     * @return Link[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Link
     * @throws LinkNotFoundException
     */
    public function findLinkOfId(int $id): Link;

    /**
     * @param string $tag
     * @return Link
     * @throws LinkNotFoundException
     */
    public function findLinkByTag(string $tag): Link;
}
