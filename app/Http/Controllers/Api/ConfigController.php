<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;
use Illuminate\Support\Facades\Log;
class ConfigController extends Controller
{
    //

    function store (Request $request) {
        $config = Config::create([
            "name" => "setup",
            "state" => "0"
        ]);
    }

    
}
