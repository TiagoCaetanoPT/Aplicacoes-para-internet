@extends('users.template')
@section('content')
<div>
    <a href="{{ action('UserController@index') }}">Return to the list of users</a>
</div>
<hr>
<form action="{{ action('UserController@update', $user->id) }}" method="post">
    @method('put')
    @csrf
    <div>
        <label for="inputName">Name</label>
        <input type="text" name="name" id="inputName" placeholder="Name" value="{{ old('name', $user->name) }}">
        @if ($errors->has('name'))
            <em>{{ $errors->first('name') }}</em>
        @endif
    </div>
    <div>
        <label for="inputAge">Age</label>
        <input type="text" name="age" id="inputAge" placeholder="Age" value="{{ old('age', $user->age) }}">
        @if ($errors->has('age'))
            <em>{{ $errors->first('age') }}</em>
        @endif
    </div>
    <div>
        <button type="submit" name="ok">Save</button>
        <button type="submit" name="cancel">Cancel</button>
    </div>
</form>
@endsection('content')
