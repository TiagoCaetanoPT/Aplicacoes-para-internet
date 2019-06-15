<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
	use Notifiable;
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'password', 'num_socio', 'nome_informal', 'sexo', 'data_nascimento', 'nif', 'telefone', 'endereco', 'tipo_socio', 'quota_paga', 'ativo', 'password_inicial', 'direcao', 'foto_url', 'num_licenca', 'tipo_licenca', 'instrutor', 'aluno', 'validade_licenca', 'licenca_confirmada', 'num_certificado', 'classe_certificado', 'validade_certificado', 'certificado_confirmado'];

    public function movimentosPiloto(){
        return $this->hasMany('App\Movimento', 'piloto_id');
    }

    public function movimentosInstrutor(){
        return $this->hasMany('App\Movimento', 'instrutor_id');
    }

    public function aeronaves()
    {
        return $this->belongsToMany('App\Aeronave', 'aeronaves_pilotos', 'piloto_id', 'matricula');
    }

	public function tipoToStr()
    {
        switch ($this->tipo_socio) {
            case 'P':
                return 'Piloto';
            case 'NP':
                return 'Não Piloto';
            case 'A':
                return 'Aeromodelista';
        }

        return '';
    }

    public function sexoToStr()
    {
        switch ($this->sexo) {
            case 'M':
                return 'Masculino';
            case 'F':
                return 'Feminino';
        }

        return '';
    }
}
