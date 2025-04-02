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
                    <div class="row ">
                        <div class="col-lg-8 col-12 order-1 order-lg-0 ">
                            <div class="section-title  mt-4 contact-form-wrapper mt-lg-0  bg-gray">
                                <h3 class="title text-center">Upcoming Events</h3>
                                <div class="container mt-4 bg-gray dropdown-scroll" style="max-height: 500px; overflow-y: auto;">
                                    <div class="row">
                                        @foreach($training as $events)
                                            <div class="col-md-12 mt-4  ">
                                                <div class="card mb-3 shadow-lg " style="background: rgba(250,247,247,0.68);">
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

@push('script')

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
