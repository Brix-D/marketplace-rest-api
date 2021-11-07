<?php


namespace Models;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "role";
    protected $fillable = array("name", "permissions");
    public $timestamps = false;
}