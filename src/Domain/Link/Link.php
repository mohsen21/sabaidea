<?php

declare(strict_types=1);

namespace App\Domain\Link;

use JsonSerializable;

class Link implements JsonSerializable
{


    private string $tag;
    private string $link;


    /**
     * User constructor.
     * @param string $tag
     * @param string $link
     */
    public function __construct(string $tag, string $link = 'admin')
    {
        $this->tag = $tag;
        $this->link = $link;
    }


    public function getTag(): string
    {
        return $this->tag;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'tag' => $this->tag,
            'link' => $this->link,
        ];
    }
}
