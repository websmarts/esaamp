<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Sling;

class SlingsController extends Controller
{
    public function index()
    {
        return Sling::all();
    }
}
