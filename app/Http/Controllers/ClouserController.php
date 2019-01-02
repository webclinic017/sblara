<?php

namespace App\Http\Controllers;
use \Auth;
use Illuminate\Http\Request;

class ClouserController extends Controller
{
    public function pluginEod()
    {
    	 return response()->download(storage_path() . '/app/plugin/adjusted_eod.zip');
    }
    public function pluginIntra()
    {
    	  return response()->download(storage_path() . '/app/plugin/intra.zip');
    }    

    public function pluginResources()
    {
    	return response()->download(storage_path() . '/app/plugin/resources.zip');
    }
    public function plugininstallerwin7and8()
    {
    	return response()->download(storage_path() . '/app/plugin/StockBangladeshPlugin-Win7-8.zip');
    }
    public function plugininstallerwin10()
    {
    return response()->download(storage_path() . '/app/plugin/StockBangladeshPlugin-Win10.zip');
    }
    public function pluginIntra2()
    {
    return response()->download(storage_path() . '/app/plugin/StockBangladeshPlugin-Win10.zip');
    }
    public function time()
    {
     return json_encode(time());
    }

    public function ajax() {
    return 786;	
	}

	public function resourcesamibrokerdataplugindse() {
    if(request()->has('gid'))
    {
        if(\Auth::guest())
            {
                abort(403);
            }
        $user = \Auth::user();
        if($user->plugin_apply == request()->gid)
        {
            return "";
        }
        $user->plugin_apply = request()->gid;
        $user->name = request()->name;
        $user->contact_no = request()->mobile;

        if($user->plugin_apply == '1' && $user->group_id == '0')
        {
            $user->plugin_approved_at = \Carbon\Carbon::now();        
            $user->group_id = $user->plugin_apply;
            \Mail::to($user)->send(new \App\Mail\PluginRequestApproved());
        }

        if($user->plugin_apply != '1')
        {
            \Mail::to($user)->send(new \App\Mail\PluginRequestReceived($user));
        }

        $user->save();
        return "";
    }    
    $user = Auth::user();
    return view('amibroker-data-plugin')->with(compact(['user']));
	}

	// public function pluginEod()
	// {
	// 	    return response()->download(storage_path() . '/app/plugin/eod.zip');
	// }

    public function topbarlogin()
    {
        if(\Auth::guest()){
            return view('includes.metronic.topbar_guest');
        }
        return view('includes.metronic.topbar_login');
    }


}
