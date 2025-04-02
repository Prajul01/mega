@extends('user.layout.master')
@section('title')
    {{ 'Training' }}
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <section class="bg-home inner-page" id="home">
                <div class="bg-overlay" style="background-image: url('{{ asset('frontend/assets/images/files/banner1.jpg') }}');"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="text-center text-white mb-5">
                                <h1 class="display-5 mb-3">Training</h1>
                                <p class="fs-17">Mega Job is the perfect platform for job seekers and employers.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="home-jobs-wrapper bg-gray">
                <div class="container-fluid custom-container">
                    <div class="row">
                        <div class="col-lg-8 col-12 order-1 order-lg-0">
                            <div class="section-title bg-white mt-4 contact-form-wrapper mt-lg-0">
                                <h3 class="title text-center">Upcoming Events</h3>
                                <div class="container mt-4 bg-gray dropdown-scroll" style="max-height: 500px; overflow-y: auto;">
                                    <div class="row">
                                        @foreach($training as $events)
                                            <div class="col-md-12 mt-4">
                                                <div class="card mb-3 shadow-sm">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $events->name }}</h5>
                                                        <p class="card-text">{{ $events->description }}</p>
                                                        <p class="card-text"><small class="text-muted">{{ $events->date }}</small></p>
                                                        <button class="btn btn-primary enroll-btn" data-bs-toggle="modal" data-bs-target="#eventModal"
                                                                data-eventid="{{ $events->id }}"
                                                                data-eventname="{{ $events->name }}">
                                                            Enroll
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12">
                            <div class="bg-white p-3 rounded shadow-sm mt-4 mt-lg-0">
                                <h4 class="text-center mb-3">Event Calendar</h4>
                                <div class="calendar-container">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel">Register for Event</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('enrollTraining') }}" id="eventForm">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Your Name</label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="mobile" class="form-label">Mobile</label>
                                            <input type="tel" class="form-control" id="mobile" name="mobile" required>
                                        </div>
                                        <input type="hidden" id="event_id" name="event_id">
                                        <button type="submit" class="btn btn-success w-100">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

