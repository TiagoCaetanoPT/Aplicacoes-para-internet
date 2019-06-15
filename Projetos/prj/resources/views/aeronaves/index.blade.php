@extends('layouts.template')
@section('content')

@can('create', App\Aeronave::class)
<div><a class="btn btn-primary" href="{{route('aeronaves.create')}}">Adicionar Aeronave</a></div>
@endcan
@if (session('status'))
<div class="alert alert-success">
  {{ session('status') }}
</div>
@endif
@if (count($aeronaves))
<table class="table table-striped">
  <thead>
    <tr>
      <th>Matrícula</th>
      <th>Marca</th>
      <th>Modelo</th>
      <th>Nº de Lugares</th>
      <th>Total de Horas</th>
      <th>Preço Hora</th>
      @can('view', Auth::user())
      <th>Actions</th>
      @endcan
    </tr>
  </thead>
  <tbody>
    @foreach ($aeronaves as $aeronave)
    <tr>
      <td> {{$aeronave->matricula}} </td>
      <td> {{$aeronave->marca}} </td>
      <td> {{$aeronave->modelo}} </td>
      <td> {{$aeronave->num_lugares}} </td>
      <td> {{$aeronave->conta_horas}} </td>
      <td> {{$aeronave->preco_hora}} </td>
      <td>
        <!-- Ferramentas -->
        @can('update', $aeronave)
        <div data-widget="tree">
          <div class="treeview">
            <a href="#" class=""><i class="fas fa-tools"></i></a>
            <ul class="treeview-menu">
              <a class="btn btn-xs btn-primary custom" href="{{route('aeronaves.edit', $aeronave->matricula) }}"><i class="far fa-edit"></i> Editar</a>
              <br>
              @endcan

              @can('delete', $aeronave)
              <form action="{{route('aeronaves.destroy', $aeronave->matricula) }}" method="POST" role="form" class="inline">
                @csrf
                @method('DELETE')
                <br>
                <button type="submit" class="btn btn-xs btn-danger custom"><i class="fas fa-trash"></i> Eliminar</button>
              </form>
              @endcan
            </ul>
          </div>
        </div>
        <!-- Ferramentas -->
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@else
<h2>Não foram encontradas aeronaves</h2>
@endif
@endsection
