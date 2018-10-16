<?php

namespace App\Http\Controllers;

use App\Client;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        $clientdata = $this->clientdata();
        return view('home',compact('clientdata'));
    }

    protected function clientdata()
    {
        return Client::with('sites.departments')->first();
    }
}
