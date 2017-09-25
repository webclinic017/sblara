<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public function index(){
       Mail::to("igorkrysov@mail.ru")->send(new OrderShipped());
    }
}
