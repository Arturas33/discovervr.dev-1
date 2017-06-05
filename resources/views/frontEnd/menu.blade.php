
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @foreach($list as $key => $record)
                    <li class="active">
                        @if(isset($record['sub_category']) && sizeof($record['sub_category']) > 0)
                            <a id="dropdownMenu1" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="true" href="{{$record['url'] }}"> {{$record['name']}} <i class="fa fa-caret-down" aria-hidden="true"></i> </a>
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
                    <li class="active">
                        <a id="dropdownMenu1" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="true" href="{{$record['url'] }}"> {{$record['name']}} <i class="fa fa-caret-down" aria-hidden="true"></i> </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1"></ul>
                    </li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
