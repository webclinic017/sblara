<?php 
namespace App\Traits;
use App\Attachment;
trait HasAttachment{

    public function attachments($type = false)
    {
    	return $type ? $this->morphMany(Attachment::class, 'attachmentable')->where('type', $type): $this->morphMany(Attachment::class,  'attachmentable');
    }

    public function storeAttachments($request)
    {
    	$attachments = $request->attachments;
    	$data = [];
        if($request->hasFile('attachments'))
        {
            foreach ($attachments as $key => $attachment) {
                $path = NULL;
                 if(isset($attachments[$key]))
                 {
                      $path = $attachments[$key]->store('public/attachments');
                 }
                 $data[] = new Attachment(['title' => $request->titles[$key], 'path' => $path, 'type' => 'attachment' ]);
            }
        }
         $this->attachments()->saveMany($data);
    }
}