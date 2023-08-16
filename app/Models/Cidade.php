<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    use HasFactory;
    protected $table = 'cidade';
    protected $fillable = ['nome'];

    public function enderecos()
    {
        return $this->hasMany(Endereco::class);
    }
}
