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
        $response = new Success(200, $users);
        $response->json();
    }

    public static function findUser($vars) {
        try {
            $user = User::findOrFail($vars['id'])->toArray();
            $response = new Success(data: $user);
        } catch (\Exception $e) {
            $response = new Error(404, $e,'Пользователь не найден');
        }
        $response->json();
    }

    public static function register() {
        try {
            //dump($_POST);
            $login = $_POST['login'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = User::create(["login"=> $login, "email" => $email, "password" => $password])->toArray();
            //dump($user);
            $response = new Success(data: $user);
        } catch (\PDOException $error) {
            $response = new Error(500, $error, message: 'user already exists');
        }
        $response->json();
    }

}