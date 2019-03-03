<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avaliacoes extends Model
{
    protected $table = "avaliacoes";
    protected $primaryKey   = "id";
    protected $fillable = ['id','bo_chegou_no_tempo','star_embalagem','star_tempo_entrega','star_comida','star_custo_beneficio','id_empresa','updated_at','created_at']; 
} 
