@extends('layouts.template')
@section('content')

<form method="POST" action="{{route('movimentos.update', $movimento->id)}}" novalidate class="form-group">
	@method('PUT')
	@csrf
    <input type="hidden" name="id" value="{{ $movimento->id }}" />
    <div class="form-group">
        <label for="inputData">Data do Voo</label>
        <input
            type="date" class="form-control"
            name="data" id="inputData"
            value="{{ old('data', $movimento->data) }}" />
            @if ($errors->has('data'))
                <strong><em>{{ $errors->first('data') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputHoraDescolagem">Hora de Descolagem</label>
        <input
            type="time" class="form-control"
            name="hora_descolagem" id="inputHoraDescolagem"
            value="{{ old('hora_descolagem', substr($movimento->hora_descolagem, -8, 5)) }}" />
            @if ($errors->has('hora_descolagem'))
                <strong><em>{{ $errors->first('hora_descolagem') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputHoraAterragem">Hora de Aterragem</label>
        <input
            type="time" class="form-control"
            name="hora_aterragem" id="inputHoraAterragem"
            value="{{ old('hora_aterragem', substr($movimento->hora_aterragem, -8, 5)) }}" />
            @if ($errors->has('hora_aterragem'))
                <strong><em>{{ $errors->first('hora_aterragem') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputAeronave">Aeronave</label>
        <select name="aeronave" id="inputAeronave" class="form-control">
            <option disabled selected> -- select an option -- </option>
            @foreach ($aeronaves as $aeronave)
                <option {{ old('aeronave', $movimento->aeronave) == $aeronave->matricula ?"selected":"" }} value="{{$aeronave->matricula}}">{{$aeronave->matricula}} - {{$aeronave->marca}} {{$aeronave->modelo}}</option>
            @endforeach
        </select>
        @if ($errors->has('aeronave'))
            <strong><em>{{ $errors->first('aeronave') }}</em></strong>
        @endif
    </div>
    <div class="form-group">
        <label for="inputNumDiario">Nº do Diário</label>
        <input
            type="number" class="form-control"
            name="num_diario" id="inputNumDiario"
            placeholder="Nº de Diário" value="{{ old('num_diario', $movimento->num_diario) }}" />
            @if ($errors->has('num_diario'))
                <strong><em>{{ $errors->first('num_diario') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputNumServico">Nº do Serviço</label>
        <input
            type="number" class="form-control"
            name="num_servico" id="inputNumServico"
            placeholder="Nº de Serviço" value="{{ old('num_servico', $movimento->num_servico) }}" />
            @if ($errors->has('num_servico'))
                <strong><em>{{ $errors->first('num_servico') }}</em></strong>
            @endif
    </div>
    @if(Auth::user()->direcao == '1' || Auth::user()->instrutor == '1')
        <div class="form-group">
            <label for="inputPilotoID">Piloto</label>
            <select name="piloto_id" id="inputPilotoID" class="form-control">
                <option disabled selected> -- select an option -- </option>
                @foreach ($pilotos as $piloto)
                    <option {{ old('piloto_id', $movimento->piloto_id) == $piloto->id ?"selected":"" }} value="{{$piloto->id}}">{{$piloto->num_socio}} - {{$piloto->nome_informal}}</option>
                @endforeach
            </select>
            @if ($errors->has('piloto_id'))
                <strong><em>{{ $errors->first('piloto_id') }}</em></strong>
            @endif
        </div>
    @else
        <div class="form-group">
            <label for="inputPilotoID">Piloto</label>
            <input
                type="text" class="form-control"
                name="piloto_id" id="inputPilotoID"
                placeholder="Piloto" value="{{ $pilotos->num_socio.' - '.$pilotos->nome_informal }}" readonly/>
                @if ($errors->has('piloto_id'))
                    <strong><em>{{ $errors->first('piloto_id') }}</em></strong>
                @endif
            <input
                type="hidden" class="form-control"
                name="piloto_id" value="{{Auth::id()}}" />
        </div>
    @endif
    <div class="form-group">
        <label for="inputNatureza">Natureza do Voo</label>
        <select name="natureza" id="inputNatureza" class="form-control">
            <option disabled selected> -- select an option -- </option>
            <option {{ old('natureza', $movimento->natureza) == 'T' ?"selected":"" }} value="T">Treino</option>
            <option {{ old('natureza', $movimento->natureza) == 'I' ?"selected":"" }} value="I">Instrução</option>
            <option {{ old('natureza', $movimento->natureza) == 'E' ?"selected":"" }} value="E">Especial</option>
        </select>
        @if ($errors->has('natureza'))
            <strong><em>{{ $errors->first('natureza') }}</em></strong>
        @endif
    </div>
    <div class="form-group">
        <label for="inputAerodromoPartida">Aeródromo de Partida</label>
        <select name="aerodromo_partida" id="inputAerodromoPartida" class="form-control">
            <option disabled selected> -- select an option -- </option>
            @foreach ($aerodromos as $aerodromo)
                <option {{ old('aerodromo_partida', $movimento->aerodromo_partida) == $aerodromo->code ?"selected":"" }} value="{{$aerodromo->code}}">{{$aerodromo->nome}}</option>
            @endforeach
        </select>
        @if ($errors->has('aerodromo_partida'))
            <strong><em>{{ $errors->first('aerodromo_partida') }}</em></strong>
        @endif
    </div>
    <div class="form-group">
        <label for="inputAerodromoChegada">Aeródromo de Chegada</label>
        <select name="aerodromo_chegada" id="inputAerodromoChegada" class="form-control">
            <option disabled selected> -- select an option -- </option>
            @foreach ($aerodromos as $aerodromo)
                <option {{ old('aerodromo_chegada', $movimento->aerodromo_chegada) == $aerodromo->code ?"selected":"" }} value="{{$aerodromo->code}}">{{$aerodromo->nome}}</option>
            @endforeach
        </select>
        @if ($errors->has('aerodromo_chegada'))
            <strong><em>{{ $errors->first('aerodromo_chegada') }}</em></strong>
        @endif
    </div>
    <div class="form-group">
        <label for="inputNumAterragens">Nº de Aterragens</label>
        <input
            type="number" class="form-control"
            name="num_aterragens" id="inputNumAterragens"
            placeholder="Nº de Aterragens" value="{{ old('num_aterragens', $movimento->num_aterragens) }}" />
            @if ($errors->has('num_aterragens'))
                <strong><em>{{ $errors->first('num_aterragens') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputNumDescolagens">Nº de Descolagens</label>
        <input
            type="number" class="form-control"
            name="num_descolagens" id="inputNumDescolagens"
            placeholder="Nº de Descolagens" value="{{ old('num_descolagens', $movimento->num_descolagens) }}" />
            @if ($errors->has('num_descolagens'))
                <strong><em>{{ $errors->first('num_descolagens') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputNumPessoas">Nº de Pessoas a Bordo</label>
        <input
            type="number" class="form-control"
            name="num_pessoas" id="inputNumPessoas"
            placeholder="Nº de Pessoas a Bordo" value="{{ old('num_pessoas', $movimento->num_pessoas) }}" />
            @if ($errors->has('num_pessoas'))
                <strong><em>{{ $errors->first('num_pessoas') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputContaHorasInicio">Conta-Horas Inícial</label>
        <input
            type="number" class="form-control"
            name="conta_horas_inicio" id="inputContaHorasInicio"
            placeholder="Conta-Horas Inicial" value="{{ old('conta_horas_inicio', $movimento->conta_horas_inicio) }}"/>
            @if ($errors->has('conta_horas_inicio'))
                <strong><em>{{ $errors->first('conta_horas_inicio') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputContaHorasFim">Conta-Horas Final</label>
        <input
            type="number" class="form-control"
            name="conta_horas_fim" id="inputContaHorasFim"
            placeholder="Conta-Horas Final" value="{{ old('conta_horas_fim', $movimento->conta_horas_fim) }}"/>
            @if ($errors->has('conta_horas_fim'))
                <strong><em>{{ $errors->first('conta_horas_fim') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputTempoVoo">Tempo do Voo</label>
        <input
            type="number" class="form-control"
            name="tempo_voo" id="inputTempoVoo"
            placeholder="Tempo de Voo" value="{{ old('tempo_voo', $movimento->tempo_voo) }}"/>
            @if ($errors->has('tempo_voo'))
                <strong><em>{{ $errors->first('tempo_voo') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputPrecoVoo">Preço do Voo</label>
        <input
            type="number" step=".01" class="form-control"
            name="preco_voo" id="inputPrecoVoo"
            placeholder="Preço do Voo" value="{{ old('preco_voo', $movimento->preco_voo) }}" />
            @if ($errors->has('preco_voo'))
                <strong><em>{{ $errors->first('preco_voo') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputModoPagamento">Modo de Pagamento</label>
        <select name="modo_pagamento" id="inputModoPagamento" class="form-control">
            <option disabled selected> -- select an option -- </option>
            <option {{ old('modo_pagamento', $movimento->modo_pagamento) == 'N' ?"selected":"" }} value="N">Numerário</option>
            <option {{ old('modo_pagamento', $movimento->modo_pagamento) == 'M' ?"selected":"" }} value="M">Multibanco</option>
            <option {{ old('modo_pagamento', $movimento->modo_pagamento) == 'T' ?"selected":"" }} value="T">Transferência</option>
            <option {{ old('modo_pagamento', $movimento->modo_pagamento) == 'P' ?"selected":"" }} value="P">Pacote de Horas</option>
        </select>
        @if ($errors->has('modo_pagamento'))
            <strong><em>{{ $errors->first('modo_pagamento') }}</em></strong>
        @endif
    </div>
    <div class="form-group">
        <label for="inputNumRecibo">Nº do Recibo</label>
        <input
            type="text" class="form-control"
            name="num_recibo" id="inputNumRecibo"
            placeholder="Nº de Recibo" value="{{ old('num_recibo', $movimento->num_recibo) }}" />
            @if ($errors->has('num_recibo'))
                <strong><em>{{ $errors->first('num_recibo') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputObservacoes">Observações</label>
        <textarea
            class="form-control"
            name="observacoes" id="inputObservacoes"
            placeholder="Observações"> {{ old('observacoes', $movimento->observacoes) }} </textarea>
            @if ($errors->has('observacoes'))
                <strong><em>{{ $errors->first('observacoes') }}</em></strong>
            @endif
    </div>



		<div class="form-group">
			<label for="inputProblemas">Problemas</label>
				<select name="problemas" id="inputProblemas" class="form-control">
						<option disabled selected> -- select an option -- </option>
						<option {{ old('problemas') == 'C' ?"selected":"" }} value="C">Supreficies de Controlo</option>
						<option {{ old('problemas') == 'T' ?"selected":"" }} value="T">Trem de Aterragem</option>
						<option {{ old('problemas') == 'M' ?"selected":"" }} value="M">Motor</option>
						<option {{ old('problemas') == 'O' ?"selected":"" }} value="O">Outros Problemas</option>
				</select>
				@if ($errors->has('problemas'))
						<strong><em>{{ $errors->first('problemas') }}</em></strong>
				@endif
		</div>



    <div class="form-group">
        <label for="inputTipoInstrucao">Tipo de Instrução</label>
        <select name="tipo_instrucao" id="inputTipoInstrucao" class="form-control">
            <option disabled selected> -- select an option -- </option>
            <option {{ old('tipo_instrucao', $movimento->tipo_instrucao) == 'D' ?"selected":"" }} value="D">Duplo Comando</option>
            <option {{ old('tipo_instrucao', $movimento->tipo_instrucao) == 'S' ?"selected":"" }} value="S">Solo</option>
        </select>
        @if ($errors->has('tipo_instrucao'))
            <strong><em>{{ $errors->first('tipo_instrucao') }}</em></strong>
        @endif
    </div>
    <div class="form-group">
        <label for="inputInstrutorID">Instrutor</label>
        <select name="instrutor_id" id="inputInstrutorID" class="form-control">
            <option disabled selected> -- select an option -- </option>
            @foreach ($instrutores as $instrutor)
                <option {{ old('instrutor_id', $movimento->instrutor_id) == $instrutor->id ?"selected":"" }} value="{{$instrutor->id}}">{{$instrutor->num_socio}} - {{$instrutor->nome_informal}}</option>
            @endforeach
        </select>
        @if ($errors->has('instrutor_id'))
            <strong><em>{{ $errors->first('instrutor_id') }}</em></strong>
        @endif
    </div>
    <input type="hidden" name="confirmado" value="{{ $movimento->confirmado }}" />
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="ok">Guardar</button>
                <a href="/movimentos" id="cancel" name="cancel" class="btn btn-default">Cancelar</a>
            </div>
        </form>
    </div>
    <div class="col-md-6 text-right">
        @can('view', Auth::user())
        <form method="POST" action="{{route('movimentos.confirmar', $movimento->id)}}" class="form-group" novalidate>
            @method('PATCH')
            @csrf
            <button type="submit" class="btn btn-success" name="confirmado">Confirmar Movimento</button>
        </form>
        @endcan
    </div>
</div>
@endsection
