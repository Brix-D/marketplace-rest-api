<?php


namespace Models;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $table = "promo";
    protected $fillable = array("name", "description");
    protected $hidden = ['pivot'];
    public $timestamps = false;

    public function participants() {
        return $this->belongsToMany('Models\Participant', 'promo_participant');
    }

    public function prizes() {
        return $this->belongsToMany('Models\Prize', 'promo_prize');
    }
}