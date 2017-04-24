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
use Auth;

class UserRepository {


    // UserRepository::getUserInfo(array('market_monitor_settings'),5)
    // UserRepository::getUserInfo(array('market_monitor_settings'))
    public static function getUserInfo($metaKey,$userId=0)
    {
        if(!$userId)
        {
            $user = Auth::user();
            if(count($user))
                $userId=$user->id;
        }
        $metaInfo=Meta::getMetaInfo($metaKey);
        $metaId=$metaInfo->pluck('id');

        $query=UserInformation::whereIn('meta_id',$metaId)->where('user_id',$userId);
        $returnData=$query->get();

        return $returnData;
    }


    //UserRepository::saveUserInfo(array('market_monitor_settings'),'cccc')
    //UserRepository::saveUserInfo(array('market_monitor_settings'),'cccc',5)
    public static function saveUserInfo($metaKey,$dataToSave='',$userId=0)
    {
        $metaInfo=Meta::getMetaInfo($metaKey);
        $metaId=$metaInfo->first()->id;

        if(!$userId)
        {
            $user = Auth::user();
            if(count($user))
            $userId=$user->id;
        }

        if($userId) {
            return UserInformation::updateOrCreate(
                ['meta_id' => $metaId, 'user_id' => $userId],
                ['meta_value' => $dataToSave, 'meta_id' => $metaId, 'user_id' => $userId]
            );
        }
        else
            return false;

    }


} 