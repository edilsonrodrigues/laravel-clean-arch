<?php

namespace App\Infra\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanosPagamento extends Model
{
    use HasFactory;
    protected $table = 'planos_pagamento';
}
