<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class ChartLayout extends Model
{
	protected $appends = ['timestamp'];
	public function getTimestampAttribute()
	{
		return strtotime($this->updated_at);
	}
}
