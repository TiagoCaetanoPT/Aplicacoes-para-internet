@extends('layouts.template')
@section('content')

<form method="POST" action="{{route('aeronaves.update', $aeronave->matricula)}}" novalidate class="form-group">
	@method('PUT')
	@csrf
    <input type="hidden" name="matricula" value="{{ $aeronave->matricula }}" />
    <div class="form-group">
	    <label for="inputMarca">Marca</label>
	    <input
	        type="text" class="form-control"
	        name="marca" id="inputMarca"
	        placeholder="Marca" value="{{ old('marca', $aeronave->marca) }}" />
	        @if ($errors->has('marca'))
	            <strong><em>{{ $errors->first('marca') }}</em></strong>
	        @endif
	</div>
    <div class="form-group">
	    <label for="inputModelo">Modelo</label>
	    <input
	        type="text" class="form-control"
	        name="modelo" id="inputModelo"
	        placeholder="Modelo" value="{{ old('modelo', $aeronave->modelo) }}" />
	        @if ($errors->has('modelo'))
	            <strong><em>{{ $errors->first('modelo') }}</em></strong>
	        @endif
	</div>
    <div class="form-group">
        <label for="inputNumLugares">Nº de Lugares</label>
        <input
	        type="number" class="form-control"
	        name="num_lugares" id="inputNumLugares"
	        placeholder="Nº Lugares" value="{{ old('num_lugares', $aeronave->num_lugares) }}" />
	        @if ($errors->has('num_lugares'))
	        	<strong><em>{{ $errors->first('num_lugares') }}</em></strong>
	        @endif
    </div>
    <div class="form-group">
        <label for="inputContaHoras">Conta-Horas</label>
        <input
            type="number" class="form-control"
            name="conta_horas" id="inputContaHoras"
            placeholder="Conta Horas" value="{{ old('conta_horas', $aeronave->conta_horas) }}" />
            @if ($errors->has('conta_horas'))
                <strong><em>{{ $errors->first('conta_horas') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputPrecoHora">Preço Hora</label>
        <input
            type="number" step=".01" class="form-control"
            name="preco_hora" id="inputPrecoHora"
            placeholder="Preço Hora" value="{{ old('preco_hora', $aeronave->preco_hora) }}" />
            @if ($errors->has('preco_hora'))
                <strong><em>{{ $errors->first('preco_hora') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Unidade Conta Horas</th>
                    <th>Minutos</th>
                    <th>Preço</th>
                </tr>
            </thead>
            <tbody>
                @foreach($aeronaveValores as $valor)
                    <tr>
                        <td><input type="number" class="form-control" name="unidade_conta_horas[]" value="{{$valor->unidade_conta_horas}}" readonly/></td>
                        <td><input type="number" class="form-control" name="tempos[{{$valor->unidade_conta_horas}}]" value="{{old('tempos.'.$valor->unidade_conta_horas, $valor->minutos)}}"/></td>
                        <td><input type="number" step=".01" class="form-control" name="precos[{{$valor->unidade_conta_horas}}]" value="{{old('precos.'.$valor->unidade_conta_horas, $valor->preco)}}"/></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary" name="ok">Guardar</button>
        <a href="/aeronaves" id="cancel" name="cancel" class="btn btn-default">Cancelar</a>
    </div>
</form>
@endsection
