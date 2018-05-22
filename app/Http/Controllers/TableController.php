<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Table;
use App\TableLayout;
class TableController extends Controller
{
	public function json(Request $request, $table)
	{
		$tableLayout = TableLayout::find($table);
		$table  =  new Table();

		return response()->json($table->setLayout($tableLayout)->serve());

	}


	public function index()
	{
		$tableLayout = TableLayout::where('user_id', $this->user()->id)->first();
		return view('latest-share-price')->with(compact(['tableLayout']));
	}

	public function updateColumn(Request $request)
	{
		$data = $request->except('_token');
		// dd($data);
		$cols = [];
		foreach ($data as $key => $value) {
			$cols[] = ['field' => $key, 'title' => $value];
		}
		$data = $cols;
		if(count($data) < 3){
			return redirect()->back()->with(['error'=> "Please select at least 3 columns"]);
		}
		$tl = TableLayout::where('user_id', $this->user()->id)->first();
		// dd($this->user()->id);
		if(!$tl){
			$tl = new TableLayout;
			$tl->name = "Layout 1"; 
			$tl->user_id = $this->user()->id; 
		}

		if($tl->config != null){
			$old = json_decode($tl->config);
			$old->columns = $data;
			$data = $old;
		}else{
			$data = ['columns' => $data];
		}
		$tl->config = json_encode($data);
		$tl->save();
		return redirect()->back()->with(['success' => "Columns successfully updated."]);
	}


	public function user()
    {
        if(!$user = request()->user())
        {
            $user = new \stdClass();
            if(!request()->session()->has('TableUserID')){
                session(['TableUserID' => md5(uniqid().time())]);
            }
            $user->id = session()->get('TableUserID');
            $user->name = 'Anonymous';
        }else{
        //sync settings
            
            if(request()->session()->has('TableUserID')){
                \App\TableLayout::where("user_id", session('TableUserID'))->update(['user_id' => $user->id]);
            }
        }
        return $user;
    }

    public function details($id)
    {
    	return view('latest-share-price-details')->with(compact('id'));
    }

}
