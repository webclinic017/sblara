<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instrument;
use App\SectorList;
use App\Repositories\DataBankEodRepository;
use ZipArchive;

class DownloadController extends Controller
{
    public function index(Request $request)
    {
    	// echo "<pre>";
    	// print_r(Instrument::getInstrumentsBySectorName('Cement'));
    	// echo "</pre>";
    	// exit;
    	$instrumentField = "";
    	$sectors = SectorList::all();

    	foreach ($sectors as $key => $sector) {
    		$instrumentField .= "<optgroup label=$sector->name>";
    		$instrumentsBySector = Instrument::getInstrumentsBySectorName($sector->name);
    		foreach ($instrumentsBySector as $instrument) {
    			$instrumentField .= "<option value = $instrument->id>$instrument->id - $instrument->instrument_code</option>";
    		}
    		$instrumentField .= '</optgroup>';
    	}
    	$theader = array('Code','Date','Open','High','Low','Close','Volume');
    	$thead = "<thead><tr>";
    	foreach ($theader as $key => $th) {
    		$thead .= "<th> $th </th>";
    	}
    	$thead .= "</tr></thead>";
    	// echo $instrumentField;
    	return view('download',[
    		'instrumentField' => $instrumentField,
    		'thead' => $thead,
    	]);
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
}
