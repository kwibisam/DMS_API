<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tag;

class TagsController extends Controller
{
    //
    public function index(){
        $tags = Tag::get();
        return response() -> json(['data' => $tags], 200);

    }

    public function store(Request $request){
        $tag = Tag::create([
            'name' => $request->name
        ]);
        return response() -> json(['data' => $tag], 201);

    }

    public function show(Tag $tag){

        return response() -> json(['data' => $tag], 200);

    }


    public function update(){

        return response() -> json(['message' => 'This post was updated'], 200);

    }

    public function destroy(){

        return response() -> json(['message' => 'Destroyed'], 200);

    }



}
