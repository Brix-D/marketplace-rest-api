<?php


namespace Controllers\Api\Auth;
use Illuminate\Database\Eloquent\Collection;
use Models\User;
use Services\Response;

require_once "app/utils/dump.php";

class Auth
{

    public static function login() {
        echo 'you are signed in';
    }

    public static function show() {
        $users = self::showUsers()->toArray();
        new Response(200, data: $users);
    }

    public static function register() {
        //dump($_SERVER['REQUEST_METHOD']);
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST': {
                try {
                    //dump($_POST);
                    $login = $_POST['login'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $user = self::createUser($login, $email, $password)->toArray();
                    //echo 'you are signed up';
                    //dump($user);
                    new Response(data: $user);
                } catch (\PDOException $error) {
                    new Response(500, message: 'user already exists' . $error->getMessage());
                }
                break;
            }
            default: {
                new Response(404, message: 'Page not found');
            }
        }

    }

    public static function createUser(string $login, string $email, string $password) : User {
        return User::create(["login"=> $login, "email" => $email, "password" => $password]);
    }

    public static function showUsers() : Collection {
        return User::all();
    }
}