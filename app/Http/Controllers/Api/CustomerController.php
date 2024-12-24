<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    function index() {

        try {
            $customers = Customer::get();
            return CustomerResource::collection($customers);            
        } catch (\Throwable $th) {
            return response()->json(["message" => "there was an error fetching data: $th"], 500);
        }
       
    }
    function store (Request $request) {

        $validator = Validator::make($request->all(),
                [
                    "name"      =>  "required|string|max:255",
                    "email"     =>  "required|email|max:255",
                    "phone"     => "required|regex:/^\+[1-9][0-9]{1,3}[0-9]{6,10}$/",
                    "address"   =>  "nullable|string",
                    "image_url" =>  "nullable|string"
                ] ,["phone.regex" =>  "phone must include valid country code and 6-10 digits"]);

        if ($validator->fails()) {
            return response()->json([
                "message" => "validation failed",
                "fail_msg" => $validator->messages()
            ],422);
        }
        try {
            //email and phone should be unique
            //TODO: check for existing records with same email or phone. 
            $customer = Customer::create(
                [
                    "name"      =>  $request->name,
                    "email"     =>  $request->email,
                    "phone"     =>  $request->phone,
                    "address"   =>  $request->address,
                    "image_url" =>  $request->image_url
                ]
            );

            return response()->json([
                "message" => "customer created successfully.",
                "data" => new CustomerResource($customer)
            ],201);

        } catch (\Throwable $th) {
             // Log the error message and stack trace
            Log::error('Error creating customer: ' . $th->getMessage(), ['stack_trace' => $th->getTraceAsString()]);

            return response()->json(["message" => $th->getMessage()],500);
        }
        

    }
    function show() {}
    function update () {}
    function destroy () {}
}
