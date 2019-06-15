<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMovimento extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->direcao || $this->piloto_id == $this->user()->id || $this->instrutor_id == $this->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'data' => 'required|date_format:"Y-m-d"|before_or_equal:today',
            'hora_descolagem' => 'required|date_format:H:i',
            'hora_aterragem' => 'required|after:hora_descolagem|date_format:H:i',
            'aeronave' => ['required','string','max:8',Rule::exists('aeronaves_pilotos','matricula')->where(function($query) {
                $query->where('piloto_id', $this->piloto_id);
            })
        ],
            'num_diario' => 'required|integer|digits_between:1,11',
            'num_servico' => 'required|integer|digits_between:1,11',
            'piloto_id' => ['required','integer','digits_between:1,20',Rule::exists('users', 'id')->where(function($query) {
                if($this->user()->direcao != '1' && $this->user()->instrutor != '1'){
                    $query->where('id', $this->user()->id);
                }
                else{
                    $query->where('tipo_socio', 'P');
                }
            })
        ],
            'natureza' => 'required|in:T,I,E',
            'aerodromo_partida' => 'required|max:20|exists:aerodromos,code',
            'aerodromo_chegada' => 'required|max:20|exists:aerodromos,code',
            'num_aterragens' => 'required|integer|digits_between:1,11',
            'num_descolagens' => 'required|integer|digits_between:1,11',
            'num_pessoas' => 'required|integer|digits_between:1,11|min:1',
            'conta_horas_inicio' => 'required|integer|digits_between:1,11',
            'conta_horas_fim' => 'required|integer|digits_between:1,11|gte:conta_horas_inicio',
            'tempo_voo' => 'required|integer|digits_between:1,11',
            'preco_voo' => 'required|numeric|regex:/^\d*(\.\d{0,2})?$/',
            'modo_pagamento' => 'required|in:N,M,T,P',
            'num_recibo' => 'required|max:20',
            'observacoes' => 'nullable|string',
            'problemas' => 'nullable|in:C,T,M,O',
            'tipo_instrucao' => 'nullable|in:D,S|required_if:natureza,I',
            'instrutor_id' => ['nullable','integer','digits_between:1,20','required_if:natureza,I','different:piloto_id',Rule::exists('users', 'id')->where(function($query) {
                    $query->where('instrutor', '1');
            })
        ],
            'confirmado' => 'required|in:0,1',
       ];
    }

    public function messages()
    {
        return [
                'data.required' => 'Preencha o campo Data.',
                'data.date_format' => 'Formato do campo Data inválido.',
                'data.before_or_equal' => 'Preencha o campo Data com uma data igual ou superior a hoje.',
                'hora_descolagem.required' => 'Preencha o campo Hora de Descolagem.',
                'hora_descolagem.date_format' => 'Formato do campo Hora de Descolagem inválido.',
                'hora_aterragem.required' => 'Preencha o campo Hora de Aterragem.',
                'hora_aterragem.date_format' => 'Formato do campo Hora de Aterragem inválido.',
                'hora_aterragem.after' => 'Preencha o campo Hora de Aterragem com um valor válido.',
                'aeronave.required' => 'Preencha o campo Aeronave.',
                'aeronave.max' => 'Campo Aeronave tem que ter entre 1 e 8 caracteres.',
                'aeronave.exists' => 'Preencha o campo Aeronave com um valor válido.',
                'num_diario.required' => 'Preencha o campo Nº de Diário.',
                'num_diario.integer' => 'Preencha o campo Nº de Diário com um número inteiro.',
                'num_diario.digits_between' => 'Campo Nº de Diário tem que ter entre 1 e 11 dígitos.',
                'num_servico.required' => 'Preencha o campo Nº de Serviço.',
                'num_servico.integer' => 'Preencha o campo Nº de Serviço com um número inteiro.',
                'num_servico.digits_between' => 'Campo Nº de Serviço tem que ter entre 1 e 11 dígitos.',
                'piloto_id.required' => 'Preencha o campo ID do Piloto.',
                'piloto_id.integer' => 'Preencha o ID do Piloto com um número inteiro.',
                'piloto_id.digits_between' => 'Campo ID do Piloto tem que ter entre 1 e 20 dígitos.',
                'piloto_id.exists' => 'Preencha o campo ID do Piloto com um valor válido.',
                'natureza.required' => 'Preencha o campo Natureza de Voo.',
                'natureza.in' => 'Indique uma Natureza de Voo válida.',
                'aerodromo_partida.required' => 'Preencha o campo Aeródromo de Partida.',
                'aerodromo_partida.max' => 'Campo Aeródromo de Partida tem que ter entre 1 e 20 caracteres',
                'aerodromo_partida.exists' => 'Preencha o campo Aeródromo de Partida com um valor válido.',
                'aerodromo_chegada.required' => 'Preencha o campo Aeródromo de Chegada.',
                'aerodromo_chegada.max' => 'Campo Aeródromo de Chegada tem que ter entre 1 e 20 caracteres',
                'aerodromo_chegada.exists' => 'Preencha o campo Aeródromo de Chegada com um valor válido.',
                'num_aterragens.required' => 'Preencha o campo Nº de Aterragens',
                'num_aterragens.integer' => 'Preencha o campo Nº de Aterragens com um número inteiro.',
                'num_aterragens.digits_between' => 'Campo Nº de Aterragens tem que ter entre 1 e 11 dígitos.',
                'num_descolagens.required' => 'Preencha o campo Nº de Descolagens',
                'num_descolagens.integer' => 'Preencha o campo Nº de Descolagens com um número inteiro.',
                'num_descolagens.digits_between' => 'Campo Nº de Descolagens tem que ter entre 1 e 11 dígitos.',
                'num_pessoas.required' => 'Preencha o campo Nº de Pessoas',
                'num_pessoas.integer' => 'Preencha o campo Nº de Pessoas com um número inteiro.',
                'num_pessoas.digits_between' => 'Campo Nº de Pessoas tem que ter entre 1 e 11 dígitos.',
                'num_pessoas.min' => 'Preencha o campo Nº de Pessoas com o valor mínimo de 1.',
                'conta_horas_inicio.required' => 'Preencha o campo Conta-Horas Início',
                'conta_horas_inicio.integer' => 'Preencha o campo Conta-Horas Início com um número inteiro.',
                'conta_horas_inicio.digits_between' => 'Campo Conta-Horas Início tem que ter entre 1 e 11 dígitos.',
                'conta_horas_fim.required' => 'Preencha o campo Conta-Horas Fim',
                'conta_horas_fim.integer' => 'Preencha o campo Conta-Horas Fim com um número inteiro.',
                'conta_horas_fim.digits_between' => 'Campo Conta-Horas Fim tem que ter entre 1 e 11 dígitos.',
                'conta_horas_fim.gte' => 'Preencha o campo Conta-Horas Final com um valor válido.',
                'tempo_voo.required' => 'Preencha o campo Tempo de Voo',
                'tempo_voo.integer' => 'Preencha o campo Tempo de Voo com um número inteiro.',
                'tempo_voo.digits_between' => 'Campo Tempo de Voo tem que ter entre 1 e 11 dígitos.',
                'preco_voo.required' => 'Preencha o campo Preço Voo.',
                'preco_voo.numeric' => 'Campo Preço Voo tem que ser numérico.',
                'preco_voo.regex' => 'Campo Preço Voo tem que ter no máximo 2 casas decimais.',
                'modo_pagamento.required' => 'Preencha o campo Modo de Pagamento.',
                'modo_pagamento.in' => 'Indique um Modo de Pagamento válido.',
                'num_recibo.required' => 'Preencha o campo Nº de Recibo.',
                'num_recibo.max' => 'Campo Nº de Recibo tem que ter entre 1 e 20 caracteres',
                'tipo_instrucao.in' => 'Indique um Tipo de Instrução válido.',
                'tipo_instrucao.required_if' => 'Indique um Tipo de Instrução.',
                'instrutor_id.integer' => 'Preencha o ID do Instrutor com um número inteiro.',
                'instrutor_id.digits_between' => 'Campo ID do Instrutor tem que ter entre 1 e 20 dígitos.',
                'instrutor_id.required_if' => 'Indique o ID do Instrutor.',
                'instrutor_id.different' => 'ID do Instrutor não pode ser igual ao ID do Piloto.',
                'instrutor_id.exists' => 'Preencha o Campo ID do Instrutor com um valor válido.',
            ];
    }
}
