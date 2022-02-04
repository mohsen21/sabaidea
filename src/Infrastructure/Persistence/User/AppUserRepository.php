<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use PDO;
use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserRepository;

class AppUserRepository implements UserRepository
{
    /**
     * @var User[]
     */
    private array $users;
    private $db;

    /**
     * @param User[]|null $users
     * @param PDO $db
     */
    public function __construct(array $users = null, PDO $db)
    {
        $this->db = $db;
        $this->users = $users ?? [
                1 => new User('587fdba1-67a2-4e44-893c-56766874ff4b', 'admin', password_hash('admin', PASSWORD_DEFAULT)),
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        $sth = $this->db->prepare("SELECT * FROM users ");
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * {@inheritdoc}
     */
    public function findUserOfId(string $id): User
    {

        $sth = $this->db->prepare("SELECT * FROM users  WHERE id=?");
        $sth->execute([$id]);
        $data = $sth->fetch();

        if ($data) {
            return new User($data['id'], $data['username']);
        }
        throw new UserNotFoundException();
    }


    public function findUserByUsername(string $username): User
    {
        $sth = $this->db->prepare("SELECT * FROM users  WHERE `username`=?");
        $sth->execute([$username]);
        $data = $sth->fetch();

        if ($data) {
            return new User($data['id'], $data['username']);
        }
        throw new UserNotFoundException();
    }
}
