<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <script src="{{ asset('script.js') }}"></script>  
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-admin.css') }}">
    <title>Create Event</title>
</head>
<body>
    <header>
        <img src="images/Logo.png" alt="" class="logo">
        <h1>Edit Event</h1>
    </header>
    <form class="create-event-container" id="eventForm" method="POST" enctype="multipart/form-data" action="{{ route('myevent.update', $event->name) }}">
        @csrf
        @method('PUT')
        <div class="upload-image" style="display:flex;align-items:center;">
            <button type="button" class="upload-banner-button" onclick="document.getElementById('banner_photo').click();">  
                <i class="fas fa-upload"></i> Upload Banner  
            </button>  
            <input type="file" id="banner_photo" name="banner_photo" accept="image/*" style="display: none;" onchange="displayFileName('banner_photo', 'photoBanner');">  
            <span id="photoBanner" style="margin-left: 10px;"></span>  

            <button type="button" class="upload-proposal-button" onclick="document.getElementById('proposal_doc').click();">  
                <i class="fas fa-upload"></i> Upload Proposal Event  
            </button>  
            <input type="file" id="proposal_doc" name="proposal_doc" accept=".pdf" style="display: none;" onchange="displayFileName('proposal_doc', 'fileProp');">  
            <span id="fileProp" style="margin-left: 10px;"></span> 
        </div>
        <ul>
            <li class="event-name">
                <label for="name">Event Name</label>
                <input type="text" name="name" id="name" placeholder="Input event name..." value="{{ old('name', $event->name) }}">
            </li>
            <li class="event-category">
                <label for="category">Event Category</label>
                <select name="category" id="category">  
                    <option hidden>Choose category...</option>
                    <option value="Education" {{ $event->category == 'Education' ? 'selected' : '' }}>Education</option>  
                    <option value="Fashion & Beauty" {{ $event->category == 'Fashion & Beauty' ? 'selected' : '' }}>Fashion & Beauty</option>  
                    <option value="Hobbies & Crafts" {{ $event->category == 'Hobbies & Crafts' ? 'selected' : '' }}>Hobbies & Crafts</option>  
                    <option value="Music" {{ $event->category == 'Music' ? 'selected' : '' }}>Music</option>  
                    <option value="Food & Drinks" {{ $event->category == 'Food & Drinks' ? 'selected' : '' }}>Food & Drinks</option>  
                    <option value="Art & Culture" {{ $event->category == 'Art & Culture' ? 'selected' : '' }}>Art & Culture</option>  
                    <option value="Tech & Start Up" {{ $event->category == 'Tech & Start Up' ? 'selected' : '' }}>Tech & Start Up</option>  
                    <option value="Travel & Vacation" {{ $event->category == 'Travel & Vacation' ? 'selected' : '' }}>Travel & Vacation</option>
                </select>
            </li>
            <div class="date-container">
                <li class="date-field">
                    <label for="start_date">Start Date</label>
                    <div class="input-date-wrapper">
                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $event->start_date) }}">
                    </div>
                </li>
                <li class="date-field">
                    <label for="end_date">End Date</label>
                    <div class="input-date-wrapper">
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $event->end_date) }}">
                    </div>
                </li>
            </div>
            <li class="location">
                <label for="location">Location</label>
                <input type="text" name="location" id="location" placeholder="Input location..." value="{{ old('location', $event->location) }}">
            </li>
            <li class="venue">
                <label for="venue">Venue</label>
                <input type="text" name="venue" id="venue" placeholder="Input venue..." value="{{ old('venue', $event->venue) }}">
            </li>
            <li class="desc">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" placeholder="Input description..." value="{{ old('description', $event->description) }}">
            </li>
            <li class="button-container">
                <a href="{{route('myevent.detail', ['event_name' => $event->name])}}">
                    <button type="button" class="cancel-button" name="cancel">Cancel</button>
                </a>
                <input type="submit" class="submit-button" value="Save">
            </li>
        </ul>
    </form> 
    @if ($errors->any())  
    <div class="alert alert-danger">  
        <ul>  
            @foreach ($errors->all() as $error)  
                <li>{{ $error }}</li>  
            @endforeach  
        </ul>  
    </div>  
@endif
</body>
</html>