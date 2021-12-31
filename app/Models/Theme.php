<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theme extends Model
{
    use SoftDeletes;
    const default = 1;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'themes';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that are hidden.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Fillable fields for a Profile.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'link',
        'notes',
        'status',
        'taggable_id',
        'taggable_type',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'            => 'integer',
        'name'          => 'string',
        'link'          => 'string',
        'notes'         => 'string',
        'status'        => 'boolean',
        'activated'     => 'boolean',
        'taggable_id'   => 'integer',
        'taggable_type' => 'string',
    ];

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return array
     */
    public static function rules($id = 0, $merge = [])
    {
        return array_merge(
            [
                'name'   => 'required|min:3|max:50|unique:themes,name'.($id ? ",$id" : ''),
                'link'   => 'required|min:3|max:255|unique:themes,link'.($id ? ",$id" : ''),
                'notes'  => 'max:500',
                'status' => 'required',
            ],
            $merge
        );
    }

    /**
     * Get the profiles for the theme.
     */
    public function profile()
    {
        return $this->hasMany(\App\Models\Profile::class);
    }
}
