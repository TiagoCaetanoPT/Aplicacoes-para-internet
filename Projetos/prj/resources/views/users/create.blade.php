@extends('layouts.template')
@section('content')

<form method="POST" action="{{route('socios.store')}}" class="form-group" novalidate enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="inputNumSocio">Nº de Sócio</label>
        <input
            type="number" class="form-control"
            name="num_socio" id="inputNumSocio"
            placeholder="Nº de Sócio" value="{{ old('num_socio') }}" />
            @if ($errors->has('num_socio'))
                <strong><em>{{ $errors->first('num_socio') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputNome">Nome</label>
        <input
            type="text" class="form-control"
            name="name" id="inputNome"
            placeholder="Nome" value="{{ old('name') }}" />
            @if ($errors->has('name'))
                <strong><em>{{ $errors->first('name') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputNomeInformal">Nome Informal</label>
        <input
            type="text" class="form-control"
            name="nome_informal" id="inputNomeInformal"
            placeholder="Nome Informal" value="{{ old('nome_informal') }}" />
            @if ($errors->has('nome_informal'))
                <strong><em>{{ $errors->first('nome_informal') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputSexo">Sexo</label>
        <select name="sexo" id="inputSexo" class="form-control">
            <option disabled selected> -- select an option -- </option>
            <option {{ old('sexo') == 'M' ?"selected":"" }} value="M">Masculino</option>
            <option {{ old('sexo') == 'F' ?"selected":"" }} value="F">Feminino</option>
        </select>
        @if ($errors->has('sexo'))
            <strong><em>{{ $errors->first('sexo') }}</em></strong>
        @endif
    </div>
    <div class="form-group">
        <label for="inputEmail">Email</label>
        <input
            type="email" class="form-control"
            name="email" id="inputEmail"
            placeholder="Email" value="{{ old('email') }}"/>
            @if ($errors->has('email'))
                <strong><em>{{ $errors->first('email') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputNIF">NIF</label>
        <input
            type="text" class="form-control"
            name="nif" id="inputNIF"
            placeholder="NIF" value="{{ old('nif') }}" />
            @if ($errors->has('nif'))
                <strong><em>{{ $errors->first('nif') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputDataNascimento">Data de Nascimento</label>
        <input
            type="date" class="form-control"
            name="data_nascimento" id="inputDataNascimento"
            value="{{ old('data_nascimento') }}"/>
            @if ($errors->has('data_nascimento'))
                <strong><em>{{ $errors->first('data_nascimento') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputTelefone">Telefone</label>
        <input
            type="text" class="form-control"
            name="telefone" id="inputTelefone"
            placeholder="Telefone" value="{{ old('telefone') }}" />
            @if ($errors->has('telefone'))
                <strong><em>{{ $errors->first('telefone') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputEndereco">Endereço</label>
        <textarea
            class="form-control"
            name="endereco" id="inputEndereco"
            placeholder="Endereço"> {{ old('endereco') }} </textarea>
            @if ($errors->has('endereco'))
                <strong><em>{{ $errors->first('endereco') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputTipoSocio">Tipo de Sócio</label>
        <select name="tipo_socio" id="inputTipoSocio" class="form-control">
            <option disabled selected> -- select an option -- </option>
            <option {{ old('tipo_socio') == 'P' ?"selected":"" }} value="P">Piloto</option>
            <option {{ old('tipo_socio') == 'NP' ?"selected":"" }} value="NP">Não-Piloto</option>
            <option {{ old('tipo_socio') == 'A' ?"selected":"" }} value="A">Aeromodelista</option>
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
            type="checkbox" id="inputQuotaPaga"
            name="quota_paga" value="1" {{ old('quota_paga') == '1' ?"checked":"" }} />
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
            type="checkbox" id="inputSocioAtivo"
            name="ativo" value="1" {{ old('ativo') == '1' ?"checked":"" }} />
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
            type="checkbox" id="inputDirecao"
            name="direcao" value="1" {{ old('direcao') == '1' ?"checked":"" }} />
        @if ($errors->has('direcao'))
            <strong><em>{{ $errors->first('direcao') }}</em></strong>
        @endif
    </div>
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
    <div class="form-group">
        <label for="inputNumLicenca">Nº da Licença</label>
        <input
            type="text" class="form-control"
            name="num_licenca" id="inputNumLicenca"
            placeholder="Nº da Licença" value="{{ old('num_licenca') }}" />
            @if ($errors->has('num_licenca'))
                <strong><em>{{ $errors->first('num_licenca') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputTipoLicenca">Tipo de Licença</label>
        <select name="tipo_licenca" id="inputTipoLicenca" class="form-control">
            <option disabled selected> -- select an option -- </option>
            @foreach ($licencas as $licenca)
                <option {{ old('tipo_licenca') == $licenca->code ?"selected":"" }} value="{{$licenca->code}}">{{$licenca->nome}}</option>
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
            type="checkbox" id="inputInstrutor"
            name="instrutor" value="1" {{ old('instrutor') == '1' ?"checked":"" }} />
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
            type="checkbox" id="inputAluno"
            name="aluno" value="1" {{ old('aluno') == '1' ?"checked":"" }} />
        @if ($errors->has('aluno'))
            <strong><em>{{ $errors->first('aluno') }}</em></strong>
        @endif
    </div>
    <div class="form-group">
        <label for="inputValidadeLicenca">Validade da Licença</label>
        <input
            type="date" class="form-control"
            name="validade_licenca" id="inputValidadeLicenca"
            value="{{ old('validade_licenca') }}" />
            @if ($errors->has('validade_licenca'))
                <strong><em>{{ $errors->first('validade_licenca') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputLicencaConfirmada">Licença Confirmada</label>
        <input
            type="hidden" class="form-control"
            name="licenca_confirmada" value="0" />
        <input
            type="checkbox" id="inputLicencaConfirmada"
            name="licenca_confirmada" value="1" {{ old('licenca_confirmada') == '1' ?"checked":"" }} />
        @if ($errors->has('licenca_confirmada'))
            <strong><em>{{ $errors->first('licenca_confirmada') }}</em></strong>
        @endif
    </div>
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
            placeholder="Nº do Certificado Médico" value="{{ old('num_certificado') }}" />
            @if ($errors->has('num_certificado'))
                <strong><em>{{ $errors->first('num_certificado') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputClasseCertificado">Classe de Certificado Médico</label>
        <select name="classe_certificado" id="inputClasseCertificado" class="form-control">
            <option disabled selected> -- select an option -- </option>
            @foreach ($certificados as $certificado)
                <option {{ old('classe_certificado') == $certificado->code ?"selected":"" }} value="{{$certificado->code}}">{{$certificado->nome}}</option>
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
            value="{{ old('validade_certificado') }}" />
            @if ($errors->has('validade_certificado'))
                <strong><em>{{ $errors->first('validade_certificado') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputCertificadoConfirmado">Certificado Médico Confirmado</label>
        <input
            type="hidden" class="form-control"
            name="certificado_confirmado" value="0" />
        <input
            type="checkbox" id="inputCertificadoConfirmado"
            name="certificado_confirmado" value="1" {{ old('certificado_confirmado') == '1' ?"checked":"" }} />
        @if ($errors->has('certificado_confirmado'))
            <strong><em>{{ $errors->first('certificado_confirmado') }}</em></strong>
        @endif
    </div>
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
    <div class="form-group">
        <button type="submit" class="btn btn-primary" name="ok">Adicionar</button>
        <a href="/socios" id="cancel" name="cancel" class="btn btn-default">Cancelar</a>
    </div>
</form>
@endsection
