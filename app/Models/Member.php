<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'uid';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'uid',
        'display_name',
        'picture_url',
        'status_message',
        'role',
        'gender',
        'birth',
        'phone',
        'email',
        'about_me'
    ];

    protected $hidden = [
        'remember_token',
    ];

}
