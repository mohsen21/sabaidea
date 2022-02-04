<?php

declare(strict_types=1);

namespace Tests\Infrastructure\Persistence\User;

use App\Domain\User\Link;
use App\Domain\User\UserNotFoundException;
use App\Infrastructure\Persistence\User\AppLinkRepository;
use Tests\TestCase;

class InMemoryUserRepositoryTest extends TestCase
{
    public function testFindAll()
    {
        $user = new Link(1, 'bill.gates', 'Bill', 'Gates');

        $userRepository = new AppLinkRepository([1 => $user]);

        $this->assertEquals([$user], $userRepository->findAll());
    }

    public function testFindAllUsersByDefault()
    {
        $users = [
            1 => new Link(1, 'bill.gates', 'Bill', 'Gates'),
            2 => new Link(2, 'steve.jobs', 'Steve', 'Jobs'),
            3 => new Link(3, 'mark.zuckerberg', 'Mark', 'Zuckerberg'),
            4 => new Link(4, 'evan.spiegel', 'Evan', 'Spiegel'),
            5 => new Link(5, 'jack.dorsey', 'Jack', 'Dorsey'),
        ];

        $userRepository = new AppLinkRepository();

        $this->assertEquals(array_values($users), $userRepository->findAll());
    }

    public function testFindUserOfId()
    {
        $user = new Link(1, 'bill.gates', 'Bill', 'Gates');

        $userRepository = new AppLinkRepository([1 => $user]);

        $this->assertEquals($user, $userRepository->findUserOfId(1));
    }

    public function testFindUserOfIdThrowsNotFoundException()
    {
        $userRepository = new AppLinkRepository([]);
        $this->expectException(UserNotFoundException::class);
        $userRepository->findUserOfId(1);
    }
}
