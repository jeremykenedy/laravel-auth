<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theme extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'themes';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
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
            $merge);
    }

    /**
     * Build Theme Relationships.
     *
     * @var array
     */
    public function profile()
    {
        return $this->hasMany('App\Models\Profile');
    }
}
