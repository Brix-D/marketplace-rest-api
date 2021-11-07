<?php


namespace Models;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "user";
    protected $fillable = array("login", "email", "password", "id_role");
    public $timestamps = false;
}