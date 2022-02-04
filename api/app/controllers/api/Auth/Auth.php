<?php


namespace Controllers\Api\Auth;
use Illuminate\Database\Eloquent\Collection;
use Models\User;
use Services\Response;

// require_once "app/utils/dump.php";

class Auth
{

    public static function login(): void {
        echo 'you are signed in';
    }

    public static function showUsers(): void {
        $users = self::getUsers();
        new Response(200, data: $users);
    }

    public static function findUser($vars) {
        $user = self::getUser($vars['id']);
        if (!is_null($user)) {
            new Response(data: $user);
        } else {
            new Response(404, message: 'user not found');
        }
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
                    $user = self::createUser($login, $email, $password);
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

    public static function createUser(string $login, string $email, string $password) : array {
        return User::create(["login"=> $login, "email" => $email, "password" => $password])->toArray();
    }

    public static function getUsers() : array {
        return User::all()->toArray();
    }
    public static function getUser($id): array|null {
        $user = User::find($id);
        if (!is_null($user)) {
            return $user->toArray();
        }else {
            return null;
        }
    }
}