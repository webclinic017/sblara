<?php 
namespace App\Traits;
use App\Attachment;
trait HasAttachment{

    public function attachemnts($type = false)
    {
    	return $type ? $this->morphMany(Attachment::class)->where('type', $type): $this->morphMany(Attachment::class);
    }
}