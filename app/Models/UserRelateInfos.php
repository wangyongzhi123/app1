<?php

namespace App\Models;

class UserRelateInfos extends \Illuminate\Database\Eloquent\Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'staff_id','email','card_number'
    ];

    protected $table = 'user_relate_infos';
}
