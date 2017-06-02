@extends('styleFrontEnd')



@foreach($list as $key => $record  )

    <div class="col-md-2 dropdown">
        <ul>
            @if (isset($record['sub_category']) && sizeof($record['sub_category']) > 0)
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="true">
                    <li><a href=" {{ $record['url'] }}"> {{$record['name']}} </a></li>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    @foreach($record['sub_category'] as $key => $dropDown)
                        <li><a href=" {{ $dropDown['url'] }}"> {{$dropDown['name']}} </a></li>
                        <li role="separator" class="divider"></li>
                    @endforeach
                </ul>

            @else
                <a href=" {{ $record['url'] }}"> {{$record['name']}} </a>
            @endif

        </ul>

    </div>
@endforeach



