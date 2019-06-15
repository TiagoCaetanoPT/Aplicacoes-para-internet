@extends('layouts.template')
@section('content')

@if (session('status'))
<div class="alert alert-success">
  {{ session('status') }}
</div>
@endif
@if (count($certificados))
<table class="table table-striped">
  <thead>
    <tr>
      <th>Codigo</th>
      <th>Nome</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($certificados as $certificado)
    <tr>
      <td> {{$certoficado->code}} </td>
      <td> {{$certificado->nome}} </td>
    </tr>
    @endforeach
  </tbody>
</table>
@else
<h2>Não foram encontrados certificados</h2>
@endif
@endsection
