
<ul class="nav nav-pills">
@foreach($list as $key => $record)
        <li>
                @if(isset($record['sub_category']) && sizeof($record['sub_category']) > 0)
                        <a id="dropdownMenu1" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="true" href="{{$record['url'] }}"><i class="fa fa-caret-down" aria-hidden="true"></i> {{$record['name']}} </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        @foreach($record['sub_category'] as $key => $dropDown)
                            <li><a href=" {{$dropDown['url']}}"> {{$dropDown['name']}} </a></li>
                        @endforeach
                    </ul>
                @else
                    <a href=" {{$record['url'] }}"> {{$record['name']}} </a>
                @endif
        </li>
@endforeach
</ul>

{{--<ul class="nav nav-pills">--}}
    {{--<li role="presentation" class="active"><a href="#">Home</a></li>--}}
    {{--<li role="presentation"><a href="#">Profile</a></li>--}}
    {{--<li role="presentation"><a href="#">Messages</a></li>--}}
{{--</ul>--}}