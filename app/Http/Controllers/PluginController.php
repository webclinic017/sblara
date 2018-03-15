<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \Carbon\Carbon;
class PluginController extends Controller
{
    public function requests()
    {
   // 	$users = User::where('group_id',  0)->where('plugin_apply', '!=', 0)->get();
    	// foreach ($users as $key => $user) {

    	// 	$user->group_id = $user->plugin_apply;
    	// 	$user->plugin_approved_at = Carbon::now();
    	// 	$user->save();
    	// 	\Mail::to($user)->send(new \App\Mail\PluginRequestApproved());

    	// }
    	// die();
    	if(request()->has('approve'))
    	{
    		$user = User::find(request()->approve);
    		$user->group_id = $user->plugin_apply;
    		$user->plugin_approved_at = Carbon::now();
            if($user->plugin_apply != "1")
            {
    		  $user->plugin_expired_at = Carbon::parse(request()->expired_at);  
            }
   		   $user->save();
           
         \Mail::to($user)->send(new \App\Mail\PluginRequestApproved());
   			return redirect()->back()->with(['success' => 'Request successfully approved']);
    	}
    	$users = User::whereRaw('plugin_apply != group_id and plugin_apply != 0')->get();
    	return view('admin.plugin-requests')->with(compact('users'));
    }
}
