@extends('users.template')
@section('content')
<div>
    <a href="{{ action('UserController@create') }}">Add User</a>
</div>
<hr>
<table>
<thead>
    <tr>
        <th>Name</th>
        <th>Age</th>
        <th></th>
        <th></th>
    </tr>
</thead>
<tbody>                
@foreach ($users as $user)
    <tr>
        <td>{{ $user->name }} </td>
        <td>{{ $user->age }} </td>
        <td><a href="{{ action('UserController@edit', $user->id) }}">Edit</a></td>
        <td>
            <form action="{{ action('UserController@destroy', $user->id) }}" method="post">
                @csrf
                @method('delete')
                <input type="hidden" name="id" value="{{$user->id}}">
                <input type="submit" value="Delete">
            </form>
    </tr>
@endforeach
</tbody>
</table>
@endsection('content')
