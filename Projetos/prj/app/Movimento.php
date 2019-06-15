<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimento extends Model
{
    protected $fillable = ['data', 'hora_descolagem', 'hora_aterragem', 'aeronave', 'num_diario', 'num_servico', 'piloto_id', 'num_licenca_piloto', 'validade_licenca_piloto', 'tipo_licenca_piloto', 'num_certificado_piloto', 'validade_certificado_piloto', 'classe_certificado_piloto', 'natureza', 'aerodromo_partida', 'aerodromo_chegada', 'num_aterragens', 'num_descolagens', 'num_pessoas', 'conta_horas_inicio', 'conta_horas_fim', 'tempo_voo', 'preco_voo', 'modo_pagamento', 'num_recibo', 'observacoes', 'confirmado', 'tipo_instrucao', 'instrutor_id', 'num_licenca_instrutor', 'validade_licenca_instrutor', 'tipo_licenca_instrutor', 'num_certificado_instrutor', 'validade_certificado_instrutor', 'classe_certificado_instrutor', 'problemas'];

    public function aeronave(){
        return $this->belongsTo('App\Aeronave', 'matricula')->withTrashed();
    }

    public function piloto(){
        return $this->belongsTo('App\User', 'piloto_id')->withTrashed();
    }

    public function instrutor(){
        return $this->belongsTo('App\User', 'instrutor_id')->withTrashed();
    }

    public function naturezaToStr()
    {
        switch ($this->natureza) {
            case 'T':
                return 'Treino';
            case 'I':
                return 'Instrução';
            case 'E':
                return 'Especial';
        }

        return '';
    }

    public function tipoInstrucaoToStr()
    {
        switch ($this->tipo_instrucao) {
            case 'D':
                return 'Duplo Comando';
            case 'S':
                return 'Solo';
        }

        return '';
    }
}
