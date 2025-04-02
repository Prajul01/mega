@extends('user.layout.master')
@section('title')
    {{ 'Training' }}
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <!-- Banner Section -->
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

            <!-- Main Content Section -->
            <section class="home-jobs-wrapper bg-gray">
                <div class="container-fluid custom-container">
                    <div class="row">
                        <!-- Events List -->
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

                        <!-- Calendar Section -->
                        <div class="col-lg-4 col-12 ">
                            <div class=" bg-white p-3 rounded shadow-sm">
                                <h4 class="text-center mb-3">Event Calendar</h4>
                                <div class="">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enrollment Modal -->
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

@push('style')

    <style>
        #calendar-wrapper {
            width: 100%;
            min-height: 400px; /* Prevents calendar collapse */
        }
        #calendar {
            min-width: 100%;
            min-height: 400px;
        }
        @media (max-width: 700px) {
            .fc-toolbar {
                flex-direction: column;
            }
        }


    </style>


@endpush

@push('script')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize calendar
            const calendarEl = document.getElementById('calendar');
            const isMobile = window.matchMedia('(max-width: 767.98px)').matches;

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev',
                    center: 'title',
                    right: 'next'
                },
                footerToolbar: {
                    center: 'today'
                },
                views: {
                    dayGridMonth: {
                        titleFormat: { year: 'numeric', month: 'short' },

                        dayMaxEvents: true
                    }
                },
                events: [
                        @foreach ($training as $event)
                    {
                        title: "{{ $event->name }}",
                        start: "{{ $event->date }}",
                        description: "{{ $event->description }}",
                        backgroundColor: '#dc3545',
                        textColor: 'white',
                        display: 'background'
                    },
                    @endforeach
                ],
                height: 'auto',
                fixedWeekCount: false,
                showNonCurrentDates: true, // Changed to true to ensure all dates show
                dayCellContent: function(arg) {
                    // Custom day cell content to ensure dates are visible
                    return { html: '<div class="fc-daygrid-day-number">' + arg.dayNumberText + '</div>' };
                },
                eventMouseEnter: function(info) {
                    const tooltip = document.createElement('div');
                    tooltip.className = 'event-tooltip';
                    tooltip.innerHTML = `
                    <strong>${info.event.title}</strong><br>
                    <small>${info.event.start.toLocaleDateString()}</small><br>
                    <p>${info.event.extendedProps.description || 'No description available'}</p>
                `;

                    document.body.appendChild(tooltip);

                    const updatePosition = function() {
                        const x = info.jsEvent.clientX + 10;
                        const y = info.jsEvent.clientY + 10;
                        tooltip.style.transform = `translate(${x}px, ${y}px)`;
                    };

                    updatePosition();
                    info.el.addEventListener('mousemove', updatePosition);

                    info.el.tooltip = {
                        element: tooltip,
                        updatePosition: updatePosition
                    };
                },
                eventMouseLeave: function(info) {
                    if (info.el.tooltip) {
                        info.el.removeEventListener('mousemove', info.el.tooltip.updatePosition);
                        info.el.tooltip.element.remove();
                        delete info.el.tooltip;
                    }
                },
            });

            calendar.render();
            // Enroll button functionality
            document.querySelectorAll('.enroll-btn').forEach(button => {
                button.addEventListener('click', function() {
                    document.getElementById('event_id').value = this.dataset.eventid;
                });
            });
        });


    </script>
@endpush

