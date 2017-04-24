<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function meta()
    {
        return $this->belongsTo('App\Meta');
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }
    public static function getUserData($metaId=array(),$userId=0)
    {
        $query=self::whereIn('meta_id',$metaId)->where('user_id',$userId);
        $returnData=$query->get();
        return  $returnData;
    }
    public static function saveUserData($metaId=array(),$userId=0)
    {

        $query=self::whereIn('meta_id',$metaId)->where('user_id',$userId);
        $returnData=$query->get();
        return  $returnData;
    }
}
