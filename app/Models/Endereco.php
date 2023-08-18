<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;
    protected $fillable = ['tipo_logradouro_id', 'cidade_id', 'pessoa_id', 'logradouro', 'numero', 'cep', 'bairro'];    
    public function tipoLogradouro()
    {
        return $this->belongsTo(TipoLogradouro::class, 'tipo_logradouro_id');
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'cidade_id');
    }

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }
}
