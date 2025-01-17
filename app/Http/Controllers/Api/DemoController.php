<?php

namespace App\Http\Controllers\Api;
use App\Events\DemoTest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    //

    public function index(){

        return response() -> json(['message' => 'No record available'], 200);

    }

    public function store(Request $request){
        broadcast(new DemoTest());
        return response() -> json(['message' => 'This is a post request'], 200);

    }

    public function show(){

        return response() -> json(['message' => 'This ispost is shown'], 200);

    }


    public function update(){

        return response() -> json(['message' => 'This post was updated'], 200);

    }

    public function destroy(){

        return response() -> json(['message' => 'Destroyed'], 200);

    }




    
    
}
