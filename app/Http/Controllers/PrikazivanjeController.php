<?php

namespace App\Http\Controllers;

use App\Http\Resources\PrikazivanjeResurs;
use App\Models\Prikazivanje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrikazivanjeController extends BaseController
{
    public function index()
    {
        $prikazivanja = Prikazivanje::all();
        return $this->uspesnoOdgovor(PrikazivanjeResurs::collection($prikazivanja), 'Vraceni svi podaci o bioskopu!');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'dan' => 'required',
            'filmID' => 'required',
            'salaID' => 'required',
        ]);
        if($validator->fails()){
            return $this->greskaOdgovor($validator->errors());
        }

        $prikaz = Prikazivanje::create($input);

        return $this->uspesnoOdgovor(new PrikazivanjeResurs($prikaz), 'Novi prikaz u bioskopu je kreiran.');
    }


    public function show($id)
    {
        $prikaz = Prikazivanje::find($id);
        if (is_null($prikaz)) {
            return $this->greskaOdgovor('Prikaz u bioskopu sa zadatim id-em ne postoji.');
        }
        return $this->uspesnoOdgovor(new PrikazivanjeResurs($prikaz), 'Prikaz u bioskopu sa zadatim id-em je vracen.');
    }


    public function update(Request $request, $id)
    {
        $prikaz = Prikazivanje::find($id);
        if (is_null($prikaz)) {
            return $this->greskaOdgovor('Prikaz u bioskopu sa zadatim id-em ne postoji.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'dan' => 'required',
            'filmID' => 'required',
            'salaID' => 'required',
        ]);

        if($validator->fails()){
            return $this->greskaOdgovor($validator->errors());
        }

        $prikaz->dan = $input['dan'];
        $prikaz->filmID = $input['filmID'];
        $prikaz->salaID = $input['salaID'];
        $prikaz->save();

        return $this->uspesnoOdgovor(new PrikazivanjeResurs($prikaz), 'Prikaz u bioskopu je azuriran.');
    }

    public function destroy($id)
    {
        $prikaz = Prikazivanje::find($id);
        if (is_null($prikaz)) {
            return $this->greskaOdgovor('Prikaz u bioskopu sa zadatim id-em ne postoji.');
        }

        $prikaz->delete();
        return $this->uspesnoOdgovor([], 'Prikaz u bioskopu je obrisan.');
    }
}
