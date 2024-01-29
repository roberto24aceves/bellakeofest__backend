<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Events\event_participantes;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return response()->json([
            'status' => true,
            'message' => 'Clientes encontrados con éxito',
            'clients' => $clients
        ], 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|alpha',
            'email' => 'required|email',
            'phone' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 400);
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
