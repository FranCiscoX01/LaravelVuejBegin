<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; //importar
use App\Mail\SendMail; //importar

class SendEmailController extends Controller
{
    public function index(){
        return view('contact');
    }

    public function sendEmail(Request $request){

        $this->validate($request, [ //valida los campos que son requeridos
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        $data = array( //campos que se van a enviar al correo
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        );

        Mail::to($data['email'])
            ->queue(new SendMail($data));

        return back()->with('status', 'Thanks for contacting us!');
    }
}
