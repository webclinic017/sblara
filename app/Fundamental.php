<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Fundamental extends Model
{
    protected  $fillable = ['is_latest', 'instrument_id', 'meta_id', 'meta_value', 'meta_date'];
    public function getMetaDateAttribute($value) {
        return Carbon::parse($value);
    }

    public function meta()
    {
        return $this->belongsTo('App\Meta','meta_id');
    }

    public function instrument()
    {
        return $this->belongsTo('App\Instrument');
    }


    public static function getData($metaId=array(),$instrumentId=array())
    {
        $query=self::whereIn('meta_id',$metaId);

        if(!empty($instrumentId))
        $query->whereIn('instrument_id',$instrumentId);

        $returnData=$query->orderby('meta_date','desc')->get();
        return  $returnData;
    }

    public static function deleteFundamental($meta_ids = array())
    {
        $deletedRows = self::whereIn('meta_id', $meta_ids)->delete();
        return true;
    }

    
    public function storeMeta()
    {

    }
}
