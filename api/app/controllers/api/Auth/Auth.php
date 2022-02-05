<?php


namespace Controllers\Api\Auth;
use Illuminate\Database\Eloquent;
use Models\User;
use Services\responses\Success;
use Services\responses\Error;

// require_once "app/utils/dump.php";

class Auth
{

    public static function login(): void {
        echo 'you are signed in';
    }

    public static function showUsers(): void {
        $users = User::all()->toArray();
        Success::json(data: $users);
    }

    public static function findUser($vars) {
        try {
            $user = User::findOrFail($vars['id'])->toArray();
            Success::json(data: $user);
        } catch (\Exception $e) {
            Error::json(404, message: 'Пользователь не найден');
        }
    }

    public static function register() {
        try {
            //dump($_POST);
            $login = $_POST['login'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = User::create(["login"=> $login, "email" => $email, "password" => $password])->toArray();
            //dump($user);
            Success::json(data: $user);
        } catch (\PDOException $error) {
            Error::json(422, message: 'Пользователь уже существует');
        }
    }

}