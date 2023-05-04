@extends(backpack_view('blank'))

<style>
    #calendar {
      width: 100%;
      margin: 0 auto;
    }

    .fc-scrollgrid-sync-table {
        width: 100vw !important;
        height: 100% !important;
    }

    a.fc-event {
        background-color: #009B77;
        color: #fff !important;
    }

    a.fc-event:hover {
        color: #000 !important;
    }
</style>


@section('header')
	<section class="container-fluid d-print-none">

		<h2>
	        <span class="text-capitalize">planner</span>
	    </h2>
    </section>
@endsection

@section('content')
<div class="row">
    <div id='calendar'></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: {!! json_encode($events) !!},
            eventTimeFormat: {
                hour: 'numeric',
                minute: '2-digit',
                meridiem: 'short'
            },

        });

        calendar.render();
        });
    </script>

</div>
@endsection


@section('after_styles')
	<link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/crud.css').'?v='.config('backpack.base.cachebusting_string') }}">
	<link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/show.css').'?v='.config('backpack.base.cachebusting_string') }}">
@endsection

@section('after_scripts')
	<script src="{{ asset('packages/backpack/crud/js/crud.js').'?v='.config('backpack.base.cachebusting_string') }}"></script>
	<script src="{{ asset('packages/backpack/crud/js/show.js').'?v='.config('backpack.base.cachebusting_string') }}"></script>
@endsection
