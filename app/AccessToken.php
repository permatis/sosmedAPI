<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
    protected $table = 'access_token';

    protected $fillable = [
    	'tk_facebook', 'tk_twitter', 'tk_instagram', 'tk_google', 'user_id'
    ];

    public function user()
    {
    	return $this->belongsTo(\App\User::class, 'user_id');
    }
}
