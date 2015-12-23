<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social extends Model {

    protected $table = 'social_logins';

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}