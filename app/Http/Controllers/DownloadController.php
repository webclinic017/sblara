<?php

namespace App\Http\Controllers;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Instrument;
use App\SectorList;
use App\Repositories\DataBankEodRepository;
use ZipArchive;
use Carbon\Carbon;
use App\DataBanksEod;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {    
    	return view('download');
    }

    public function download(Request $request)
    {
        if($request->has('nonadjusted'))
        {
            return response()->download(storage_path() .'/app/plugin/eod.zip');
        }
        if($request->has('allTogetherByDate'))
        {
            return $this->allTogetherByDate();
        }
        if($request->has('adjusted'))
        {
            return response()->download(storage_path() .'/app/plugin/adjusted_eod.zip');
        }
        if($request->has('filtered'))
        {
            $start = Carbon::createFromFormat('m/d/Y', $request->from);
            $end = Carbon::createFromFormat('m/d/Y', $request->to);
                $dir = 'tmp/'.md5(uniqid()).'/';


                if($request->has('adjusted_filtered'))
                {

                    foreach ($request->instruments as $id) {
                        $instrument = \App\Instrument::find($id);                    
                        $path = $dir.$instrument->instrument_code.'.csv';
                        $file  = Storage::put($path, "Date,Open,High,Low,Close,Volume");

                        $data=DataBankEodRepository::getEodForCSV( $start->format('Y-m-d'), $end->format('Y-m-d'), $request->instruments, 1);
                        $title = 'custom_eod_adjusted.zip';
                        unset($data[0]);
                        $content ="";
                            foreach ($data as $row) {
                                  $content .= $row[1].",$row[2],$row[3],$row[4],$row[5],$row[6]\n";
                            }     
                     }                                   
                }else{
                        foreach ($request->instruments as $id) {
                            $instrument = \App\Instrument::find($id);

                             $eod = new DataBanksEod;
                            $rows = $eod->where('instrument_id', $id)->where('date', '>=', $start->format('Y-m-d'))->where('date', '<=', $end->format('Y-m-d'))->select('date', 'open', 'high', 'low', 'close', 'volume')->latest('date')->get();
                            $path = $dir.$instrument->instrument_code.'.csv';
                            $file  = Storage::put($path, "Date,Open,High,Low,Close,Volume");
                            $content = "";

            //              adjust price if corporate action found


                                $title = 'custom_eod.zip';
                                          

            //              adjust price if corporate action found
                            foreach ($rows as $row) {
                                $content .= date('d/m/Y', strtotime($row->date)).",$row->open,$row->high,$row->low,$row->close,$row->volume\n";
                            }
                        }
                }


             Storage::append($path, $content);

            $zipper = new \Chumper\Zipper\Zipper;
            $files = glob( storage_path().'/app/' .$dir.'*');
            $zipPath = storage_path().'/app/' .str_replace('/', '', $dir).'custom_eod.zip';
            $zipper->make($zipPath)->add($files)->close();
            Storage::deleteDirectory($dir);
             return response()->download($zipPath, $title)->deleteFileAfterSend(true);
        }
        return redirect()->back();
    }

    public function getJsonData(Request $request)
    {
    	$adjust = $request->adjust;
    	$instruIDs = explode(',' , $request->instruIDs);
    	$dataRange = explode(',', $request->dataRange);
    	$returnData = DataBankEodRepository::getEodForCSV($dataRange[0],$dataRange[1],$instruIDs,$adjust);
    	$records = array();
    	$records["data"] = array(); 
    	foreach($returnData as $index => $row) {
		  	if($index == 0) continue;
		  	// echo "<pre>";
		  	// print_r($row);
		  	// echo "</pre>";
		  	$records["data"][] = $row;
		}
		// exit;
		echo json_encode($records);
    }

    public function downloadZip(Request $request) {
    	$adjust = $request->adjust;
    	$instruIDs = explode(',' , $request->instruIDs);
    	$dataRange = explode(',', $request->dataRange);
    	$returnData = DataBankEodRepository::getEodForCSV($dataRange[0],$dataRange[1],$instruIDs,$adjust);

		$filename = "results.csv";
		$zipname = public_path()."/results.zip";
		$zip = new ZipArchive();
		$zip->open($zipname,  ZipArchive::CREATE);

		$handle = fopen($filename, 'w+');
		fputcsv($handle, $returnData[0]);
		foreach($returnData as $index => $row) {
		  if($index == 0) continue;
		  fputcsv($handle, $row);
		}
		fclose($handle);
		$zip->addFile($filename, basename($filename));
		$zip->close();
		unlink($filename);
		return response()->download($zipname)->deleteFileAfterSend(true);
    }

    public function allTogetherByDate()
    {
        $date = request()->allTogetherByDate;
        $query = "SELECT instrument_code, date, open, high, low, close, volume  FROM `data_banks_eods` 
                    left join instruments on instruments.id = instrument_id
                    where `date` = '$date'
                    order by instrument_code asc";
        $data = \DB::select(\DB::raw($query));

        $path = uniqid()."csv";
        $file  = Storage::put($path, "");
        foreach ($data as  $instrument) {
            // dd($instrument);
         Storage::append($path, "$instrument->instrument_code,$instrument->date,$instrument->open,$instrument->high,$instrument->low,$instrument->close,$instrument->volume");
        }
        return response()->download(storage_path() ."/app/".$path, 'stockbangladesh.com_EOD_'. str_replace('-', '_', $date).'.csv' )->deleteFileAfterSend(true);
    }
}
