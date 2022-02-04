<?php

declare(strict_types=1);

use App\Domain\Link\LinkRepository;
use App\Domain\User\UserRepository;
use App\Infrastructure\Persistence\Link\AppLinkRepository;
use App\Infrastructure\Persistence\User\AppUserRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        UserRepository::class => \DI\autowire(AppUserRepository::class),
        LinkRepository::class => \DI\autowire(AppLinkRepository::class),
    ]);
};
