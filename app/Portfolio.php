<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model {

    function portfolio_transactions() {
        return $this->hasMany('\App\PortfolioTransaction');
    }

}
