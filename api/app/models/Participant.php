<?php


namespace Models;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $table = "participant";
    protected $fillable = array("name");
    protected $hidden = ['pivot'];
    public $timestamps = false;
}