@extends('base')
@section('content')

    <div class="container">
        <table class="table table-bordered">
            <tr>
                <th>Key</th>
                <th>Value</th>
            </tr>
            @foreach($item as $key => $value)
                <tr>
                    <td>{{$key}}</td>
                    <td>
                        @if(!is_array($value))
                            {{$value}}
                        @else
                            @foreach ($value as $translation)
                                <li>
                                    {{$translation['pivot']['name']}}
                                </li>
                            @endforeach
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection