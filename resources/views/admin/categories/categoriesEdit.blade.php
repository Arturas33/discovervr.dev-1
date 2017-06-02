@extends('base')

@section('content')

    {{dd($item)}}

<div class="container">
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['url' => route($route, $id)]) !!}
            <table class="table table-bordered">
                @foreach($item['translation'] as $value)
                    @foreach($value['pivot'] as $key => $translation)
                        <tr>
                            @if($key != 'created_at' && $key != 'updated_at' && $key != 'deleted_at' && $key != 'id'
                            && $key != 'count' && $key != 'category_id' && $key != 'language_code')
                                    <td>{{$key . ' ' . $value['pivot']['language_code']}}</td>
                                    <td>
                                        {{ Form::label('', null, ['class' => 'control-label']) }}
                                        {{ Form::text($key . '_' . $value['pivot']['language_code'], $translation) }}
                                    </td>
                            @endif
                            </tr>
                        @endforeach
                    @endforeach
            </table>

            {{Form::submit('Submit!')}}
        </div>
    </div>
</div>
    @endsection