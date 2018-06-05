<?php 
	return [
	"columns" => [[
	        "field"  => 'trading_code',
	        "sortable"  => true,
	        "searchable"  => true,
	        "title"  => 'Trading Code',
	        "required"  => true,
	        "filter" => [
	        	"type" => "input"
	        ]
	    ],[
	      "field" => 'ltp',
	      "sortable" => true,
	      "searchable" => true,
	        "required"  => true,
	      "title" => 'LTP'
	    ], [
	        "field" => 'high',
	        "sortable" => true,
	        "searchable" => true,
	        "required"  => true,
	        "title" => 'High'
	    ], [
	        "field" => 'low',
	        "sortable" => true,
	        "searchable" => true,
	        "required"  => true,
	        "title" => 'Low'
	    ], [
	        "field" => 'close',
	        "sortable" => true,
	        "searchable" => true,
	        "required"  => true,
	        "title" => 'Close'
	    ], [
	        "field" => 'ycp',
	        "sortable" => true,
	        "required"  => true,
	        "searchable" => true,
	        "title" => 'YCP'
	    ], [
	        "field" => 'change',
	        "sortable" => true,
	        "required"  => true,
	        "searchable" => true,
	        "title" => 'CHANGE'
	    ],  [
	        "field" => 'percent_change',
	        "sortable" => true,
	        "required"  => true,
	        "searchable" => true,
	        "title" => 'CHANGE(%)'
	    ], [
	        "field" => 'trade',
	        "sortable" => true,
	        "required"  => true,
	        "searchable" => true,
	        "title" => 'TRADE'
	    ], [
	        "field" => 'value',
	        "required"  => true,
	        "sortable" => true,
	        "searchable" => true,
	        "title" => 'VALUE'
	    ], [
	        "field" => 'volume',
	        "required"  => true,
	        "sortable" => true,
	        "searchable" => true,
	        "title" => 'VOLUME'
	    ], [
	        "required"  => true,
	        "field" => 'category',
	        "sortable" => true,
	        "searchable" => true,
	        "title" => 'Category'
	    ]
	    ]
    ];