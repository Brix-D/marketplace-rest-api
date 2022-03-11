<?php


namespace Controllers\Api\Promo;
use Illuminate\Database\Eloquent;
use Models\Promo;
use Services\responses\Success;
use Services\responses\Error;

require_once "app/utils/dump.php";

class PromoController {

    public static function allPromos(): void {
        $promos = Promo::all()->toArray();
        Success::json(data: $promos);
    }

    public static function addPromo(): void {
        $data = !empty($_POST) ? $_POST : json_decode(file_get_contents("php://input"), true);
        $description = isset($data['description']) ? $data['description'] : null;
        $promo = new Promo;
        $promo->name = $data['name'];
        $promo->description = $description;
        $promo->save();
        Success::json(data: $promo->id);
    }

    public static function showPromo($vars): void {
        $promo = Promo::find($vars['id']);
        $participants = $promo->participants;
        $prizes = $promo->prizes;
        $response = $promo->toArray();
        $response['prizes'] = $prizes->toArray();
        $response['participants'] = $participants->toArray();
        Success::json(data: $response);
    }

    public static function editPromo($vars): void {
        $data = json_decode(file_get_contents("php://input"), true);
        $promo = Promo::find($vars['id']);
        $name = isset($data['name']) ? $data['name'] : null;
        $description = isset($data['description']) ? $data['description'] : null;
        try {
            $promo->name = $name;
            $promo->description = $description;
            $promo->save();
        } catch (\Exception $e) {
            Error::json(422, message: 'Редактировать имя запрещено');
        }
        Success::json(data: $promo->id);
    }
    public static function deletePromo($vars) {  
        try {
            $promo = Promo::find($vars['id']);
            $id =  $promo->id;
            $promo->delete();
            Success::json(data: $id);
        } catch (\Exception $e) {
            Error::json(404, $e, message: 'Промо не найдено');
        }
    }
}