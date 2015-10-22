<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Password extends Model {

    protected $table = 'password_resets';

    public $timestamps = false;
}