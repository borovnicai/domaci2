<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prikazivanje extends Model
{
    use HasFactory;

    protected $table = 'prikazivanja';

    protected $fillable = ['dan', 'filmID' , 'salaID'];
}
