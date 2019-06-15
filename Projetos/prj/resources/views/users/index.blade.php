@extends('layouts.template')
@section('content')

@if (session('status'))
<div class="alert alert-success">
  {{ session('status') }}
</div>
@endif


<div class="col-md-11">
  <div data-widget="tree">
    <div class="treeview">
      <a href="#"><i class="fas fa-search"></i> <span> Pesquisar</span></a>
      <ul class="treeview-menu">
        <li>
        <form method="GET" action="{{route('socios.index')}}" class="form-group" novalidate>
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-2">
                <label for="numSocio">Nº de Sócio</label>
                <input class="form-control mr-sm-2" type="text" id="numSocio" name="num_socio" placeholder="Nº de Sócio">
              </div>

              <div class="col-sm-2">
                <label for="tipoSocio">Tipo de Sócio</label>
                <select name="tipo" id="tipoSocio" class="form-control mr-sm-2">
                  <option disabled selected> Tipo de Sócio </option>
                  <option value="P">Piloto</option>
                  <option value="NP">Não-Piloto</option>
                  <option value="A">Aeromodelista</option>
                </select>
              </div>

              <div class="col-sm-3">
                <label for="nomeInformal">Nome Informal</label>
                <input class="form-control mr-sm-2" type="text" id="nomeInformal" name="nome_informal" placeholder="Nome Informal">
              </div>

              <div class="col-sm-3">
                <label for="email">Email</label>
                <input class="form-control mr-sm-2" type="text" id="email" name="email" placeholder="Email">
              </div>
            </div>

            <br>

            <div class="row">
              <div class="col-sm-2">
                @can('view', Auth::user())
                <input type="checkbox" id="quotasPagas" name="quotas_pagas" value="1">
                <label for="quotasPagas">Quotas Pagas</label>
                <br>
                <input type="checkbox" id="quotasNaoPagas" name="quotas_pagas" value="0">
                <label for="quotasNaoPagas">Quotas Não Pagas</label>
                <br>
                @endcan
              </div>

              <div class="col-sm-2">
                @can('view', Auth::user())
                <input type="checkbox" id="ativo" name="ativo" value="1">
                <label for="ativo">Sócio Ativo</label>
                <br>
                <input type="checkbox" id="naoAtivo" name="ativo" value="0">
                <label for="naoAtivo">Sócio Não Ativo</label>
                <br>
                @endcan
              </div>

              <div class="col-sm-2">
                <input type="checkbox" id="direcao" name="direcao" value="1">
                <label for="direcao">Direção</label>
                <br>
                <input type="checkbox" id="naoDirecao" name="direcao" value="0">
                <label for="naoDirecao">Não Direção</label>
                <br>
              </div>

              <div class="col-sm-4 text-right">
                <button type="submit" class="btn btn-primary" id="filter">Pesquisar</button>
              </div>
            </div>

          </div>
        </form>
      </li>
      </ul>
    </div>
  </div>
</div>



<div class="col text-right">

  @can('create', App\User::class)
  <div><a class="btn btn-primary" href="{{route('socios.create')}}">Adicionar Sócio</a></div>
  @endcan

</div>






@if (count($users))
<table class="table table-striped">
  <thead>
    <tr>
      <th>Nº de Sócio</th>
      <th>Tipo de Sócio</th>
      <th>Nome Informal</th>
      <th>Email</th>
      <th>Foto</th>
      <th>Telefone</th>
      @can('view', Auth::user())
      <th>Quotas em dia</th>
      <th>Sócio ativo</th>
      @endcan
      <th>Direção</th>
      <th>Nº de licença</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
    <tr>
      <td> {{$user->num_socio}} </td>
      <td> {{$user->tipoToStr()}} </td>
      <td> {{$user->nome_informal}} </td>
      <td> {{$user->email}} </td>
      <td>
        @if ($user->foto_url!=NULL)
        <img src="{{asset('storage/fotos/'.$user->foto_url)}}" class="img-circle" alt="">
        @endif
      </td>
      <td> {{$user->telefone}} </td>
      @can('view', Auth::user())
      <td> {{$user->quota_paga=='1'?'Sim':'Não'}} </td>
      <td> {{$user->ativo=='1'?'Sim':'Não'}} </td>
      @endcan
      <td> {{$user->direcao=='1'?'Sim':'Não'}} </td>
      <td> {{$user->num_licenca}} </td>
      <td>
        <!-- Ferramentas -->
        @can('update', $user)
        <div data-widget="tree">
          <div class="treeview">
            <a href="#" class=""><i class="fas fa-tools"></i></a>
            <ul class="treeview-menu">
              <li>
              <a class="btn btn-xs btn-primary custom" href="{{route('socios.edit', $user->id) }}"><i class="far fa-edit"></i> Editar</a>
              @endcan

              @can('view', Auth::user())
              <form method="POST" action="{{route('socios.quota', $user->id)}}" novalidate>
                @method('patch')
                @csrf
                <button type="submit" class="btn btn-xs btn-warning custom" name="quota_paga"><i class="fas fa-cash-register"></i> Pagar quota</button>
              </form>
              <form method="POST" action="{{route('socios.ativo', $user->id)}}" novalidate>
                @method('patch')
                @csrf
                @if($user->ativo=='1')
                <button type="submit" class="btn btn-xs btn-danger custom" name="ativo"><i class="fas fa-check"></i> Desativar socio</button>
                @else
                <button type="submit" class="btn btn-xs btn-success" name="ativo"><i class="fas fa-check"></i> Ativar socio</button>
                @endif
              </form>
              @endcan

              @can('delete', Auth::user())
              <form action="{{route('socios.destroy', $user->id) }}" method="POST" role="form" class="inline">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" value="{{ $user->id }}">
                <br>
                <button type="submit" class="btn btn-xs btn-danger custom"><i class="fas fa-trash"></i> Eliminar</button>
              </form>
              @endcan
            </li>
            </ul>
          </div>
        </div>
        <!-- Ferramentas -->
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $users->appends(request()->except('page'))->links() }}

@can('view', Auth::user())
<div class="text-right">
  <form method="POST" action="{{route('socios.quotas')}}" class="form-group" novalidate>
    @method('PATCH')
    @csrf
    <button type="submit" class="btn btn-primary" name="quotas_pagas">Quotas Todos os Sócios</button>
  </form>
  @endcan
  @can('view', Auth::user())
  <form method="POST" action="{{route('socios.ativos')}}" class="form-group" novalidate>
    @method('PATCH')
    @csrf
    <button type="submit" class="btn btn-primary" name="ativos">Desativar Todos os Sócios</button>
  </form>
</div>
@endcan




@else
<h2>Não foram encontrados sócios</h2>
@endif
@endsection
