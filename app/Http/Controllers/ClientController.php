<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\MailController;
use App\Mail\ConfirmationEmail;
use Illuminate\Support\Facades\Mail;
class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return response()->json([
            'status' => true,
            'clients' => $clients
        ], 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:clients',
            'phone' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }
        try {
            Mail::to($request->email)->send(new ConfirmationEmail($request));
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "El correo de confirmacion no se ha podido enviar, intente nuevamente."
            ], 500);
        }
        $client = new Client;
        $client -> name = $request -> name;
        $client -> email = $request -> email;
        $client -> phone = $request -> phone;
        $client -> save();
        return response()-> json([
            'status' => true,
            'message' => 'Cliente creado con éxito.'
        ], 200);
    }
}
