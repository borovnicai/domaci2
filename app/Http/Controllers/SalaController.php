<?php

namespace App\Http\Controllers;


use App\Http\Resources\SalaResurs;
use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalaController extends BaseController
{
    public function index()
    {
        $Sale = Sala::all();
        return $this->uspesnoOdgovor(SalaResurs::collection($Sale), 'Vraceni svi podaci o salama!');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nazivSale' => 'required',
        ]);
        if($validator->fails()){
            return $this->greskaOdgovor($validator->errors());
        }

        $sala = Sala::create($input);

        return $this->uspesnoOdgovor(new SalaResurs($sala), 'Nova sala je kreirana.');
    }


    public function show($id)
    {
        $sala = Sala::find($id);
        if (is_null($sala)) {
            return $this->greskaOdgovor('Sala sa zadatim id-em ne postoji.');
        }
        return $this->uspesnoOdgovor(new SalaResurs($sala), 'Sala sa zadatim id-em je vracena.');
    }


    public function update(Request $request, $id)
    {
        $sala = Sala::find($id);
        if (is_null($sala)) {
            return $this->greskaOdgovor('Sala sa zadatim id-em ne postoji.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'nazivSale' => 'required',
        ]);

        if($validator->fails()){
            return $this->greskaOdgovor($validator->errors());
        }

        $sala->nazivSale = $input['nazivSale'];
        $sala->save();

        return $this->uspesnoOdgovor(new SalaResurs($sala), 'Sala je azurirana.');
    }

    public function destroy($id)
    {
        $sala = Sala::find($id);
        if (is_null($sala)) {
            return $this->greskaOdgovor('Sala sa zadatim id-em ne postoji.');
        }

        $sala->delete();
        return $this->uspesnoOdgovor([], 'Sala je obrisana.');
    }
}
