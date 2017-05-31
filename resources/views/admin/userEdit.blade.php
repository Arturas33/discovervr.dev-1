@extends('base')

@section('content')

    {!! Form::open(['url' => route($route)]) !!}

{{Form::label('name','User name ')}}
{{ Form::text('name')}}<br>

{{Form::label('email','User email ')}}
{{Form::text('email')}}<br>


{{Form::label('phone','User phone ')}}
{{ Form::text('phone')}} <br>





{{Form::submit('Submit')}}

{!! Form::close() !!}

@endsection