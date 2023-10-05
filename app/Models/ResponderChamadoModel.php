<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponderChamadoModel extends Model
{
    protected $table = 'chamados';
    use HasFactory;

    public function anexos()
    {
        return $this->hasMany(AnexoModel::class, 'chamado_id', 'id');
    }
}
