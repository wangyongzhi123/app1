<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YunUser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'rank', 'user_name', 'dept_name', 'change_score', 'deduct_score', 'add_score', 'avatar',
    ];

    protected $table = 'yun_user';

}
