<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
//    $app->options('/{routes:.*}', function (Request $request, Response $response) {
//        // CORS Pre-Flight OPTIONS Request Handler
//        return $response;
//    });
    $app->group('/link', function (Group $group) {
        $group->get('/{link}', \App\Application\Actions\Link\ViewLinkAction::class);
    });
    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->post('/login', \App\Application\Actions\User\LoginUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });
    $app->get('/db', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);
        $sth = $db->prepare("SELECT * FROM users ");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        $payload = json_encode($data);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    });
};
