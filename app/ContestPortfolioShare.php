<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContestPortfolioShare extends Model
{
    protected $fillable = [
    	'contest_portfolio_id',
		'instrument_id',
		'portfolio_id',
		'transaction_type_id'
    ];

    /**
     * A share may have a intrument.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function intrument() 
    {
        return $this->belongsTo(Instrument::class, 'id');
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
}
