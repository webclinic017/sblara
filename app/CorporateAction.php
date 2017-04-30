<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CorporateAction extends Model
{
    protected $table = 'corporate_action';
    protected $dates = [
        'record_date',

    ];
}
