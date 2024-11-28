<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceRequestController extends Controller
{
    //

    public function index(){

        return response()-> json(['message'=> 'No service requests available'], 200); 
    }

    public function store (){

        return response()-> json(['message'=> 'Service request has been created'], 200);
    }

    public function show(){

        return response()-> json(['message'=> 'This is a Service request'], 200); 
    }

    public function update(){

        return response()-> json(['message'=> 'The service request has been updated'], 200);
    }

    public function destroy(){

        return response()-> json(['message'=> 'the service request has been destroyed'], 200);
    }
}
