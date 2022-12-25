<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientPostRequest;
use App\Models\Client;
use Illuminate\Http\Response;

class ClientRestController extends Controller{

    public function index(){
        $clients=Client::all();
        return response()->json($clients,Response::HTTP_OK);
    }

    public function store(ClientPostRequest $request){
        $client=Client::create($request->all());
        return response()->json([
            'message'=>"Registro creado satisfactoriamente",
            'client'=>$client
        ],Response::HTTP_CREATED);
    }

    public function update(ClientPostRequest $request,$client){
        $client=Client::find($client);
        $client->update($request->only('name','slug'));
        return response()->json([
            'message'=>"Registro actualizado satisfactoriamente",
            'client'=>$client
        ],Response::HTTP_CREATED);
    }

    public function destroy($client){
        $client=Client::find($client);
        $client->delete();
        return response()->json([
            'message'=>"Registro eliminado satisfactoriamente"
        ],Response::HTTP_OK);
    }

}
