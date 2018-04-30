<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\FundamentalRepository;
use App\Repositories\MarketStatRepository;
use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\UserRepository;
use App\Navigation;

class TestController extends Controller
{
    public function funtest()
    {

        dump(date('d-M-Y',strtotime('2018-04-26')));
        dump(strtotime('2018-04-26 14:00'));
        dump(strtotime('2018-04-26 13:00'));
        dump(strtotime('2018-04-26 12:00'));
        dd(strtotime('2018-04-26'));

        /* Use internal libxml errors -- turn on in production, off for debugging */
        libxml_use_internal_errors(true);
        /* Createa a new DomDocument object */



        $dom = new \DomDocument;
        /* Load the HTML */
        @$dom->loadHTMLFile("http://quotes.wsj.com/BD/XDHA/UPGDCL/financials/annual/balance-sheet");
        /* Create a new XPath object */
        $xpath = new \DomXPath($dom);
        /* Query all <td> nodes containing specified class name */
        //$nodes = $xpath->query("//th[@class='fiscalYr']");
        $heading_nodes = $xpath->query('//*[@id="cr_cashflow"]/div[2]/div/table/thead/tr');

        $heading=array();
        foreach ($heading_nodes as $i => $node) {

            $temp=array();
            foreach($node->childNodes as $child)
            {
                $data=str_replace(',','',$child->nodeValue);
                $data=trim($data);


                if($data!='')
                    $temp[]=$data;

            }
            $heading[]=$temp;
            // echo "Node($i): ", $node->nodeValue, "\n";
            // dd($node);

        }

        // dump($heading);
        $nodes = $xpath->query('//*[@id="cr_cashflow"]/div[2]/div/table/tbody/tr');


        /* Set HTTP response header to plain text for debugging output */
        //   header("Content-type: text/plain");
        /* Traverse the DOMNodeList object to output each DomNode's nodeValue */

        $all_data=array();
        foreach ($nodes as $i => $node) {

            $temp=array();
            foreach($node->childNodes as $child)
            {
                $data=str_replace(',','',$child->nodeValue);
                $data=trim($data);
                if($data!='')
                {
                    $temp[]=$data;
                    break;
                }


            }
            $all_data[]=$temp;
            // echo "Node($i): ", $node->nodeValue, "\n";
            // dd($node);

        }


        $nodes = $xpath->query('//*[@id="cr_cashflow"]/div[3]/div[2]/table/tbody/tr');


        /* Set HTTP response header to plain text for debugging output */
        //   header("Content-type: text/plain");
        /* Traverse the DOMNodeList object to output each DomNode's nodeValue */

        $all_data2=array();
        foreach ($nodes as $i => $node) {

            $temp=array();
            foreach($node->childNodes as $child)
            {
                $data=str_replace(',','',$child->nodeValue);
                $data=trim($data);
                if($data!='')
                {
                    $temp[]=$data;
                     break;
                }


            }
            $all_data2[]=$temp;
            // echo "Node($i): ", $node->nodeValue, "\n";
            // dd($node);

        }



        dump("Balance sheet-assets");


        dump($all_data);

        dump("Balance Liabilities");

        dump($all_data2);



        $dom = new \DomDocument;
        /* Load the HTML */
        @$dom->loadHTMLFile("http://quotes.wsj.com/BD/XDHA/UPGDCL/financials/annual/cash-flow");
        /* Create a new XPath object */
        $xpath = new \DomXPath($dom);
        /* Query all <td> nodes containing specified class name */
        //$nodes = $xpath->query("//th[@class='fiscalYr']");
        $heading_nodes = $xpath->query('//*[@id="cr_cashflow"]/div[2]/div[2]/table/thead/tr');

        $heading=array();
        foreach ($heading_nodes as $i => $node) {

            $temp=array();
            foreach($node->childNodes as $child)
            {
                $data=str_replace(',','',$child->nodeValue);
                $data=trim($data);


                if($data!='')
                    $temp[]=$data;

            }
            $heading[]=$temp;
            // echo "Node($i): ", $node->nodeValue, "\n";
            // dd($node);

        }

        // dump($heading);
        $nodes = $xpath->query('//*[@id="cr_cashflow"]/div[2]/div[2]/table/tbody/tr');


        /* Set HTTP response header to plain text for debugging output */
        //   header("Content-type: text/plain");
        /* Traverse the DOMNodeList object to output each DomNode's nodeValue */

        $all_data=array();
        foreach ($nodes as $i => $node) {

            $temp=array();
            foreach($node->childNodes as $child)
            {
                $data=str_replace(',','',$child->nodeValue);
                $data=trim($data);
                if($data!='')
                {
                    $temp[]=$data;
                    break;
                }


            }
            $all_data[]=$temp;
            // echo "Node($i): ", $node->nodeValue, "\n";
            // dd($node);

        }


        $nodes = $xpath->query('//*[@id="cr_cashflow"]/div[3]/div[2]/table/tbody/tr');


        /* Set HTTP response header to plain text for debugging output */
        //   header("Content-type: text/plain");
        /* Traverse the DOMNodeList object to output each DomNode's nodeValue */

        $all_data2=array();
        foreach ($nodes as $i => $node) {

            $temp=array();
            foreach($node->childNodes as $child)
            {
                $data=str_replace(',','',$child->nodeValue);
                $data=trim($data);
                if($data!='')
                {
                    $temp[]=$data;
                     break;
                }


            }
            $all_data2[]=$temp;
            // echo "Node($i): ", $node->nodeValue, "\n";
            // dd($node);

        }


 $nodes = $xpath->query('//*[@id="cr_cashflow"]/div[4]/div[2]/table/tbody/tr');


        /* Set HTTP response header to plain text for debugging output */
        //   header("Content-type: text/plain");
        /* Traverse the DOMNodeList object to output each DomNode's nodeValue */

        $all_data3=array();
        foreach ($nodes as $i => $node) {

            $temp=array();
            foreach($node->childNodes as $child)
            {
                $data=str_replace(',','',$child->nodeValue);
                $data=trim($data);
                if($data!='')
                {
                    $temp[]=$data;
                     break;
                }


            }
            $all_data3[]=$temp;
            // echo "Node($i): ", $node->nodeValue, "\n";
            // dd($node);

        }



        dump("CASH FLOW Operating Activities");
        dump($all_data);

        dump("CASH FLOW Investing Activities");
        dump($all_data2);

        dump("CASH FLOW Financing Activities");
        dump($all_data3);







        $dom = new \DomDocument;
        /* Load the HTML */
        @$dom->loadHTMLFile("http://quotes.wsj.com/BD/XDHA/UPGDCL/financials/annual/income-statement");
        /* Create a new XPath object */
        $xpath = new \DomXPath($dom);
        /* Query all <td> nodes containing specified class name */
        //$nodes = $xpath->query("//th[@class='fiscalYr']");
        $heading_nodes = $xpath->query('//*[@id="cr_cashflow"]/div[2]/div/table/thead/tr');

        $heading=array();
        foreach ($heading_nodes as $i => $node) {

            $temp=array();
            foreach($node->childNodes as $child)
            {
                $data=str_replace(',','',$child->nodeValue);
                $data=trim($data);


                if($data!='')
                    $temp[]=$data;

            }
            $heading[]=$temp;
            // echo "Node($i): ", $node->nodeValue, "\n";
            // dd($node);

        }

       // dump($heading);
        $nodes = $xpath->query('//*[@id="cr_cashflow"]/div[2]/div/table/tbody/tr');


        /* Set HTTP response header to plain text for debugging output */
     //   header("Content-type: text/plain");
        /* Traverse the DOMNodeList object to output each DomNode's nodeValue */

        $all_data=array();
        foreach ($nodes as $i => $node) {

            $temp=array();
                foreach($node->childNodes as $child)
                {
                    $data=str_replace(',','',$child->nodeValue);
                    $data=trim($data);
                    if($data!='')
                    {
                        $temp[]=$data;
                        break;
                    }


                }
            $all_data[]=$temp;
           // echo "Node($i): ", $node->nodeValue, "\n";
           // dd($node);

        }


        dump("income-statement");

        dd($all_data);
        exit;


        $url = 'http://quotes.wsj.com/BD/XDHA/SPCL/financials/annual/cash-flow';
        $html = file_get_contents($url);


        $dom=New \DOMDocument();
        @$dom->loadHTML($html);
        $xpath=New \DOMXPath($dom);

/*        $result=$xpath->query('//*[@id="cr_cashflow"]/div[2]/div[2]/table/thead/tr/th[1]');
        dd($result->item(0));*/

        $result=$xpath->query("//th[@class='fiscalYr']");
        dd($result->item(0));




exit;



        dump(FundamentalRepository::getFundamentalData(array('stock_dividend','total_no_securities'),array('ABBANK','ACI'))->toArray());
        dump(FundamentalRepository::getFundamentalData(array(13,211),array('ABBANK','ACI'))->toArray());
        dump(FundamentalRepository::getFundamentalData(array('stock_dividend','total_no_securities'),array(12,13))->toArray());
        dd(FundamentalRepository::getFundamentalData(array(13,211),array(12,13))->toArray());

        dd(UserRepository::getUserInfo(array('market_monitor_settings'),5));
        dd(UserRepository::saveUserInfo(array('market_monitor_settings'),'cccc'));

        dd(DataBanksIntradayRepository::getYdayMinuteData(array(),15,'close_price')->toArray());

        $data=FundamentalRepository::getFundamentalData(array('stock_dividend','total_no_securities'),array('ABBANK','ACI'));
        dump($data);
        $data=FundamentalRepository::getFundamentalDataById(array(13,211),array(12,13));
        dd($data);
    }
    
    public function testAK(){
        return view('test.ak');
    }
}
