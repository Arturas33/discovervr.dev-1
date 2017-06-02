
@extends('base')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-2">
                {!! Form::open(
              array(
                  'route' => 'app.pages.create',
                  'class' => 'form',
                  'novalidate' => 'novalidate',
                  'files' => true)) !!}

                {!! Form::open(['url'=>route('app.pages.create')])!!}

                {{Form::label('categories', 'Categories')}}
                {{Form::select('categories', $categories)}}

                {{Form::label('title_lt', 'Title lithuanian')}}
                {{ Form::text('title_lt')}}

                {{Form::label('slug_lt', 'Slug lithuanian')}}
                {{Form::text('slug_lt')}}

                {{Form::label('description_short_lt', 'Short Descriptions lithuanian')}}
                {{ Form::text('description_short_lt')}}

                {{Form::label('description_long_lt', 'Long Descriptions lithuanian')}}
                {{ Form::text('description_long_lt')}}


                {{Form::label('title_en', 'Title english')}}
                {{ Form::text('title_en')}}

                {{Form::label('slug_en', 'Slug english')}}
                {{Form::text('slug_en')}}

                {{Form::label('description_short_en', 'Short Descriptions english')}}
                {{ Form::text('description_short_en')}}

                {{Form::label('description_long_en', 'Long Descriptions english')}}
                {{ Form::text('description_long_en')}}



                {!! Form::file('image') !!}



                {{Form::submit('Create')}}

                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection








