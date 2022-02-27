<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'tweets';
    
    protected $fillable = [
        'user_id',
        'tweet',
        'image_url',
        'created_at',
        'created_user',
        'update_user',
    ];
}
