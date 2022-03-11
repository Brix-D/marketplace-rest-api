<?php


namespace Models;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = "result";
    //protected $fillable = array("name", "description");
    public $timestamps = false;

    public function winner() {
        return $this->hasOne('Models\Participant', 'winner');
    }

    public function prize() {
        return $this->hasOne('Models\Prize', 'prize');
    }
}