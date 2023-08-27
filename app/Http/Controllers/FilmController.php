<?php

namespace App\Http\Controllers;

use App\Http\Resources\FilmResurs;
use App\Models\FilmModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FilmController extends BaseController
{
    public function index()
    {
        $filmovi = FilmModel::all();
        return $this->uspesnoOdgovor(FilmResurs::collection($filmovi), 'Vraceni svi podaci o filmovima.');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nazivFilma' => 'required',
            'trajanje' => 'required',
            'reziser' => 'required',
        ]);
        if($validator->fails()){
            return $this->greskaOdgovor($validator->errors());
        }

        $film = FilmModel::create($input);

        return $this->uspesnoOdgovor(new FilmResurs($film), 'Novi film je kreiran.');
    }


    public function show($id)
    {
        $film = FilmModel::find($id);
        if (is_null($film)) {
            return $this->greskaOdgovor('Film sa zadatim id-em ne postoji.');
        }
        return $this->uspesnoOdgovor(new FilmResurs($film), 'Film sa zadatim id-em je vracen.');
    }


    public function update(Request $request, $id)
    {
        $film = FilmModel::find($id);
        if (is_null($film)) {
            return $this->greskaOdgovor('Film sa zadatim id-em ne postoji.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'nazivFilma' => 'required',
            'trajanje' => 'required',
            'reziser' => 'required',
        ]);

        if($validator->fails()){
            return $this->greskaOdgovor($validator->errors());
        }

        $film->nazivFilma = $input['nazivFilma'];
        $film->trajanje = $input['trajanje'];
        $film->reziser = $input['reziser'];
        $film->save();

        return $this->uspesnoOdgovor(new FilmResurs($film), 'Film je azuriran.');
    }

    public function destroy($id)
    {
        $film = FilmModel::find($id);
        if (is_null($film)) {
            return $this->greskaOdgovor('Film sa zadatim id-em ne postoji.');
        }
        $film->delete();
        return $this->uspesnoOdgovor([], 'Film je obrisan.');
    }
}
