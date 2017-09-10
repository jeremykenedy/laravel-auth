<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'activations';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    protected $hidden = [
        'user_id',
        'token',
        'ip_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
