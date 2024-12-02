<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;

class ServiceController extends Controller
{
    //

    public function index(){

        $services = Service::get();
        if($services)
        {
            return ServiceResource::collection($services);
        }

       
    }

    public function store (Request $request){

        $service = Service::create([
            'ServiceName'=> $request -> ServiceName,
            'ServiceFamily'=> $request -> ServiceFamily
        ]);

        return response()->json(['message'=>'the service has been created', 'data'=> new ServiceResource($service)]);

    }

    public function show(Service $service){

        return new ServiceResource($service); 

       
    }

    public function update(Request $request, Service $service){

        $service -> update([
            'ServiceName'=> $request -> ServiceName,
            'ServiceFamily'=> $request -> ServiceFamily
        ]);

        return response()->json(['message'=>'the service has been updated', 'data'=> new ServiceResource($service)]);

    }

    public function destroy(Service $service){

        $service -> delete(); 

        return response()->json(['message'=> 'the service has ben deleted']);

    }
}
