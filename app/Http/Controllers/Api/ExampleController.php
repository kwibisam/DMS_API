<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\ExampleEvent;

class ExampleController extends Controller
{
    //
    function index ()
    {
        //dispatch example-event
        ExampleEvent::dispatch("this is an example event message");
        return response()->json(["message" => "dispatched example event"]);
    }
}
