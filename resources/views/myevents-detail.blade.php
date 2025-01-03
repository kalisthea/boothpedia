<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-admin.css') }}">
    <title>{{ $event->name }}</title>
</head>
<body>
    <!-- Side Bar -->
    @include('sidebar')

    <!-- Content -->
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-name">
                <h1>My Event</h1>
            </div>
            @include('navheader')
        </div>
        <!-- My Event Content -->
        <div class="event-content">
            @php
                $src = 'data:image/jpeg;base64,' . base64_encode($event->banner_photo);
            @endphp
            <!-- Banner -->  
            <img src="{{ $src }}" alt="" class="banner"> 

            <!-- Event Detail Content -->  
            <div class="detailevent-content" style="margin-bottom:50px;">  
                <!-- Left box: Event Detail -->  
                <div class="box-event event-details">  
                    <p style="font-size:16px; padding-bottom:2px;">Event Name</p>
                    <p style="font-size:24px; padding-bottom:15px;"><strong>{{ $event->name }}</strong></p>  
                    <p style="font-size:16px; padding-bottom:2px;">Event Category</p>
                    <p style="font-size:24px; padding-bottom:15px;"><strong>{{ $event->category }}</strong></p>
                    <p style="font-size:16px; padding-bottom:2px;">Venue</p>
                    <p style="font-size:24px; padding-bottom:15px;"><strong>{{ $event->venue }}</strong></p>
                    <p style="font-size:16px; padding-bottom:2px;">Location</p>
                    <p style="font-size:24px; padding-bottom:15px;"><strong>{{ $event->location }}</strong></p>
                    <div class="event-date-container">
                        <div class="start-date">
                            <p style="font-size:16px; padding-bottom:2px;">Start Date</p>
                            <p style="font-size:24px; padding-bottom:15px;"><strong>{{ \Carbon\Carbon::parse($event->start_date)->format('d-m-Y') }}</strong></p>
                        </div>
                        <div class="end-date">
                            <p style="font-size:16px; padding-bottom:2px;">End Date</p>
                            <p style="font-size:24px; padding-bottom:15px;"><strong>{{ \Carbon\Carbon::parse($event->end_date)->format('d-m-Y') }}</strong></p>
                        </div>                         
                    </div>
                    <div class="event-button-container" style="display: flex; justify-content: flex-end;">
                        <a href="{{ route('myevent.edit', ['event_name' => $event->name, 'id' => $event->id]) }}" class="edit-event-button">
                            <i class="fa-regular fa-pen-to-square"></i>Edit Event
                        </a>
                        <form action="{{ route('event.delete', ['event_name' => $event->name, 'id' => $event->id]) }}" method="POST" onsubmit="return confirmDeletion(this, 'event');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-event-button" style="margin-left: 10px;">
                                <i class="fa-regular fa-trash-can"></i>Delete Event
                            </button>
                        </form>
                    </div> 
                     
                </div>  

                <!-- Right box: Event Description -->  
                <div class="box-event">  
                    <p><strong>Description</strong></p>
                    <p class="description">
                        {{ $event->description }}  
                    </p>  
                    <div class="group-btn" style="display:block;">
                        <a href="{{ route('mybooth', ['event_name' => $event->name]) }}" class="booth-button" >
                            <i class="fa-solid fa-store"></i>My Booths
                        </a>
                        <a href="{{ route('myevent.proposal', ['event_name' => $event->name]) }}" class="booth-button" target="_blank">
                            <i class="fa-solid fa-file-pdf"></i>Proposal Event
                        </a>
                        <a href="{{ route('invoice', ['event_name' => $event->name]) }}"  class="booth-button">
                            <i class="fa-solid fa-receipt"></i>Invoices
                        </a>
                    </div>
                </div>  
            </div>
        </div>
        <div class="back-button-container">  
            <a href="{{ route('events') }}" class="back-button">Back</a>  
        </div> 
    </div>
</body>
</html>