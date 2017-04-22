<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PortfolioTransaction extends Model {

    protected $dates = ['transaction_time'];

    function instrument() {
        return $this->belongsTo('\App\Instrument');
    }

    function exchange() {
        return $this->belongsTo('\App\Exchange');
    }

    function parent_portfolio_transaction() {
        return $this->belongsTo('\App\PortfolioTransaction', 'parent_id');
    }

}
