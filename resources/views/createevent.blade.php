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
        <h1>Create Event</h1>
    </header>
    <form class="create-event-container" id="eventForm" method="POST" enctype="multipart/form-data" action="{{ route('events.store') }}">
        @csrf  
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
                <input type="text" name="name" id="name" placeholder="Input event name..." required>
            </li>
            <li class="event-category">
                <label for="category">Event Category</label>
                <select name="category" id="category" required>  
                    <option hidden>Choose category...</option>
                    <option value="Education">Education</option>
                    <option value="Fashion & Beauty">Fashion & Beauty</option>
                    <option value="Hobbies & Crafts">Hobbies & Crafts</option>
                    <option value="Music">Music</option>
                    <option value="Food & Drinks">Food & Drinks</option>
                    <option value="Art & Culture">Art & Culture</option>
                    <option value="Tech & Start Up">Tech & Start Up</option>
                    <option value="Travel & Vacation">Travel & Vacation</option>
                </select>
            </li>
            <div class="date-container">
                <li class="date-field">
                    <label for="start_date">Start Date</label>
                    <div class="input-date-wrapper">
                        <input type="date" name="start_date" id="start_date" required>
                    </div>
                </li>
                <li class="date-field">
                    <label for="end_date">End Date</label>
                    <div class="input-date-wrapper">
                        <input type="date" name="end_date" id="end_date" required>
                    </div>
                </li>
            </div>
            <li class="location">
                <label for="location">Location</label>
                <input type="text" name="location" id="location" placeholder="Input location..." required>
            </li>
            <li class="venue">
                <label for="venue">Venue</label>
                <input type="text" name="venue" id="venue" placeholder="Input venue..." required>
            </li>
            <li class="desc">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" placeholder="Input description..." required>
            </li>
            <li class="button-container">
                <a href="{{route('dashboard')}}">
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