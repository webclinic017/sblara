<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class MarketStat extends Model
{
    protected $dates = [
        'created',
        'updated',

    ];

    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

    protected $guarded = ['id'];

    public function getMetaDateAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function meta()
    {
        return $this->belongsTo('App\Meta', 'meta_id');
    }

    public function market()
    {
        return $this->belongsTo('App\Market', 'market_id');
    }

    public static function getData($metaId = array(), $marketId = array())
    {
        $query = self::whereIn('meta_id', $metaId);

        if (!empty($marketId))
            $query->whereIn('market_id', $marketId);

        $returnData = $query->orderby('meta_date', 'desc')->get();

        return $returnData;
    }
}
