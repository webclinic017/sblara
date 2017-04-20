<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectorList extends Model
{
    public function instruments()
    {
        return $this->hasMany('App\Instrument','sector_list_id');
    }

}
