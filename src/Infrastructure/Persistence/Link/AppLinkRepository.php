<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Link;

use App\Domain\Link\Link;
use App\Domain\Link\LinkNotFoundException;
use App\Domain\Link\LinkRepository;
use PDO;


class AppLinkRepository implements LinkRepository
{
    /**
     * @var Link[]
     */
    private array $links;
    private $db;

    /**
     * @param Link[]|null $links
     * @param PDO $db
     */
    public function __construct(array $links = null, PDO $db)
    {
        $this->db = $db;
        $this->links = $links ?? [
                1 => new Link('tag', 'link'),
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        $sth = $this->db->prepare("SELECT * FROM links ");
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * {@inheritdoc}
     */
    public function findLinkOfId(int $id): Link
    {

        $sth = $this->db->prepare("SELECT * FROM links  WHERE id=?");
        $sth->execute([$id]);
        $data = $sth->fetch();

        if ($data) {
            return new Link($data['tag'], $data['link']);
        }
        throw new LinkNotFoundException();
    }


    public function findLinkByTag(string $tag): Link
    {
        $sth = $this->db->prepare("SELECT * FROM links  WHERE `tag`=?");
        $sth->execute([$tag]);
        $data = $sth->fetch();

        if ($data) {
            return new Link($data['tag'], $data['link']);
        }
        throw new LinkNotFoundException();
    }

    public function add(Link $link)
    {
        try {
            $st = $this->db->prepare("insert into links set  tag = :tag,  link = :link");
            return $st->execute(array(
                ':tag' => $link->getTag(),
                ':link' => $link->getLink()
            ));

        } catch (\Exception $e) {
            return false;
        }
    }

    public function delete(int $id)
    {
        try {
            if (!$this->findLinkOfId($id)) return false;
            $sth = $this->db->prepare("Delete  FROM links  WHERE `id`=?");
            return $sth->execute([$id]);


        } catch (\Exception $e) {
            return false;
        }
    }
}
