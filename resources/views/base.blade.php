<!DOCTYPE html>

<html lang="en">
<head>
    @include('style')

    <meta name="csrf-token" content="{{ csrf_token() }}"/>

</head>

<body>


@include('admin.messages')
<div class="menu.container-fluid">
    <div class="row">
        <div class="col-md-2">
            @include('menu_admin')
        </div>
        <div class="col-md-10">
            @yield('content')
        </div>

    </div>
</div>


</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</html>

@yield('scripts')