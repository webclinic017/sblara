<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CorporateAction extends Model
{
    protected $table = 'corporate_action';
    public $timestamps = false;
    protected $dates = [
        'record_date',
    ];

    public function instrument()
    {
    	return $this->belongsTo(Instrument::class);
    }
}
