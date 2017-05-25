<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PortfolioScrip extends Model
{
    protected $dates = ['buying_date','sell_date'];

    function instrument() {
        return $this->belongsTo('\App\Instrument');
    }

    function exchange() {
        return $this->belongsTo('\App\Exchange');
    }

}
