<html lang="en">
<head>
    {{--{{dd($checkRoomTimes)}}--}}
    @include('style')
    {{--<meta charset="utf-8">--}}
    <script src="http://code.jquery.com/jquery-2.0.0.js"></script>
    {!! Form::open(['url' => route('app.orders.create')]) !!}

    {{ Form::select('date', $date, null, ['id' => 'date']) }} <br>

        @foreach($rooms as $key => $room)

        <div id={{$key}}>
                {{ Form::checkbox('room[]', $key) }}
                {{$room}}
                @foreach($dateTimeArray as $day => $hours)
                    @foreach ($hours as $hour)
                    @if(isset($checkRoomTimes[$room]) && in_array($day.' '.$hour.':00', $checkRoomTimes[$room]))
                        <span class="hidden">
                            {{ Form::checkbox($key.'time[]', $day.' '.$hour, true, ['class' => 'hours']) }}
                            {{ Form::label($day.' '.$hour, $hour)}}
                        </span>
                    @else
                        <span class="hidden">
                            {{ Form::checkbox($key.'time[]', $day.' '.$hour, null, ['class' => 'hours']) }}
                            {{ Form::label($day.' '.$hour, $hour)}}
                        </span>
                    @endif
                    @endforeach
                @endforeach
                </div>
            @endforeach

        {{ Form::submit('Order') }}
    <script>
        function showFirst() {
            $(".hours").each(function () {
                if ($(this).val().slice(0,-6) == $('#date').val()) {
                    $(this).parent().removeClass('hidden');
                }
            });
        }
        showFirst();

                           $('#date').on('change', hideTimes);
                       function hideTimes() {
                           $(".hours").each(function () {
                               if ($(this).val().slice(0,-6) == $('#date').val()) {
                                   $(this).parent().removeClass('hidden');
                               } else if(!$(this).parent().hasClass('hidden')) {
                                   $(this).parent().addClass('hidden');
                               } else {

                   }
               });
           }
    </script>
