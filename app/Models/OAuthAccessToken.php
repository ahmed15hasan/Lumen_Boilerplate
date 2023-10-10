<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class OAuthAccessToken extends Model
{
    protected $table = "oauth_access_tokens";

    /**
     * revoke all user tokens 
     * 
     * @params integer $userId
     * @return (boolean)
     */
    public static function revokeTokens($userId)
    {
        return self::where('user_id',$userId)->delete();
    }
}
