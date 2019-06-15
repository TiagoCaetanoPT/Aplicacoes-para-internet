<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>FlightClub - {{ $pagetitle }}</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ asset('bower_components/morris.js/morris.css') }}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('bower_components/jvectormap/jquery-jvectormap.css') }}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">

  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}">
  <!-- fontawesome -->
  <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="{{route('home')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>FL</b>C</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Flight</b>CLUB</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                @if (Auth::user()->foto_url!=NULL)
                <img src="{{asset('storage/fotos/'.Auth::user()->foto_url)}}" class="user-image" alt="User Image">
                @else
                <div class="user-image">
                  <i class="fas fa-user-tie"></i>
                </div>
                @endif
                <span class="hidden-xs">{{ Auth::user()->nome_informal }}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">

                  @if (Auth::user()->foto_url!=NULL)
                  <img src="{{asset('storage/fotos/'.Auth::user()->foto_url)}}" class="img-circle" alt="User Image">
                  @else
                    <h1><i class="fas fa-user-tie"></i></h1>
                  @endif

                  <p>{{ Auth::user()->nome_informal }} - <small>Licença válida até {{ Auth::user()->validade_licenca }}</small>
                  </p>
                </li>


                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="{{ route('socios.edit', Auth::user()->id) }}" class="btn btn-default btn-flat">Perfil</a>
                  </div>
                  <div class="pull-right">
                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </div>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </nav>
  </header>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          @if (Auth::user()->foto_url!=NULL)
          <img src="{{asset('storage/fotos/'.Auth::user()->foto_url)}}" class="img-circle" alt="User Image">
          @else
          <h2><i class="fas fa-user-tie"></i></h2>
          @endif
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->nome_informal }}</p>
          <p>{{ Auth::user()->tipo_socio == 'P'?'Piloto':(Auth::user()->tipo_socio == 'NP'?'Não Piloto':'Aeromodelista') }}</p>
        </div>
      </div>




<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">
  <li class="header">PAINEL DE NAVEGAÇÃO</li>
  <li class="active treeview">
    <a href="#">
      <i class="fas fa-users"></i> <span> Socios</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      @can('create', App\User::class)
      <li><a href="{{ route('socios.create') }}"><i class="fas fa-user-plus"></i> Adicionar Socio</a></li>
      @endcan
      <li><a href="{{ route('socios.index') }}"><i class="far fa-eye"></i> Ver Socios</a></li>
    </ul>
  </li>
  <li class="treeview">
    <a href="#">
      <i class="fas fa-plane"></i> <span> Aeronaves</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      @can('create', App\Aeronave::class)
      <li><a href="{{ route('aeronaves.create') }}"><i class="fas fa-user-plus"></i> Adicionar Aeronave</a></li>
      @endcan
      <li><a href="{{ route('aeronaves.index') }}"><i class="far fa-eye"></i> Ver Aeronaves</a></li>
    </ul>
  </li>
  <li class="treeview">
    <a href="#">
      <i class="fas fa-users"></i> <span> Movimentos</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      @can('create', App\Movimento::class)
      <li><a href="{{ route('movimentos.create') }}"><i class="fas fa-user-plus"></i> Adicionar Movimento</a></li>
      @endcan
      <li><a href="{{ route('movimentos.index') }}"><i class="far fa-eye"></i> Ver Movimentos</a></li>
    </ul>
  </li>
</ul>
</section>
<!-- /.sidebar -->
</aside>


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>{{ $pagetitle }}</h1>
    <ol class="breadcrumb">
      <li><a href="{{route('home')}}"><i class="fas fa-tachometer-alt"></i> Inicio</a></li>
      <li class="active">{{ $pagetitle }}</li>
    </ol>
  </section>





  <section class="content">
    <div class="container-fluid">
      <div class="row">

        @yield('content')

      </div>
    </div>
  </section>
</div>







  <footer class="main-footer sidebar">
    <div class="row text-center">
      <div class="col-md-4">
        <b>Discentes:</b><br>
        <span>Diogo Carreira Nº 2160879</span><br>
        <span>Luis Pimentel Nº 2160863</span><br>
        <span>Tiago Caetano Nº 2181830</span>
      </div>
      <div class="col-md-4">
        <b>Instituto Politécnico de Leiria, Escola Superior de Tecnologia e Gestão</b><br>
        <span>Engenharia Informática - 2018/19</span><br>
        <span>Aplicações para a Internet</span>
      </div>
      <div class="col-md-4">
        <b>Docente:</b>
        <p>Professor Doutor Marco Monteiro</p>
      </div>
    </div>
  </footer>


  <!-- jQuery 3 -->
  <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>

  <!-- Bootstrap 3.3.7 -->
  <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <!-- Morris.js charts -->
  <script src="{{ asset('bower_components/raphael/raphael.min.js') }}"></script>
  <script src="{{ asset('bower_components/morris.js/morris.min.js') }}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
  <script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <!-- datepicker -->
  <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
  <!-- Slimscroll -->
  <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js') }}"></script>
</div>
</body>
</html>
