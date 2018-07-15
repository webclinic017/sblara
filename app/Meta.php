<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Meta extends Model
{
    protected $dates = [
        'created_at',

    ];

    public function meta_group()
    {
        return $this->belongsTo('App\MetaGroup');
    }

    public static function getMetaList()
    {
        $data=self::with('meta_group')->orderBy('created_at','asc')->get();
        return $data->keyBy('meta_key');
    }
    public static function getMetaInfo($meta=array())
    {
        $data = \Cache::remember("meta_info_".join("_", $meta), 60, function () use ($meta)
        {
                    $data=self::with('meta_group')->whereIn('meta_key',$meta)->get();
                    $data->keyBy('meta_key');
                  return $data;
        });
        return $data;

    }
    public static function getMetaInfoById($meta=array())
    {
        $data=self::with('meta_group')->whereIn('id',$meta)->get();
        return $data->keyBy('id');
    }
    public static function getMetaKeyByGroup($metaGroup=array())
    {
        $returnData = static::whereHas('meta_group', function($q) use($metaGroup) {
            $q->whereIn('group_key',$metaGroup);
        })->get();
        return $returnData->groupBy('meta_group.group_key');
    }

    public static function lastId()
    {
        $allMeta= DB::table('fundamentals')->orderBy('meta_date','desc')->get()->groupBy('meta_id');

        foreach($allMeta as $meta_id=>$meta)
        {
            dump($meta->groupBy());
           // dump($meta);
        }
            //->where('id', 1)
            //->update(['votes' => 1]);
    }

    public static function deleteMeta($meta_ids=array())
    {
        self::destroy($meta_ids);
        return true;
    }


}
