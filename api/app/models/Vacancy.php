<?php


namespace Models;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $table = "vacancy";
    protected $fillable = array("title", "description", "cost", "id_executor");
    public $timestamps = false;
}