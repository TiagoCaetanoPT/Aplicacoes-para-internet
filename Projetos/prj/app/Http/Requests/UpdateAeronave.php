<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAeronave extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->direcao;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'matricula' => 'required|string|max:8',
            'marca' => 'required|string|max:40',
            'modelo' => 'required|string|max:40',
            'num_lugares' => 'required|integer|digits_between:1,11|min:1',
            'conta_horas' => 'required|integer|digits_between:1,11',
            'preco_hora' => 'required|numeric|regex:/^\d*(\.\d{0,2})?$/',
            'tempos' => 'required|array|size:10',
            'tempos.*' => 'required|integer|distinct|min:1',
            'precos' => 'required|array|size:10',
            'precos.*' => 'required|numeric|distinct|min:1|regex:/^\d*(\.\d{0,2})?$/',
        ];
    }

    public function messages()
    {
        return [
            'marca.required' => 'Preencha o campo Marca.',
            'marca.max' => 'Campo Marca tem que ter entre 1 e 40 caracteres.',
            'modelo.required' => 'Preencha o campo Modelo.',
            'modelo.max' => 'Campo Modelo tem que ter entre 1 e 40 caracteres.',
            'num_lugares.required' => 'Preencha o campo Nº de Lugares.',
            'num_lugares.integer' => 'Preencha o campo Nº de Lugares com um número inteiro.',
            'num_lugares.digits_between' => 'Campo Nº de Lugares tem que ter entre 1 e 11 dígitos.',
            'num_lugares.min' => 'Preencha o campo Nº de Lugares com o valor mínimo de 1.',
            'conta_horas.required' => 'Preencha o campo Conta Horas.',
            'conta_horas.integer' => 'Preencha o campo Conta Horas com um número inteiro.',
            'conta_horas.digits_between' => 'Campo Conta Horas tem que ter entre 1 e 11 dígitos.',
            'preco_hora.required' => 'Preencha o campo Preço Hora.',
            'preco_hora.numeric' => 'Campo Preço Hora tem que ser numérico.',
            'preco_hora.regex' => 'Campo Preço Hora tem que ter no máximo 2 casas decimais.',
            'tempos.required' => 'Tempos é obrigatório',
            'tempos.size' => 'Tempos tem que ter 10 elementos',
            'precos.required' => 'Preços é obrigatório',
            'precos.size' => 'Preços tem que ter 10 elementos',
        ];
    }
}
