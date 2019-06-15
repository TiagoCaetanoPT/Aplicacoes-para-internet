@extends('layouts.template')
@section('content')

<form method="POST" action="{{route('socios.update', $user->id)}}" class="form-group" novalidate enctype="multipart/form-data">
	@method('PUT')
	@csrf
    <input type="hidden" name="id" value="{{ $user->id }}" />
    @can('view', Auth::user())
        <div class="form-group">
            <label for="inputNumSocio">Nº de Sócio</label>
            <input
                type="number" class="form-control"
                name="num_socio" id="inputNumSocio"
                placeholder="Nº de Sócio" value="{{ old('num_socio', $user->num_socio) }}"/>
                @if ($errors->has('num_socio'))
                    <strong><em>{{ $errors->first('num_socio') }}</em></strong>
                @endif
        </div>
    @else
        <div class="form-group">
            <label for="inputNumSocio">Nº de Sócio</label>
            <input
                type="number" class="form-control"
                name="num_socio" id="inputNumSocio"
                placeholder="Nº de Sócio" value="{{ old('num_socio', $user->num_socio) }}" readonly/>
                @if ($errors->has('num_socio'))
                    <strong><em>{{ $errors->first('num_socio') }}</em></strong>
                @endif
        </div>
    @endcan
    <div class="form-group">
        <label for="inputNome">Nome</label>
        <input
            type="text" class="form-control"
            name="name" id="inputNome"
            placeholder="Nome" value="{{ old('name', $user->name) }}" />
            @if ($errors->has('name'))
                <strong><em>{{ $errors->first('name') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputNomeInformal">Nome Informal</label>
        <input
            type="text" class="form-control"
            name="nome_informal" id="inputNomeInformal"
            placeholder="Nome Informal" value="{{ old('nome_informal', $user->nome_informal) }}" />
            @if ($errors->has('nome_informal'))
                <strong><em>{{ $errors->first('nome_informal') }}</em></strong>
            @endif
    </div>
    @can('view', Auth::user())
        <div class="form-group">
            <label for="inputSexo">Sexo</label>
            <select name="sexo" id="inputSexo" class="form-control">
                <option disabled selected> -- select an option -- </option>
                <option {{ old('sexo', $user->sexo) == 'M' ?"selected":"" }} value="M">Masculino</option>
                <option {{ old('sexo', $user->sexo) == 'F' ?"selected":"" }} value="F">Feminino</option>
            </select>
            @if ($errors->has('sexo'))
                <strong><em>{{ $errors->first('sexo') }}</em></strong>
            @endif
        </div>
    @else
        <div class="form-group">
            <label for="inputSexo">Sexo</label>
            <input
                type="text" class="form-control"
                name="sexo" id="inputSexo"
                placeholder="Sexo" value="{{ old('sexo', $user->sexoToStr()) }}" readonly/>
            <input
                type="hidden" class="form-control"
                name="sexo" value="{{ old('sexo', $user->sexo) }}" />
        </div>
    @endcan
    <div class="form-group">
        <label for="inputEmail">Email</label>
        <input
            type="email" class="form-control"
            name="email" id="inputEmail"
            placeholder="Email" value="{{ old('email', $user->email) }}"/>
            @if ($errors->has('email'))
                <strong><em>{{ $errors->first('email') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputNIF">NIF</label>
        <input
            type="text" class="form-control"
            name="nif" id="inputNIF"
            placeholder="NIF" value="{{ old('nif', $user->nif) }}" />
            @if ($errors->has('nif'))
                <strong><em>{{ $errors->first('nif') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputDataNascimento">Data de Nascimento</label>
        <input
            type="date" class="form-control"
            name="data_nascimento" id="inputDataNascimento"
            value="{{ old('data_nascimento', $user->data_nascimento) }}" />
            @if ($errors->has('data_nascimento'))
                <strong><em>{{ $errors->first('data_nascimento') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputTelefone">Telefone</label>
        <input
            type="text" class="form-control"
            name="telefone" id="inputTelefone"
            placeholder="Telefone" value="{{ old('telefone', $user->telefone) }}" />
            @if ($errors->has('telefone'))
                <strong><em>{{ $errors->first('telefone') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputEndereco">Endereço</label>
        <textarea
            class="form-control"
            name="endereco" id="inputEndereco"
            placeholder="Endereço"> {{ old('endereco', $user->endereco) }} </textarea>
            @if ($errors->has('endereco'))
                <strong><em>{{ $errors->first('endereco') }}</em></strong>
            @endif
    </div>
    @can('view', Auth::user())
        <div class="form-group">
            <label for="inputTipoSocio">Tipo de Sócio</label>
            <select name="tipo_socio" id="inputTipoSocio" class="form-control">
                <option disabled selected> -- select an option -- </option>
                <option {{ old('tipo_socio', $user->tipo_socio) == 'P' ?"selected":"" }} value="P">Piloto</option>
                <option {{ old('tipo_socio', $user->tipo_socio) == 'NP' ?"selected":"" }} value="NP">Não-Piloto</option>
                <option {{ old('tipo_socio', $user->tipo_socio) == 'A' ?"selected":"" }} value="A">Aeromodelista</option>
            </select>
            @if ($errors->has('tipo_socio'))
                <strong><em>{{ $errors->first('tipo_socio') }}</em></strong>
            @endif
        </div>
        <div class="form-group">
            <label for="inputQuotaPaga">Quotas em Dia</label>
            <input
                type="hidden" class="form-control"
                name="quota_paga" value="0" />
            <input
                type="checkbox"
                name="quota_paga" value="1" {{ old('quota_paga', $user->quota_paga) == '1' ?"checked":"" }} />
            @if ($errors->has('quota_paga'))
                <strong><em>{{ $errors->first('quota_paga') }}</em></strong>
            @endif
        </div>
        <div class="form-group">
            <label for="inputSocioAtivo">Sócio Ativo</label>
            <input
                type="hidden" class="form-control"
                name="ativo" value="0" />
            <input
                type="checkbox"
                name="ativo" value="1" {{ old('ativo', $user->ativo) == '1' ?"checked":"" }} />
            @if ($errors->has('ativo'))
                <strong><em>{{ $errors->first('ativo') }}</em></strong>
            @endif
        </div>
        <div class="form-group">
            <label for="inputDirecao">Direção</label>
            <input
                type="hidden" class="form-control"
                name="direcao" value="0" />
            <input
                type="checkbox"
                name="direcao" value="1" {{ old('direcao', $user->direcao) == '1' ?"checked":"" }} />
            @if ($errors->has('direcao'))
                <strong><em>{{ $errors->first('direcao') }}</em></strong>
            @endif
        </div>
    @else
        <div class="form-group">
            <label for="inputTipoSocio">Tipo de Sócio</label>
            <input
            type="text" class="form-control"
            name="tipo_socio" id="inputTipoSocio"
            placeholder="Tipo de Sócio" value="{{ old('tipo_socio', $user->tipoToStr()) }}" readonly/>
            <input
            type="hidden" class="form-control"
            name="tipo_socio" value="{{ old('tipo_socio', $user->tipo_socio) }}" />
        </div>
        <div class="form-group">
            <label for="inputQuotaPaga">Quotas em Dia</label>
            <input
            type="text" class="form-control"
            name="quota_paga" id="inputQuotaPaga"
            placeholder="Quotas em Dia" value="{{ old('quota_paga', $user->quota_paga)=='1'?'Sim':'Não' }}" readonly/>
            <input
            type="hidden" class="form-control"
            name="quota_paga" value="{{ old('quota_paga', $user->quota_paga) }}" />
        </div>
        <div class="form-group">
            <label for="inputSocioAtivo">Sócio Ativo</label>
            <input
            type="text" class="form-control"
            name="ativo" id="inputSocioAtivo"
            placeholder="Sócio Ativo" value="{{ old('ativo', $user->ativo)=='1'?'Sim':'Não' }}" readonly/>
            <input
            type="hidden" class="form-control"
            name="ativo" value="{{ old('ativo', $user->ativo) }}" />
        </div>
        <div class="form-group">
            <label for="inputDirecao">Direção</label>
            <input
            type="text" class="form-control"
            name="direcao" id="inputDirecao"
            placeholder="Direção" value="{{ old('direcao', $user->direcao)=='1'?'Sim':'Não' }}" readonly/>
            <input
            type="hidden" class="form-control"
            name="direcao" value="{{ old('direcao', $user->direcao) }}" />
        </div>
    @endcan
    @if ($user->foto_url!=NULL)
        <img src="{{asset('storage/fotos/'.$user->foto_url)}}" alt="">
    @endif
    <div class="form-group">
        <label for="inputFoto">Escolha uma foto</label>
        <input
            type="file" class="form-control"
            name="file_foto" id="inputFoto"
            accept="image/png, image/jpeg">
        @if ($errors->has('file_foto'))
            <strong><em>{{ $errors->first('file_foto') }}</em></strong>
        @endif
    </div>
    @can('viewPiloto', Auth::user())
        <div class="form-group">
            <label for="inputNumLicenca">Nº da Licença</label>
            <input
                type="text" class="form-control"
                name="num_licenca" id="inputNumLicenca"
                placeholder="Nº da Licença" value="{{ old('num_licenca', $user->num_licenca) }}" />
                @if ($errors->has('num_licenca'))
                    <strong><em>{{ $errors->first('num_licenca') }}</em></strong>
                @endif
        </div>
        <div class="form-group">
            <label for="inputTipoLicenca">Tipo de Licença</label>
            <select name="tipo_licenca" id="inputTipoLicenca" class="form-control">
                <option disabled selected> -- select an option -- </option>
                @foreach ($licencas as $licenca)
                    <option {{ old('tipo_licenca', $user->tipo_licenca) == $licenca->code ?"selected":"" }} value="{{$licenca->code}}">{{$licenca->nome}}</option>
                @endforeach
            </select>
            @if ($errors->has('tipo_licenca'))
                <strong><em>{{ $errors->first('tipo_licenca') }}</em></strong>
            @endif
        </div>
        <div class="form-group">
            <label for="inputInstrutor">Instrutor</label>
            <input
                type="hidden" class="form-control"
                name="instrutor" value="0" />
            <input
                type="checkbox"
                name="instrutor" value="1" {{ old('instrutor', $user->instrutor) == '1' ?"checked":"" }} />
            @if ($errors->has('instrutor'))
                <strong><em>{{ $errors->first('instrutor') }}</em></strong>
            @endif
        </div>
        <div class="form-group">
            <label for="inputAluno">Aluno</label>
            <input
                type="hidden" class="form-control"
                name="aluno" value="0" />
            <input
                type="checkbox"
                name="aluno" value="1" {{ old('aluno', $user->aluno) == '1' ?"checked":"" }} />
            @if ($errors->has('aluno'))
                <strong><em>{{ $errors->first('aluno') }}</em></strong>
            @endif
        </div>
        <div class="form-group">
            <label for="inputValidadeLicenca">Validade da Licença</label>
            <input
                type="date" class="form-control"
                name="validade_licenca" id="inputValidadeLicenca"
                value="{{ old('validade_licenca', $user->validade_licenca) }}" />
                @if ($errors->has('validade_licenca'))
                    <strong><em>{{ $errors->first('validade_licenca') }}</em></strong>
                @endif
        </div>
    @endcan
    @can('view', Auth::user())
        <div class="form-group">
            <label for="inputLicencaConfirmada">Licença Confirmada</label>
            <input
                type="hidden" class="form-control"
                name="licenca_confirmada" value="0" />
            <input
                type="checkbox"
                name="licenca_confirmada" value="1" {{ old('licenca_confirmada', $user->licenca_confirmada) == '1' ?"checked":"" }} />
            @if ($errors->has('licenca_confirmada'))
                <strong><em>{{ $errors->first('licenca_confirmada') }}</em></strong>
            @endif
        </div>
    @elsecan('viewPiloto', Auth::user())
        <div class="form-group">
            <label for="inputLicencaConfirmada">Licença Confirmada</label>
            <input
            type="text" class="form-control"
            name="licenca_confirmada" id="inputLicencaConfirmada"
            placeholder="Licença Confirmada" value="{{ old('licenca_confirmada', $user->licenca_confirmada)=='1'?'Sim':'Não' }}" readonly/>
            <input
            type="hidden" class="form-control"
            name="licenca_confirmada" value="{{ old('licenca_confirmada', $user->licenca_confirmada) }}" />
        </div>
    @endcan
    @can('viewPiloto', Auth::user())
        @if(file_exists(storage_path('app/docs_piloto/licenca_'.$user->id.'.pdf')))
            <div class="form-group">
                <a href="/pilotos/{{$user->id}}/licenca" id="copia_licenca" name="copia_icenca" class="btn btn-default">Cópia Digital da Licença</a>
            </div>
        @else
            <div class="form-group">
                <label for="copiaCertificado">Cópia Digital da Licença Não Existe</label>
            </div>
        @endif
        <div class="form-group">
            <label for="inputLicenca">Escolha uma Licença</label>
            <input
                type="file" class="form-control"
                name="file_licenca" id="inputLicenca"
                accept="application/pdf">
            @if ($errors->has('file_licenca'))
                <strong><em>{{ $errors->first('file_licenca') }}</em></strong>
            @endif
        </div>
        <div class="form-group">
            <label for="inputNumCertificado">Nº do Certificado Médico</label>
            <input
                type="text" class="form-control"
                name="num_certificado" id="inputNumCertificado"
                placeholder="Nº do Certificado Médico" value="{{ old('num_certificado', $user->num_certificado) }}" />
                @if ($errors->has('num_certificado'))
                    <strong><em>{{ $errors->first('num_certificado') }}</em></strong>
                @endif
        </div>
        <div class="form-group">
            <label for="inputClasseCertificado">Classe de Certificado Médico</label>
            <select name="classe_certificado" id="inputClasseCertificado" class="form-control">
                <option disabled selected> -- select an option -- </option>
                @foreach ($certificados as $certificado)
                    <option {{ old('classe_certificado', $user->classe_certificado) == $certificado->code ?"selected":"" }} value="{{$certificado->code}}">{{$certificado->nome}}</option>
                @endforeach
            </select>
            @if ($errors->has('classe_certificado'))
                <strong><em>{{ $errors->first('classe_certificado') }}</em></strong>
            @endif
        </div>
        <div class="form-group">
            <label for="inputValidadeCertificado">Validade do Certificado Médico</label>
            <input
                type="date" class="form-control"
                name="validade_certificado" id="inputValidadeCertificado"
                value="{{ old('validade_certificado', $user->validade_certificado) }}" />
                @if ($errors->has('validade_certificado'))
                    <strong><em>{{ $errors->first('validade_certificado') }}</em></strong>
                @endif
        </div>
    @endcan
    @can('view', Auth::user())
        <div class="form-group">
            <label for="inputCertificadoConfirmado">Certificado Médico Confirmado</label>
            <input
                type="hidden" class="form-control"
                name="certificado_confirmado" value="0" />
            <input
                type="checkbox"
                name="certificado_confirmado" value="1" {{ old('certificado_confirmado', $user->certificado_confirmado) == '1' ?"checked":"" }} />
            @if ($errors->has('certificado_confirmado'))
                <strong><em>{{ $errors->first('certificado_confirmado') }}</em></strong>
            @endif
        </div>
    @elsecan('viewPiloto', Auth::user())
        <div class="form-group">
            <label for="inputCertificadoConfirmado">Certificado Médico Confirmado</label>
            <input
                type="text" class="form-control"
                name="certificado_confirmado" id="inputCertificadoConfirmado"
                placeholder="Certificado Confirmado" value="{{ old('certificado_confirmado', $user->certificado_confirmado)=='1'?'Sim':'Não' }}" readonly/>
            <input
                type="hidden" class="form-control"
                name="certificado_confirmado" value="{{ old('certificado_confirmado', $user->certificado_confirmado) }}" />
        </div>
    @endcan
    @can('viewPiloto', Auth::user())
        @if(file_exists(storage_path('app/docs_piloto/certificado_'.$user->id.'.pdf')))
            <div class="form-group">
                <a href="/pilotos/{{$user->id}}/certificado" id="copia_certificado" name="copia_certificado" class="btn btn-default">Cópia Digital do Certficado Médico</a>
            </div>
        @else
            <div class="form-group">
                <label for="copiaCertificado">Cópia Digital do Certificado Médico Não Existe</label>
            </div>
        @endif
        <div class="form-group">
            <label for="inputCertificado">Escolha um Certificado Médico</label>
            <input
                type="file" class="form-control"
                name="file_certificado" id="inputCertificado"
                accept="application/pdf">
                @if ($errors->has('file_certificado'))
                    <strong><em>{{ $errors->first('file_certificado') }}</em></strong>
                @endif
        </div>
    @endcan
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="ok">Guardar</button>
                <a href="/socios" id="cancel" name="cancel" class="btn btn-default">Cancelar</a>
            </div>
        </div>
        </form>
        @can('view', Auth::user())
            @if($user->email_verified_at == null)
                <div class="col-md-6 text-right">
                    <form method="POST" action="{{route('socios.mail', $user->id)}}" class="form-group" novalidate>
                        @csrf
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" name="email_confirmation"><i class="fas fa-envelope-open"></i> Enviar Email</button>
                        </div>
                    </form>
                </div>
        @endif
    @endcan
</div>
@endsection
