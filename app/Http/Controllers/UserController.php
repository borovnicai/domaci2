<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    public function ulogujSe(Request $request)
    {
        $uspesnoLogovanje = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if($uspesnoLogovanje){
            $authUser = Auth::user();
            $odgovor['token'] =  $authUser->createToken('Token')->plainTextToken;
            $odgovor['name'] =  $authUser->name;

            return $this->uspesnoOdgovor($odgovor, 'Uspesno ste se logovali. Koristite token u daljim requstima.');
        }
        else{
            return $this->greskaOdgovor('Autentifikacija neuspesna.', ['error'=>'Greska pri podacima za logovanje']);
        }
    }

    public function registujSe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->greskaOdgovor('Greska pri validaciji', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $odgovor['name'] =  $user->name;
        $odgovor['token'] =  $user->createToken('Token')->plainTextToken;

        return $this->uspesnoOdgovor($odgovor, 'Uspesno napravljen korisnik.');
    }
}
