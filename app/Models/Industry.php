<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'description', 'status'
    ];

    public static function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    public static function messages()
    {
        return [
            'name.required' => 'Name can not leave it blank',
        ];
    }
}
