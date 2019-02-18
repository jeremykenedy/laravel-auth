<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfile extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'theme_id'         => '',
            'location'         => '',
            'bio'              => 'max:500',
            'twitter_username' => 'max:50',
            'github_username'  => 'max:50',
            'avatar'           => '',
            'avatar_status'    => '',
        ];
    }
}
