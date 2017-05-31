@extends('base')

@section('content')

    {!! Form::open(['url' => $route])!!}

    <div>
        <h2>Meniu koregavimas:</h2>


        @foreach($menu['translation'] as $value)
            @foreach($value['pivot'] as $key => $translation)

                @if(!in_array($key, $ignore))

                {{$key . ' ' . $value['pivot']['language_code']}}

                {{ Form::label('', null, ['class' => 'control-label']) }}
                {{ Form::text($key . '_' . $value['pivot']['language_code'], $translation) }}

                @endif
            @endforeach
        @endforeach
        {{Form::select( 'listParent', [null=>''] + $listParentIdNull )}}
        {{Form::label('url', 'Url')}}
        {{Form::text('url', $menu['url'])}}

        {{Form::label('sequence', 'Vieta eileje')}}
        {{Form::text('sequence', $menu['sequence'])}}




        {{Form::submit('Issaugoti')}}

    </div>



    {!! Form::close() !!}

@endsection