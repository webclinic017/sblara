<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class knowledgeBasketController extends Controller
{
    public function index(){
        return view('knowledge_basket.index');
    }
}
