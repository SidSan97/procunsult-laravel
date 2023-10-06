<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeuChamadoModel extends Model
{
    protected $table = 'chamados';

    use HasFactory;

    public function historicoChamado()
    {
        return $this->hasMany(HistoricoChamadaModel::class, 'chamado_id', 'id');
    }
}
