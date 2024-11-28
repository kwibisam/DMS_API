<?php

namespace App\Http\Controllers\Api;

use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuotationResource;

class QuotationController extends Controller
{
    //

    public function index(){

        $quotations = Quotation::get();
        if($quotations)
        {

            return QuotationResource::collection($quotations);

        }
        else {

            return response()-> json(['message'=> 'No quotation available'], 200); 

        }

       
    }

    public function store (Request $request){

     
    
        $quotation = Quotation::create([
            'name' => $request -> name,
            'service' => $request -> service,
            'price' => $request -> price
        ]);

   

        return response()->json(['message'=> 'The Quotation was created', 'data'=> new QuotationResource($quotation)], 200);

    }

    public function show(){

        return response()-> json(['message'=> 'This is a quotation'], 200); 
    }

    public function update(){

        return response()-> json(['message'=> 'The quotation has been updated'], 200);
    }

    public function destroy(){

        return response()-> json(['message'=> 'the quotation has been destroyed'], 200);
    }
}