{{--@push('style')--}}
{{--    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet'>--}}
{{--    <style>--}}
{{--        /* Calendar Container */--}}
{{--        .calendar-container {--}}
{{--            width: 100%;--}}
{{--            overflow-x: auto;--}}
{{--        }--}}

{{--        #calendar {--}}
{{--            width: 100%;--}}
{{--            min-height: 300px;--}}
{{--        }--}}

{{--        /* Calendar Header */--}}
{{--        .fc-header-toolbar {--}}
{{--            display: flex;--}}
{{--            justify-content: space-between;--}}
{{--            align-items: center;--}}
{{--            flex-wrap: wrap;--}}
{{--            margin-bottom: 10px !important;--}}
{{--        }--}}

{{--        @media (max-width: 699px) {--}}
{{--            .fc-header-toolbar {--}}
{{--                flex-direction: column;--}}
{{--                gap: 10px;--}}
{{--            }--}}
{{--        }--}}

{{--        /* Calendar Title */--}}
{{--        .fc-toolbar-title {--}}
{{--            font-size: 1.2rem;--}}
{{--            white-space: normal;--}}
{{--            text-align: center;--}}
{{--        }--}}

{{--        /* Day headers (Sun, Mon, etc.) */--}}
{{--        .fc-col-header-cell {--}}
{{--            padding: 2px !important;--}}
{{--        }--}}
{{--        .fc-col-header-cell-cushion {--}}
{{--            font-size: 0.8rem;--}}
{{--            padding: 2px !important;--}}
{{--            white-space: normal;--}}
{{--            line-height: 1.2;--}}
{{--        }--}}

{{--        /* Date cells */--}}
{{--        .fc-daygrid-day {--}}
{{--            min-height: 50px !important;--}}
{{--        }--}}
{{--        .fc-daygrid-day-number {--}}
{{--            font-size: 0.9rem;--}}
{{--            padding: 2px !important;--}}
{{--        }--}}

{{--        /* Today button */--}}
{{--        .fc-today-button {--}}
{{--            padding: 0.25rem 0.5rem;--}}
{{--            font-size: 0.8rem;--}}
{{--        }--}}

{{--        /* Navigation buttons */--}}
{{--        .fc-prev-button, .fc-next-button {--}}
{{--            padding: 0.25rem 0.5rem;--}}
{{--            font-size: 0.8rem;--}}
{{--        }--}}

{{--        /* Tooltip styling */--}}
{{--        .event-tooltip {--}}
{{--            position: fixed;--}}
{{--            background: white;--}}
{{--            padding: 8px;--}}
{{--            border-radius: 4px;--}}
{{--            box-shadow: 0 2px 8px rgba(0,0,0,0.1);--}}
{{--            z-index: 9999;--}}
{{--            max-width: 200px;--}}
{{--            font-size: 0.9rem;--}}
{{--        }--}}

{{--        /* Make sure the calendar displays on all screen sizes */--}}
{{--        @media (max-width: 699px) {--}}
{{--            .fc-daygrid-day-number {--}}
{{--                font-size: 0.8rem;--}}
{{--                padding: 1px !important;--}}
{{--            }--}}

{{--            .fc-col-header-cell-cushion {--}}
{{--                font-size: 0.7rem;--}}
{{--            }--}}

{{--            .fc-toolbar-title {--}}
{{--                font-size: 1rem;--}}
{{--            }--}}
{{--        }--}}
{{--         .event-tooltip {--}}
{{--             position: absolute;--}}
{{--             background: rgba(0, 0, 0, 0.8);--}}
{{--             color: white;--}}
{{--             padding: 5px 10px;--}}
{{--             border-radius: 5px;--}}
{{--             font-size: 14px;--}}
{{--             pointer-events: none;--}}
{{--             z-index: 1000;--}}
{{--         }--}}

{{--        /* Hide "all-day" label in listMonth view */--}}
{{--        .fc-list-event-time {--}}
{{--            display: none !important;--}}
{{--        }--}}
{{--    </style>--}}
{{--    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>--}}

{{--@endpush--}}


{{--@push('script')--}}
{{--    <script >--}}
{{--        document.addEventListener('DOMContentLoaded', function() {--}}
{{--            const calendarEl = document.getElementById('calendar');--}}

{{--            if (!calendarEl) {--}}
{{--                console.error("Calendar element not found!");--}}
{{--                return;--}}
{{--            }--}}

{{--            const calendar = new FullCalendar.Calendar(calendarEl, {--}}
{{--                initialView: window.innerWidth < 700 ? 'listMonth' : 'dayGridMonth',--}}
{{--                headerToolbar: {--}}
{{--                    left: '',--}}
{{--                    center: 'title',--}}
{{--                    right: ''--}}
{{--                },--}}
{{--                events: [--}}
{{--                        @foreach ($training as $event)--}}
{{--                    {--}}
{{--                        title: "{{ $event->name }}",--}}
{{--                        start: "{{ $event->date }}",--}}
{{--                        backgroundColor: '#dc3545',--}}
{{--                        textColor: 'white',--}}
{{--                        display: 'background', // Hide title by default--}}
{{--                    },--}}
{{--                    @endforeach--}}
{{--                ],--}}
{{--                height: 'auto',--}}
{{--                fixedWeekCount: false,--}}
{{--                showNonCurrentDates: true,--}}
{{--                contentHeight: 'auto',--}}

{{--                eventMouseEnter: function(info) {--}}
{{--                    const tooltip = document.createElement('div');--}}
{{--                    tooltip.className = 'event-tooltip';--}}
{{--                    tooltip.innerHTML = `<strong>${info.event.title}</strong>`;--}}
{{--                    document.body.appendChild(tooltip);--}}

{{--                    const updatePosition = function(e) {--}}
{{--                        tooltip.style.left = e.pageX + 10 + 'px';--}}
{{--                        tooltip.style.top = e.pageY + 10 + 'px';--}}
{{--                    };--}}

{{--                    updatePosition(info.jsEvent);--}}
{{--                    info.el.addEventListener('mousemove', updatePosition);--}}
{{--                    info.el.tooltip = { element: tooltip, updatePosition: updatePosition };--}}


{{--                },--}}

{{--                eventMouseLeave: function(info) {--}}
{{--                    if (info.el.tooltip) {--}}
{{--                        info.el.removeEventListener('mousemove', info.el.tooltip.updatePosition);--}}
{{--                        info.el.tooltip.element.remove();--}}
{{--                        delete info.el.tooltip;--}}
{{--                    }--}}

{{--                    // Remove event title when mouse leaves--}}
{{--                    if (info.el.titleElement) {--}}
{{--                        info.el.titleElement.remove();--}}
{{--                        delete info.el.titleElement;--}}
{{--                    }--}}
{{--                },--}}

{{--                windowResize: function() {--}}
{{--                    const newView = window.innerWidth < 700 ? 'listMonth' : 'dayGridMonth';--}}
{{--                    calendar.changeView(newView);--}}
{{--                    calendar.getEvents().forEach(event => {--}}
{{--                        event.setProp('display', newView === 'listMonth' ? 'block' : 'background');--}}
{{--                    });--}}
{{--                    calendar.updateSize();--}}
{{--                }--}}
{{--            });--}}

{{--            calendar.render();--}}
{{--        });--}}

{{--    </script>--}}

{{--@endpush--}}

@push('script')
{{--    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>--}}
{{--    <script>--}}
{{--        document.addEventListener('DOMContentLoaded', function() {--}}
{{--            const calendarEl = document.getElementById('calendar');--}}

{{--            if (!calendarEl) {--}}
{{--                console.error("Calendar element not found!");--}}
{{--                return;--}}
{{--            }--}}

{{--            const calendar = new FullCalendar.Calendar(calendarEl, {--}}
{{--                initialView: window.innerWidth < 700 ? 'listMonth' : 'dayGridMonth',--}}
{{--                headerToolbar: {--}}
{{--                    left: 'prev,next today',--}}
{{--                    center: 'title',--}}
{{--                    right: window.innerWidth < 700 ? 'listMonth' : 'dayGridMonth'--}}
{{--                },--}}
{{--                events: [--}}
{{--                        @foreach ($training as $event)--}}
{{--                    {--}}
{{--                        title: "{{ $event->name }}",--}}
{{--                        start: "{{ $event->date }}",--}}
{{--                        backgroundColor: '#dc3545',--}}
{{--                        textColor: 'white',--}}
{{--                        display: window.innerWidth < 700 ? 'block' : 'background', // Hide title by default--}}
{{--                    },--}}
{{--                    @endforeach--}}
{{--                ],--}}
{{--                height: 'auto',--}}
{{--                fixedWeekCount: false,--}}
{{--                showNonCurrentDates: true,--}}
{{--                contentHeight: 'auto',--}}
{{--                eventMouseEnter: function(info) {--}}
{{--                    const tooltip = document.createElement('div');--}}
{{--                    tooltip.className = 'event-tooltip';--}}
{{--                    tooltip.innerHTML = `<strong>${info.event.title}</strong>`;--}}
{{--                    document.body.appendChild(tooltip);--}}

{{--                    const updatePosition = function(e) {--}}
{{--                        tooltip.style.left = e.pageX + 50 + 'px';--}}
{{--                        tooltip.style.top = e.pageY + 10 + 'px';--}}
{{--                    };--}}

{{--                    updatePosition(info.jsEvent);--}}
{{--                    info.el.addEventListener('mousemove', updatePosition);--}}
{{--                    info.el.tooltip = { element: tooltip, updatePosition: updatePosition };--}}
{{--                },--}}
{{--                eventMouseLeave: function(info) {--}}
{{--                    if (info.el.tooltip) {--}}
{{--                        info.el.removeEventListener('mousemove', info.el.tooltip.updatePosition);--}}
{{--                        info.el.tooltip.element.remove();--}}
{{--                        delete info.el.tooltip;--}}
{{--                    }--}}
{{--                },--}}
{{--                windowResize: function() {--}}
{{--                    const newView = window.innerWidth < 700 ? 'listMonth' : 'dayGridMonth';--}}
{{--                    calendar.changeView(newView);--}}
{{--                    calendar.updateSize();--}}
{{--                }--}}
{{--            });--}}

{{--            calendar.render();--}}
{{--        });--}}
{{--    </script>--}}

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');

        if (!calendarEl) {
            console.error("Calendar element not found!");
            return;
        }

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: window.innerWidth < 700 ? 'listMonth' : 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: window.innerWidth < 700 ? 'listMonth' : 'dayGridMonth'
            },
            events: [
                    @foreach ($training as $event)
                {
                    title: "{{ $event->name }}",
                    start: "{{ $event->date }}",
                    backgroundColor: '#dc3545',
                    textColor: 'black',
                    display: window.innerWidth < 700 ? 'block' : 'background', // Hide title by default
                },
                @endforeach
            ],
            height: 'auto',
            fixedWeekCount: false,
            showNonCurrentDates: true,
            contentHeight: 'auto',
            eventContent: function(arg) {
                // Only show the event title (hide 'all-day' and red dot)
                return { html: `<div class="custom-event-title text-black">${arg.event.title}</div>` };
            },
            windowResize: function() {
                const newView = window.innerWidth < 700 ? 'listMonth' : 'dayGridMonth';
                calendar.changeView(newView);
                calendar.updateSize();
            }
        });

        calendar.render();
    });
</script>


@endpush

@push('style')
    <style>
        .fc-list-event-dot,  /* Hides red dot */
        .fc-list-event-time { /* Hides 'all-day' text */
            display: none !important;
        }

        .custom-event-title {
            font-size: 16px;
            font-weight: bold;
        }

        /* Navigation buttons styling */
        .fc-prev-button, .fc-next-button, .fc-today-button {
            padding: 5px 10px;
            font-size: 0.9rem;
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }

        .fc-today-button {
            margin-left: 5px;
        }

        @media (max-width: 700px) {
            .fc-toolbar-title {
                font-size: 1.1rem;
                margin: 0 5px;
            }

            .fc-prev-button, .fc-next-button {
                padding: 3px 8px;
                font-size: 0.8rem;
            }

            .fc-today-button {
                display: none; /* Hide today button on mobile */
            }
        }
    </style>
@endpush
