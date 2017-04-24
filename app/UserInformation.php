<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    protected $fillable = ['meta_id','user_id','meta_value'];
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function meta()
    {
        return $this->belongsTo('App\Meta');
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }


}
