<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FlightClub</title>

    <link rel="stylesheet" href="css/style.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link rel="shortcut icon" type="image/png" href="favicon.png">

    <!-- bootstrap -->
    <link rel="stylesheet" href="css/app.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body class="sidebar">


  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3 text-center bg-primary sidebar">
        <h1 class="m-5">FlightClub</h1>
        <b>Area pessoal:</b>

        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="form-group ml-5 mr-5">
            <label for="exampleInputEmail1"><i class="fas fa-user"></i> E-mail:</label>
            <input id="exampleInputEmail1" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="E-mail" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="form-group ml-5 mr-5">
            <label for="exampleInputPassword1"><i class="fas fa-key"></i> Senha:</label>
            <input id="exampleInputPassword1" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror

            @if (Route::has('password.request'))
            <a class="text-dark" href="{{ route('password.request') }}">
              {{ __('Esqueceu a conta?') }}
            </a>
            @endif
          </div>
          <button type="submit" class="btn btn-light pl-4 pr-4 pt-2 pb-2 m-2">{{ __('Entrar') }}</button>
        </form>

        <a class="text-dark" href="{{ route('register') }}">{{ __('Criar nova conta') }}</a>

      </div>

      <div class="col-9 text-center mt-5">
        <h4>Quem Somos</h4>
        <div class="mb-4">
          <p>O Aeroclube "FlightClub" tem uma escola de aviação e dispõe de um conjunto de aeronaves que aluga aos seus sócios pilotos ou que utiliza na sua escola.</p>
        </div>

        <div class="row text-center">
          <div class="col-md-4">
            <div class="card">
              <img src="img/avioneta.jpg" class="card-img-top" alt="">
              <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card">
              <img src="img/avioneta2.jpg" class="card-img-top" alt="">
              <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card">
              <img src="img/avioneta3.jpg" class="card-img-top" alt="">
              <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>
        </div>

        <hr>

    </div> <!-- col-9 -->
  </div> <!-- row -->
</div> <!-- container -->

<!-- Footer -->
<footer class="page-footer font-small bg-dark text-white fixed-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4 text-center">
        <b>Discentes:</b><br>
        <span>Diogo Carreira Nº 2160879</span><br>
        <span>Luis Pimentel Nº 2160863</span><br>
        <span>Tiago Caetano Nº 2181830</span>
      </div>
      <div class="col-md-4 text-center">
        <b>Instituto Politécnico de Leiria, Escola Superior de Tecnologia e Gestão</b><br>
        <span>Engenharia Informática - 2018/19</span><br>
        <span>Aplicações para a Internet</span>
      </div>
      <div class="col-md-4 text-center">
        <b>Docente:</b>
        <p>Professor Doutor Marco Monteiro</p>
      </div>
    </div>
  </div>
</footer>
<!-- Footer -->
<script src="js/app.js" charset="utf-8"></script>
</body>
</html>
