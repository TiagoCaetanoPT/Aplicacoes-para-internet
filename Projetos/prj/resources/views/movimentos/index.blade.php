@extends('layouts.template')
@section('content')

@if (session('status'))
<div class="alert alert-success">
  {{ session('status') }}
</div>
@endif



<!-- Pesquisar -->
<div class="col-md-11">
  <div data-widget="tree">
    <div class="treeview">
      <a href="#">
        <i class="fas fa-search"></i> <span> Pesquisar</span>
      </a>
      <ul class="treeview-menu">
        <li>
        <form method="GET" action="{{route('movimentos.index')}}" class="form-group" novalidate>
          <div class="container-fluid">
            <div class="row">

              <div class="col-sm-2">
                <label for="idMovimento">ID Movimento</label>
                <input class="form-control mr-sm-2"  type="text" id="idMovimento" name="id" placeholder="ID do Movimento">
              </div>

              <div class="col-sm-2">
                <label for="aeronave">Aeronave</label>
                <input class="form-control mr-sm-2" type="text" id="aeronave" name="aeronave" placeholder="Aeronave">
              </div>

              <div class="col-sm-2">
                <label for="dataSuperior">Data Superior</label>
                <input class="form-control mr-sm-2" type="date" id="dataSuperior" name="data_sup">
              </div>


              <div class="col-sm-2">
                <label for="dataInferior">Data Inferior</label>
                <input class="form-control mr-sm-2" type="date" id="dataInferior" name="data_inf">
              </div>


              <div class="col-sm-2">
                <label for="naturezaVoo">Natureza</label>
                <select name="natureza" id="naturezaVoo" class="form-control">
                  <option disabled selected> Natureza </option>
                  <option value="T">Treino</option>
                  <option value="I">Instrução</option>
                  <option value="E">Especial</option>
                </select>
              </div>


              <div class="col-sm-2">
                <label for="piloto">ID Piloto</label>
                <input class="form-control mr-sm-2" type="text" id="piloto" name="piloto" placeholder="Piloto">
              </div>
            </div>

            <div class="row">
              <div class="col-sm-2">
                <label for="instrutor">ID Instrutor</label>
                <input class="form-control mr-sm-2" type="text" id="instrutor" name="instrutor" placeholder="Instrutor">
              </div>


              <div class="col-sm-2">
                <label for="num_diario">Nº Diário</label>
                <input class="form-control mr-sm-2" type="text" id="num_diario" name="num_diario" placeholder="Nº Diario">
              </div>


              <div class="col-sm-2">
                <br>
                <input type="checkbox" id="confirmado" name="confirmado" value="1">
                <label for="confirmado">Confirmado</label>
                <br>
                <input type="checkbox" id="naoConfirmado" name="confirmado" value="0">
                <label for="naoConfirmado">Não Confirmado</label>
              </div>
              @can('viewMovimentos', Auth::user())
              <div class="col-sm-2">
                <br>
                <input type="checkbox" id="meusMovimentos" name="meus_movimentos" value="1">
                <label for="meusMovimentos">Meus Movimentos</label>
              </div>
              @endcan

              <div class="col-sm-6 text-right">
                <br>
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
  <!-- /Pesquisar -->


  <div class="col text-right">
    @can('create', App\Movimento::class)
    <div><a class="btn btn-primary" href="{{route('movimentos.create')}}">Adicionar Movimento</a></div>
    @endcan
  </div>





  @if (count($movimentos))
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID do Movimento</th>
        <th>Matrícula da Aeronave</th>
        <th>Data do Voo</th>
        <th>Hora de Descolagem</th>
        <th>Hora de Aterragem</th>
        <th>Tempo do Voo</th>
        <th>Natureza do Voo</th>
        <th>Piloto</th>
        <th>Código do Aeródromo de Partida</th>
        <th>Código do Aeródromo de Chegada</th>
        <th>Nº de Aterragens</th>
        <th>Nº de Descolagens</th>
        <th>Nº do Diário</th>
        <th>Nº do Serviço</th>
        <th>Conta-Horas Inicial</th>
        <th>Conta-Horas Final</th>
        <th>Nº de Pessoas a Bordo</th>
        <th>Tipo de Instrução</th>
        <th>Instrutor</th>
        <th>Confirmado</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($movimentos as $movimento)
      <tr>
        <td> {{$movimento->id}} </td>
        <td> {{$movimento->aeronave}} </td>
        <td> {{$movimento->data}} </td>
        <td> {{$movimento->hora_descolagem}} </td>
        <td> {{$movimento->hora_aterragem}} </td>
        <td> {{$movimento->tempo_voo}} </td>
        <td> {{$movimento->naturezaToStr()}} </td>
        <td> {{$movimento->piloto->nome_informal}} </td>
        <td> {{$movimento->aerodromo_partida}} </td>
        <td> {{$movimento->aerodromo_chegada}} </td>
        <td> {{$movimento->num_aterragens}} </td>
        <td> {{$movimento->num_descolagens}} </td>
        <td> {{$movimento->num_diario}} </td>
        <td> {{$movimento->num_servico}} </td>
        <td> {{$movimento->conta_horas_inicio}} </td>
        <td> {{$movimento->conta_horas_fim}} </td>
        <td> {{$movimento->num_pessoas}} </td>
        <td> {{$movimento->tipoInstrucaoToStr()}} </td>
        <td>
          @if ($movimento->instrutor_id != null)
          {{$movimento->instrutor->nome_informal}}
          @endif
        </td>
        <td> {{$movimento->confirmado=='1'?'Sim':'Não'}} </td>
        <td>
          <!-- Ferramentas -->
          @can('update', $movimento)
          <div data-widget="tree">
            <div class="treeview">
              <a href="#" class=""><i class="fas fa-tools"></i></a>
              <ul class="treeview-menu">
                <a class="btn btn-xs btn-primary custom" href="{{route('movimentos.edit', $movimento->id) }}"><i class="far fa-edit"></i> Editar</a>
                <br>
                @endcan

                @can('delete', $movimento)
                <form action="{{route('movimentos.destroy', $movimento->id) }}" method="POST" role="form" class="inline">
                  @csrf
                  @method('DELETE')
                  <input type="hidden" name="id" value="{{ $movimento->id }}}">
                  <br>
                  <button type="submit" class="btn btn-xs btn-danger custom"><i class="fas fa-trash"></i> Eliminar</button>
                </form>
                @endcan
                @can('update', $movimento)
              </ul>
            </div>
          </div>
          @endcan
          <!-- Ferramentas -->
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $movimentos->appends(request()->except('page'))->links() }}
  @else
  <h2>Não foram encontrados movimentos</h2>
  @endif
  @endsection
