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
        $refdata = $this->referenceData();
        return view('home',compact('clientdata','refdata'));
    }

    protected function clientdata()
    {
        return Client::with('sites.departments')->first();
    }

    protected function referenceData()
    {
        // Asset condition field enum options
        $options = \DB::select(\DB::raw('SHOW COLUMNS FROM assets WHERE Field = "condition"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $options, $matches);
        $values = array();
        foreach(explode(',', $matches[1]) as $value){
            $values[] = trim($value, "'");
        }

        return ['condition_options'=> $values];

        
    }
}
