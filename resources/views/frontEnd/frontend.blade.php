<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">

        @foreach($list as $key => $record  )

            <div class="col-md-2">
                <ul>
                    <li><a href=" {{ $record['url'] }}"> {{$record['name']}} </a></li>

                </ul>
                @foreach($listDropDown as $key => $dropDown  )
                    <ul>
                        @if($dropDown['vr_parent_id'] == $record['id'])
                            <ul>
                                <li><a href=" {{ $dropDown['url'] }}"> {{$dropDown['name']}} </a></li>
                            </ul>
                        @endif
                    </ul>
                @endforeach
            </div>
        @endforeach


    </div>
</nav>
