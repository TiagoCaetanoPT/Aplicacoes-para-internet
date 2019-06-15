@extends('users.master')
@section('content')

<form method="POST" action="{{route('socios.password')}}" novalidate class="form-group">
	@method('PATCH')
	@csrf
    <input type="hidden" name="id" value="{{ Auth::id() }}" />
    <div class="form-group">
        <label for="inputPasswordAntiga">Password Antiga</label>
        <input
            type="password" class="form-control"
            name="old_password" id="inputPasswordAntiga"
            placeholder="Password Antiga"/>
            @if ($errors->has('old_password'))
                <strong><em>{{ $errors->first('old_password') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputPassword">Password Nova</label>
        <input
            type="password" class="form-control"
            name="password" id="inputPassword"
            placeholder="Password Nova"/>
            @if ($errors->has('password'))
                <strong><em>{{ $errors->first('password') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <label for="inputPasswordConfirmar">Confirmar Password</label>
        <input
            type="password" class="form-control"
            name="password_confirmation" id="inputPasswordConfirmar"
            placeholder="Confirmar Password"/>
            @if ($errors->has('password_confirmation'))
                <strong><em>{{ $errors->first('password_confirmation') }}</em></strong>
            @endif
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success" name="ok">Guardar</button>
        <a href="/home" id="cancel" name="cancel" class="btn btn-default">Cancelar</a>
    </div>
</form>
@endsection