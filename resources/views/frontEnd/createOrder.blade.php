<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jQuery UI Datepicker - Default functionality</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>  $( function() {
            $(".datepicker").datepicker({
                dateFormat: 'Y/d/m',
                minDate: 0,
                maxDate: 30
            });
        } );
    </script>
    {!! Form::open(['url' => route('app.orders.create')]) !!}

        @foreach($rooms as $key => $room)
        {{ Form::checkbox('room[]', $key) }}
        {{$room}}
        {{ Form::text($key.'date', null, ['class' => 'datepicker ' . $key]) }}<br>
            @foreach ($time as $reservation)
            {{ Form::checkbox($key.'time[]', $reservation) }}
                {{$reservation}}
            @endforeach
        <label>
        </label><br>
        @endforeach

<script>
    var now = new Time();
    var daysOfYear = [];
    for (var d = new Date(2012, 0, 1); d <= now; d.setDate(d.getDate() + 1)) {
        daysOfYear.push(new Date(d));
    }
</script>

    {{ Form::submit('Order') }}
