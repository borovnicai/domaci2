<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmModel extends Model
{
    use HasFactory;

    protected $table = 'filmovi';

    protected $fillable = ['nazivFilma', 'trajanje' , 'reziser'];
}
