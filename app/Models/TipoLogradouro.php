<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoLogradouro extends Model
{
    use HasFactory;
    protected $fillable = ['nome'];

    public function enderecos()
    {
        return $this->hasMany(Endereco::class);
    }
}
