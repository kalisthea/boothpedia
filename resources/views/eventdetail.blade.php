<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <title>{{ $events->name }}</title>
</head>
<body>
  <header>
    <img class= "blogo" src="{{ asset('images/Logo.png') }}" alt="">
    <nav class="navbar">
      <div class='nav-left'>
        <a class = "active" href="home">Home</a></li>
        <a href="explore">Explore</a></li>
        <a href="booth">Booth</a></li>
      </div>
      <div  class="nav-right">
        <input class="search-hold" type="text" placeholder="Search">
        <a href="/chatmessage"><img style="width:35px; height:auto;" src="{{ asset('images/mail.png') }}" alt=""></a>
        <a href="/tenant-profile"><img style="width:35px; height:auto;" src="{{ asset('images/user.png') }}" alt=""></a>
      </div>
    </nav>
  </header>

  <hr style="border: 2px solid #2FA8E8; color:#2FA8E8;">
  <hr style="border: 2px solid #FFC60B; color: #FFC60B;">
  <div style="width:1250px; height: 260px; position: relative; left: 14rem;">
    <img class="evt-detail-img" style="width: 100%; height:100%; object-fit:cover; border-radius:18px;" src="data:image/jpeg;base64,{{ $events->image_base64 }}" alt="">
  </div>
  <div class="detail-container">
    <div class="detail-1">
      <div class="detail-content-1">
        <b><p style="color:#2FA8E8">{{ $events->name }}</p></b>
        <p style="color: #FFC60B">{{ $events->category }}</p>
        <p style="padding-top:2rem;">{{ $events->location }}</p>
        <p>{{ $events->venue }}</p>
      </div>
      <div class="detail-content-2">
        @php
          use App\Models\Rating;
          $getEO = $events->user->id;

          $averageRating = Rating::where('eo_id', $getEO)->avg('rating'); 
        @endphp
        <p>Event Organizer : {{ $events->user->name }}</p>
        <p>Rating : {{ number_format($averageRating, 1, '.', ''); }}/5</p>
        <p>{{ $events->start_date }} - {{ $events->end_date }}</p>
      </div>
    </div>
  </div>

  <div class="nav-detail">
    <div class="nav-desc-active">
        <b><p>Description</p></b>
    </div>
    <div class="nav-booth">
      <b><a href="{{ url('event-detail-booth/' . $events->name) }}"><p>Booth</p></a></b>
    </div>
  </div>

  <p style="padding-left: 17rem; padding-right: 17rem; padding-top: 2rem;"> {{ $events->description }} </p>

  <a href="{{ route('event.proposal', ['event_name' => $events->name]) }}" target="_blank" style="padding-left: 17rem;">View Event Proposal</a>


</body>
</html>