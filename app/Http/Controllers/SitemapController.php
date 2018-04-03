<?php

namespace App\Http\Controllers;


class SitemapController extends Controller
{
	public function index()
	{
	  return response()->view('sitemap')
	  ->header('Content-Type', 'text/xml')
	  ;
	}
}
