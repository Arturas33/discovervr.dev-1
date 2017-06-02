@extends('base')
@section('content')

    <div class="container">
        <table class="table table-bordered">
            <tr>
                <th>Key</th>
                <th>Value</th>
            </tr>
            @foreach($list as $key => $value)
                <tr>
                    @if(!is_array($value))
                    <td>{{$key}}</td>
                    <td>{{$value}}</td>
                </tr>
                    @elseif ($key == 'experiences')
                        @foreach ($value as $key => $experience)
                            <tr>
                                <td>{{$experience['id']}} </td>
                                <td>{{$experience['pivot']['time']}}</td>
                            </tr>
                        @endforeach
                    @endif

            @endforeach
        </table>
    </div>

@endsection