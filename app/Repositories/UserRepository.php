<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/13/2017
 * Time: 3:34 PM
 */

namespace App\Repositories;
use App\UserInformation;
use App\Meta;

class UserRepository {


    public static function getUserInfo($metaKey,$userId=0)
    {
        $returnData=UserInformation::getUserData($metaKey,$userId);
        return $returnData;
    }

    public static function saveUserInfo($metaKey,$dataToSave='',$userId=0)
    {

        $metaInfo=Meta::getMetaInfo($metaKey);
        $metaId=$metaInfo->first()->id;

        UserInformation::where('user_id',$userId)->where('meta_id',$metaId)->get();
        $userInfo = new UserInformation;
        $userInfo->meta_value = $dataToSave;
        $userInfo->user_id = $userId;
        $userInfo->meta_id = $metaId;
        $userInfo->save();

        $returnData=UserInformation::saveUserData($metaId,$userId);
        return $returnData;
    }


} 