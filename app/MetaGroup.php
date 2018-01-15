<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetaGroup extends Model
{
    protected $dates = [
        'created_at',

    ];

    public static function deleteMetaGroup($group_key)
    {
        $deletedRows = self::where('group_key', $group_key)->delete();

        return true;
    }
}
