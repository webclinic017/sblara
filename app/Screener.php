<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Classes\Screener as Scanner;
class Screener extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function resultCount()
    {
        $value = \Cache::remember('screener_count_'.$this->id, 1, function () {
            try {
                $screener = new Scanner($this->query);
            } catch (\Exception $e) {
                return 0;
            }
            return $screener->count();
        });     
        return $value;
    }
    public function ids()
    {
		$value = \Cache::remember('screener_count_'.$this->id, 1, function () {
			try {
    			$screener = new Scanner($this->query);
			} catch (\Exception $e) {
				return 0;
			}
    		return $screener->results();
		});    	
    	return $value;
    }

    public function getNameAttribute()
    {
        $sfx = "";
        if(strlen($this->title) > 20){
            $sfx = "...";
        }
        return "<span title='$this->title'>". substr($this->title, 0, 20).$sfx."</span>";
    }
}
