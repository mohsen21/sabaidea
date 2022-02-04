<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use Psr\Http\Message\ResponseInterface as Response;
use ReallySimpleJWT\Token;

class LoginUsersAction extends UserAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        // jwt setting
        $secret = 'sec!ReT423*&';
        $expiration = time() + 3600;
        $issuer = 'localhost';


        $form = $this->getFormData();
        if (!isset($form['user_name']) || !isset($form['password']) && trim($form['user_name']) != "") {
            $message = 'The user you requested does not exist.';
            return $this->respondWithData($message, 404);
        }

        $user = $this->userRepository->findUserByUsername($form['user_name']);
        $pass = $user->getPassword();
        if (!password_verify($form['password'], $pass)) {
            $message = 'The user Or Password incorrect.';
            return $this->respondWithData($message, 401);
        }
        $userId = $user->getId();


        $token = Token::create($userId, $secret, $expiration, $issuer);


        $this->logger->info("Users list was viewed.");

        return $this->respondWithData([
            'token' => $token,
            'user' => $user
        ]);
    }
}
