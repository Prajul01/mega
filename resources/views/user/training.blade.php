@extends('user.layout.master')
@section('title')
    {{ 'Training' }}
@endsection
@section('seo_section')
    <meta name="description" content="{{ isset($setting) ? $setting->og_description : '' }}">
    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ isset($setting) ? $setting->og_title : '' }}">
    <meta property="og:description" content="{{ isset($setting) ? $setting->og_description : '' }}">
    <meta property="og:image"
        content="{{ isset($setting) ? asset('storage/setting/og-image/' . $setting->og_image) : '' }}">
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="{{ env('APP_URL') }}">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ isset($setting) ? $setting->og_title : '' }}">
    <meta name="twitter:description" content="{{ isset($setting) ? $setting->og_description : '' }}">
    <meta name="twitter:image"
        content="{{ isset($setting) ? asset('storage/setting/og-image/' . $setting->og_image) : '' }}">
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <!-- START HOME -->
            <section class="bg-home inner-page" id="home">
                <div class="bg-overlay"
                    style="background-image: url('{{ asset('frontend/assets/images/files/banner1.jpg') }}');"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="text-center text-white mb-5">
                                <h1 class="display-5 mb-3"> Training </h1>
                                <p class="fs-17">Mega Job is the perfect platform if you are looking for jobs and
                                    also looking for candidates.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end container-->
            </section>
            <!-- End Home -->
            <section class="home-jobs-wrapper bg-gray">
                <div class="container-fluid custom-container">
                    <div class="row">
                        <div class="col-lg-8 ">
                            <div class="section-title bg-white mt-4 contact-form-wrapper mt-lg-0">
                                <h3 class="title justify-content-center">                            Upcomming Events
                                </h3>
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
                        <!-- Modal -->

                        <div class="col-lg-4">
                            <div class="contact-info">
                                <div class="contact-info-heading">
                                    <div class="contact-info-title">
                                        Event Information
                                    </div>
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="eventModal" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered"> <!-- Added modal-dialog-centered -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel">Register for Event</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('enrollTraining') }}" enctype="multipart/form-data"  id="eventForm">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Your Name</label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Mobile</label>
                                            <input type="number" class="form-control" id="mobile" name="mobile" required>
                                        </div>
                                        <input type="hidden" id="event_id" name="event_id">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>
        <!-- End Page-content -->
        <div id="calendar"></div>
    </div>
@endsection
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            calendarEl.style.maxWidth = '500px'; // Adjust this value as needed
            calendarEl.style.fontSize = '0.8em'; // Makes text smaller

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [
                        @foreach ($training as $event)
                    {
                        title: "{{ $event['name'] }}",
                        start: "{{ $event['date'] }}",
                        description: "{{ $event['description'] }}",
                        backgroundColor: 'red',
                        textColor: 'white',
                        display: 'background' // This makes the event appear as background color only
                    },
                    @endforeach
                ],
                eventContent: function(arg) {
                    return { html: '' }; // Return empty content to hide the title
                },
                eventMouseEnter: function(info) {
                    var tooltip = document.createElement('div');
                    tooltip.className = 'event-tooltip';
                    tooltip.innerHTML = '<strong>' + info.event.title + '</strong><br>' + info.event.extendedProps.description;
                    document.body.appendChild(tooltip);

                    var left = info.jsEvent.pageX + 5;
                    var top = info.jsEvent.pageY + 5;

                    tooltip.style.position = 'absolute';
                    tooltip.style.left = left + 'px';
                    tooltip.style.top = top + 'px';
                    tooltip.style.backgroundColor = 'black';
                    tooltip.style.color = 'white';
                    tooltip.style.padding = '10px';
                    tooltip.style.borderRadius = '5px';
                    tooltip.style.fontSize = '12px';
                    tooltip.style.zIndex = '9999';
                    tooltip.style.maxWidth = '200px';
                    tooltip.style.wordWrap = 'break-word';
                },
                eventMouseLeave: function() {
                    var tooltips = document.querySelectorAll('.event-tooltip');
                    tooltips.forEach(function(tooltip) {
                        tooltip.remove();
                    });
                }
            });

            calendar.render();
        });

        document.addEventListener("DOMContentLoaded", function () {
            // Select all enroll buttons
            const enrollButtons = document.querySelectorAll(".enroll-btn");


            enrollButtons.forEach(button => {
                button.addEventListener("click", function () {
                    // Get event ID from the clicked button
                    let eventId = this.getAttribute("data-eventid");
                    console.log('eventId',eventId)

                    // Set the event ID in the hidden input field of the form
                    document.getElementById("event_id").value = eventId;
                });
            });
        });
    </script>
@endpush
