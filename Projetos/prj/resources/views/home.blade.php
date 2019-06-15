@extends('layouts.template')
@section('content')




<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-aqua">
    <div class="inner">
      <h3>{{ $totalPilotos }}</h3>
      <p>Pilotos</p>
    </div>
    <div class="icon">
      <!-- <i class="ion ion-person"></i> -->
      <i class="fas fa-helicopter"></i>
    </div>
    <a href="{{route('socios.pilotos')}}" class="small-box-footer">Ver Pilotos <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-green">
    <div class="inner">
      <h3>{{ $totalSocios }}</h3>
      <p>Sócios</p>
    </div>
    <div class="icon">
      <i class="fas fa-users"></i>
    </div>
    <a href="{{route('socios.index')}}" class="small-box-footer">Ver Sócios <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-yellow">
    <div class="inner">
      <h3>{{ $totalAlunos }}</h3>
      <p>Alunos</p>
    </div>
    <div class="icon">
      <i class="fas fa-user-graduate"></i>
    </div>
    <a href="{{route('socios.alunos')}}" class="small-box-footer">Ver Alunos <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-red">
    <div class="inner">
      <h3>{{ $totalInstrutores }}</h3>
      <p>Instrutores</p>
    </div>
    <div class="icon">
      <i class="fas fa-chalkboard-teacher"></i>
    </div>
    <a href="{{route('socios.instrutores')}}" class="small-box-footer">Ver Instrutores <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- ./col -->
</div>
<!-- /.row -->






<div class="row">
  <!-- Left col -->
  <section class="col-lg-7 connectedSortable">
    <!-- Custom tabs (Charts with tabs)-->

    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title"><i class="fas fa-stopwatch"></i> Contador de Horas Voadas</h3>
        <div class="box-tools pull-right">
          <a href="#" class="btn" data-widget="collapse"><i class="fa fa-minus"></i></a>
          <a href="#" class="btn" data-widget="remove"><i class="fa fa-times"></i></a>
        </div>
      </div>
      <div class="box-body">
        <div class="tab-content no-padding">
          <!-- Morris chart - Sales -->
          <div class="chart tab-pane active" id="top_x_div" style="position: relative; height: 300px;">
            <!-- Grafico -->
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawStuff);
            function drawStuff() {
              var data = new google.visualization.arrayToDataTable([
                ['Aeronaves', 'Numero de horas em voo'],
                @foreach ($aeronaves as $aeronave)
                ['{{$aeronave->matricula}}', {{$aeronave->conta_horas}}],
                @endforeach
              ]);

              var options = {
                title: 'Chess opening moves',
                width: 900,
                legend: { position: 'none' },

                bars: 'horizontal', // Required for Material Bar Charts.
                axes: {
                  x: {
                    0: { side: 'top', label: 'Total de Horas'} // Top x-axis.
                  }
                },
                bar: { groupWidth: "90%" }
              };

              var chart = new google.charts.Bar(document.getElementById('top_x_div'));
              chart.draw(data, options);
            };
            </script>

          </div>
          <!-- Fim do Grafico -->
        </div>
      </div>
    </div>
    <!-- /.nav-tabs-custom -->


    <!-- Preço Voos -->
    <div class="box box-danger">
      <div class="box-header">
        <h3 class="box-title"><i class="fas fa-plane-departure"></i> Aeronaves</h3>
        <div class="box-tools pull-right">
          <a href="#" class="btn" data-widget="collapse"><i class="fa fa-minus"></i></a>
          <a href="#" class="btn" data-widget="remove"><i class="fa fa-times"></i></a>
        </div>
      </div>
      <div class="box-body">
        <div class="chart tab-pane active " id="timelinePreco" style="position: relative; height: 300px;">
          <!-- Tabela -->
          <table class="table table-striped text-center">
            <thead>
              <tr>
                <th scope="col">Matricula</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th scope="col">Nº Lugares</th>
                <th scope="col">Preço/h</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($aeronaves as $aeronave)
              <tr>
                <td>{{ $aeronave->matricula }}</td>
                <td>{{ $aeronave->marca }}</td>
                <td>{{ $aeronave->modelo }}</td>
                <td>{{ $aeronave->num_lugares }}</td>
                <td>{{ $aeronave->preco_hora }} €</td>
              </tr>
              @endforeach
            </tbody>
            </table>
            <!-- Fim tabela -->
          </div>
        </div>
      </div>
      <!-- /Preço Voos -->
    </section>
    <!-- /.Left col -->



    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-5 connectedSortable">

      <!-- Ultimos Voos -->
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title"><i class="fas fa-plane-departure"></i> Ultimos Voos</h3>
          <div class="box-tools pull-right">
            <a href="#" class="btn" data-widget="collapse"><i class="fa fa-minus"></i></a>
            <a href="#" class="btn" data-widget="remove"><i class="fa fa-times"></i></a>
          </div>
        </div>
        <div class="box-body">
          <div class="chart tab-pane active " id="timelineVoos" style="position: relative; height: 300px;">
            <!-- Tabela -->
            <table class="table table-striped text-center">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Aeronave</th>
                  <th scope="col">Piloto</th>
                  <th scope="col">Natureza do Voo</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($movimentos as $movimento)
                <tr>
                  <td>{{ $movimento->id }}</td>
                  <td>{{ $movimento->aeronave }}</td>
                  <td>{{ $movimento->piloto_id }}</td>
                  <td>{{$movimento->naturezaToStr()}}</td>
                </tr>
                @endforeach
              </tbody>
              </table>
              <!-- Fim tabela -->
            </div>
          </div>
        </div>
        <!-- /Ultimos Voos -->




        <!-- Voos mais comuns -->
        <div class="box box-warning">
          <div class="box-header">
            <h3 class="box-title"><i class="fas fa-plane-departure"></i> Voos Mais Comuns</h3>
            <div class="box-tools pull-right">
              <a href="#" class="btn" data-widget="collapse"><i class="fa fa-minus"></i></a>
              <a href="#" class="btn" data-widget="remove"><i class="fa fa-times"></i></a>
            </div>
          </div>
          <div class="box-body">
            <div class="chart tab-pane active " id="donutchart" style="position: relative; height: 300px;">
              <!-- Grafico -->
              <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
              <script type="text/javascript">
              google.charts.load("current", {packages:["corechart"]});
              google.charts.setOnLoadCallback(drawChart);
              function drawChart() {
                var data = google.visualization.arrayToDataTable([
                  ['Task', 'Hours per Day'],
                  ['Treino', {{ $totalTreinos }}],
                  ['Especial', {{ $totalEspecial }}],
                  ['Instrução', {{ $totalInstrucao }}],
                ]);

                var options = {
                  title: 'Percentagem de voos mais comuns',
                  pieHole: 0.4,
                };

                var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                chart.draw(data, options);
              }
              </script>
              <!-- Fim Grafico -->
            </div>
          </div>
        </div>
        <!-- /Voos mais comuns -->


      </section>
      
      <!-- right col -->
    </div>
    <!-- /.row (main row) -->
    @endsection
