<?php

namespace App;

use App\Repositories\InstrumentRepository;
use Illuminate\Database\Eloquent\Model;

class ContestPortfolioShare extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'buying_date'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no_of_shares', 
        'buying_price', 
        'buying_date',
        'commission',
    ];

    /**
     * A share may have a intrument.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function intrument() 
    {
        return $this->belongsTo(Instrument::class, 'instrument_id');
    }

    public function instrument()
    {
        return $this->intrument();
    }

    /**
     * A share may have a transaction type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transactionType() 
    {
        return $this->belongsTo(TransactionType::class, 'id');
    }

    /**
     * A share may have a portfolio.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function portfolio() 
    {
        return $this->belongsTo(Portfolio::class, 'id');
    }

    public function getIsMatureAttribute()
    {
        // a b n t+2
        // z t+9
        return InstrumentRepository::isMature($this->id, $this->buying_date->format('Y-m-d'));
    }


    public function getAvailableQtyAttribute()
    {
        return $this->no_of_shares - $this->sell_quantity;
    }


    public function getBuyQtyAttribute()
    {
        return $this->no_of_shares;
    }

    public function getSellQtyAttribute()
    {
        return $this->sellQty;
    }



}
