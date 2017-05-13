<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectorList extends Model
{
    public function instruments()
    {
        return $this->hasMany('App\Instrument','sector_list_id');
    }

    public static function getSectorDetailsByInstrumentId($instrumentId=0)
    {
        $returnData = static::whereHas('instruments', function ($query) use($instrumentId) {
            $query->where('id', $instrumentId);
        })->get();

        return $returnData;

    }

}
