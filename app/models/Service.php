<?php


namespace Models;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = "service";
    protected $fillable = array("title", "description", "cost", "id_executor");
    public $timestamps = false;
}