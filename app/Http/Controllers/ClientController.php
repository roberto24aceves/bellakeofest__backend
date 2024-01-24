<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Events\event_participantes;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'  => 'required|string|min:3|max:255',
            'lastname'  => 'required|string|min:3|max:255',
            'email' => 'required|email',
            'phone' => 'required|min:7|max:15'
        ]);

        if($validator->fails()){
            return response()-> json([
                'status'=> false,
                'errors' => $validator->errors(),
                'message' => "Ha ocurrido un error al realizar el registro, verifique los datos"
            ], 500); 
        }


        $client = new CLient;
        $client -> name = $request -> name;
        $client -> lastname = $request -> lastname;
        $client -> email = $request -> email;
        $client -> phone = $request -> phone;
        $client -> save();
        event(new event_participantes($client));
        return response()-> json([
            'status' => true,
            'message' => 'Cliente creado con éxito.'
        ], 200);
    }
    public function show($id)
    {
        
        $client = Client::find($id);    

        if (!$client) {
            return response()->json([
                'status' => false,
                'error' => 'Cliente no encontrado'
            ], 404); 
        } 

        return response()->json([
            'status' => true,
            'message' => 'Cliente encontrado con éxito',
            'client' => $client
        ], 200);
    }

}
