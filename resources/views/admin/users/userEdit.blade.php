@extends('base')

@section('content')

    {!! Form::open(['url' => route($route, $id)]) !!}


{{Form::label('name','User name ')}}
{{ Form::text('name', $item['name'])}}<br>

{{Form::label('email','User email ')}}
{{Form::text('email', $item['email'])}}<br>


{{Form::label('phone','User phone ')}}
{{ Form::text('phone', $item['phone'])}} <br>





{{Form::submit('Submit')}}

{!! Form::close() !!}

@endsection