<?php


namespace Models;
use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    protected $table = "prize";
    protected $fillable = array("description");
    protected $hidden = ['pivot'];
    public $timestamps = false;
}