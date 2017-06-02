@extends('base')
@section('content')

    <div class="container">
        <table class="table table-bordered">
            <tr>
                <th>Key</th>
                <th>Value</th>
            </tr>
            @foreach($item as $key => $value)
                @if(!is_array($value))
                    <tr>
                        <td>{{$key}}</td>
                        <td>{{$value}}</td>
                    </tr>

                @elseif ($key == 'translation')
                    @foreach ($value as $key => $translation)
                        @foreach ($translation['pivot'] as $key => $lang)
                            @if(!in_array($key, $ignore))
                                {{$key . ' ' . $translation['pivot']['language_code']}}
                                {{$lang}}
                            @endif
                        @endforeach
                    @endforeach
                @elseif ($key == 'category')
                    @foreach ($value['translation'] as $key => $translation)
                        @foreach ($translation['pivot'] as $key => $lang)
                            @if($key != 'category_id' && $key != 'language_code')
                                <tr>
                                    <td>
                                        {{'Category ' . $key . ' ' . $translation['pivot']['language_code']}}
                                    </td>
                                    <td>
                                        {{$lang}}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                @elseif($key == 'resource')
                    <img src="{{asset($value['path'])}}" class="img-rounded" alt="Cinque Terre" width="304"
                         height="236">
                @endif

            @endforeach
        </table>
    </div>
@endsection