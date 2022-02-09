<?php

namespace App\Infra\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscricoes extends Model
{
    protected $table = 'inscricoes';
    protected $guarded = ['id'];
    public $timestamps = false;
    use HasFactory;
}
