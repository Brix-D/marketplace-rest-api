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
        new Success(200, $users);
    }

    public static function findUser($vars) {
        try {
            $user = User::findOrFail($vars['id'])->toArray();
            new Success(data: $user);
        } catch (\Exception $e) {
            new Error(404, $e,'Пользователь не найден');
        }
    }

    public static function register() {
        //dump($_SERVER['REQUEST_METHOD']);
        try {
            //dump($_POST);
            $login = $_POST['login'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = User::create(["login"=> $login, "email" => $email, "password" => $password])->toArray();
            //echo 'you are signed up';
            //dump($user);
            new Success(data: $user);
        } catch (\PDOException $error) {
            new Error(500, $error, message: 'user already exists');
        }
    }

//    public static function createUser(string $login, string $email, string $password) : array {
//        return User::create(["login"=> $login, "email" => $email, "password" => $password])->toArray();
//    }

//    public static function getUsers() : array {
//        return User::all()->toArray();
//    }

//    /**
//     * @throws \Exception
//     */
//    public static function getUser($id): array {
//        try {
//            $user = User::findOrFail($id);
//            return $user->toArray();
//        } catch (\Exception $e) {
//            throw $e;
//        }
//    }
}