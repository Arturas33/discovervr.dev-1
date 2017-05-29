@extends('base')

@section('content')

<div><a href="{{ route($create) }}">Sukurk nauja meniu</a></div>
Meniu yra sie:



@foreach($menu as $item)
	<div id="{{$item['id']}}">
        Pavadinimas: <a href = "{{$item['url']}}", target="_blank" >{{ $item ['name'] }}</a>
        Url: {{$item['url']}}
        Pozicija: {{$item['sequence']}}

        <a href={{ route($edit,$item['id']) }}><button type="button">Edit</button></a>
        <button onclick="deleteItem( '{{ route($delete, $item['id']) }}' )">Delete</button>
    </div>

 @endforeach

@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function deleteItem(route) {
            $.ajax({
                url: route,
                type: 'DELETE',
                dataType: 'json',
                success: function (response) {
                    $('#' + response.id).remove();
                },
                error: function () {
                    alert('ERROR')
                }
            });
        }

    </script>
@endsection