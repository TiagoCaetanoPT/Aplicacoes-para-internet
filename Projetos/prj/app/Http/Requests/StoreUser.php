<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'name' => 'required|string|regex:/^[A-Za-zçÇáÁéÉíÍóÓúÚàÀèÈìÌòÒùÙãÃõÕâÂêÊîÎôÔûÛ\s]+$/u|max:255',
            'nome_informal' => 'required|max:40',
            'email' => 'required|regex:/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}/|max:255|unique:users,email',
            'num_socio' => 'required|integer|digits_between:1,11|unique:users,num_socio',
            'sexo' => 'required|in:M,F',
            'data_nascimento' => 'required|date_format:"Y-m-d"|before:today',
            'nif' => 'nullable|max:9',
            'telefone' => 'nullable|max:20',
            'endereco' => 'nullable|string',
            'file_foto' => 'image',
            'tipo_socio' => 'required|in:P,NP,A',
            'quota_paga' => 'in:0,1',
            'ativo' => 'in:0,1',
            'direcao' => 'in:0,1',
            'num_licenca' => 'nullable|max:30',
            'tipo_licenca' => 'nullable|exists:tipos_licencas,code|max:20',
            'instrutor' => ['nullable','in:0,1',function($attribute, $value, $fail) {
                if($value=='1' && $this->aluno == '1') {
                    $fail('Piloto nào pode ser Aluno e Instrutor ao mesmo tempo.');
                }
            },
        ],
            'aluno' => ['nullable','in:0,1',function($attribute, $value, $fail) {
                if($value=='1' && $this->instrutor == '1') {
                    $fail('Piloto nào pode ser Aluno e Instrutor ao mesmo tempo.');
                }
            },
        ],
            'validade_licenca' => 'nullable|date_format:"Y-m-d"',
            'licenca_confirmada' => 'nullable|in:0,1',
            'num_certificado' => 'nullable|max:30',
            'classe_certificado' => 'nullable|exists:classes_certificados,code|max:20',
            'validade_certificado' => 'nullable|date_format:"Y-m-d"',
            'certificado_confirmado' => 'nullable|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Preencha o campo Nome.',
            'name.regex' => 'Insira um Nome válido.',
            'name.max' => 'Campo Nome tem que ter entre 1 e 255 caracteres.',
            'nome_informal.required' => 'Preencha o campo Nome Informal.',
            'nome_informal.max' => 'Campo Nome Informal tem que ter entre 1 e 40 caracteres',
            'email.required' => 'Preencha o campo Email.',
            'email.regex' => 'Email inválido',
            'email.max' => 'Campo Email tem que ter entre 1 e 255 caracteres.',
            'email.unique' => 'Email já existente. Insira outro Email.',
            'num_socio.required' => 'Preencha o campo Nº de Sócio.',
            'num_socio.integer' => 'Preencha o campo Nº de Sócio com um número inteiro.',
            'num_socio.digits_between' => 'Campo Nº de Sócio tem que ter entre 1 e 11 dígitos.',
            'num_socio.unique' => 'Nº de Sócio já existente. Insira outro Nº de Sócio',
            'sexo.required' => 'Preencha o campo Sexo.',
            'sexo.in' => 'Campo Sexo tem que ser Masculino ou Feminino.',
            'data_nascimento.required' => 'Preencha o campo Data de Nascimento.',
            'data_nascimento.date_format' => 'Formato da Data de Nascimento inválido.',
            'data_nascimento.before' => 'Preencha o campo Data de Nascimento com uma inferior a hoje.',
            'nif.max' => 'Campo NIF tem que ter entre 1 e 9 caracteres.',
            'telefone.max' => 'Campo Telefone tem que ter entre 1 e 20 caracteres.',
            'endereco.string' => 'Campo Endereço inválido.',
            'tipo_socio.required' => 'Preencha o campo Tipo de Sócio.',
            'tipo_socio.in' => 'Escolha um valor válido no campo Tipo de Sócio.',
            'quota_paga.in' => 'Indique se o Sócio tem a Quota Paga ou não.',
            'ativo.in' => 'Indique se o Sócio é Ativo ou não.',
            'direcao.in' => 'Indique se o Sócio pertence à Direção ou não.',
            'num_licenca.max' => 'Campo Nº de Licença tem que ter entre 1 e 30 caracteres.',
            'tipo_licenca.exists' => 'Indique um Tipo de Licença válido.',
            'tipo_licenca.max' => 'Campo Tipo de Licença tem que ter entre 1 e 20 caracteres.',
            'instrutor.in' => 'Indique se o Sócio é Instrutor ou não.',
            'aluno.in' => 'Indique se o Sócio é Aluno ou não.',
            'validade_licenca.date_format' => 'Formato da Validade de Licença inválido.',
            'licenca_confirmada.in' => 'Indique se a Licença do Sócio foi confirmada ou não.',
            'num_certificado.max' => 'Campo Nº de Certificado tem que ter entre 1 e 30 caracteres.',
            'classe_certificado.exists' => 'Indique uma Classe de Certificado Médico válida.',
            'classe_certificado.max' => 'Campo Classe de Certificado Médico tem que ter entre 1 e 20 caracteres.',
            'validade_certificado.date_format' => 'Formato da Validade de Certificado inválido.',
            'certificado_confirmado.in' => 'Indique se o Certificado Médico do Sócio foi confirmado ou não.',
        ];
    }
}
