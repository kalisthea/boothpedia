<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/style-admin.css">
    <script type="text/javascript" src="myscript.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <title>My Booth's Boothpedia</title>
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
          <input class="search-hold-2" type="text" placeholder="Search">
          <a href="/chatmessage"><img style="width:35px; height:auto;" src="{{ asset('images/mail.png') }}" alt=""></a>
          <a href="/tenant-profile"><img style="width:35px; height:auto;" src="{{ asset('images/user.png') }}" alt=""></a>
        </div>
      </nav>
  </header>
    
      <hr style="border: 2px solid #2FA8E8; color:#2FA8E8;">
      <hr style="border: 2px solid #FFC60B; color: #FFC60B;">

      <h2 style="color:#FFC60B; padding-bottom: 2rem; padding-top: 2rem;">Booked Events</h2>
      
        <div class="booth-card-container">
          @foreach($invoices as $invoice)
            <div class="booth-card">
                <div style="width:290px; height: 150px;">
                  <img style="width: 100%; height:100%; object-fit:cover; border-radius:18px;" src="data:image/jpeg;base64,{{ base64_encode($invoice->event->banner_photo) }}" alt="">
                </div>
                  <div class="card-content">
                  <div class="content-top"> 
                    <b><p style="color:#FFC60B; margin-bottom:-1.5px;">{{ $invoice->event->name }}</p></b>
                    <b><p style="color:#2FA8E8; margin-bottom:-1px;">{{ $invoice->event->category }}</p></b>
                    <b><p style="color:#2FA8E8;">{{ $invoice->event->user->name }}</p></b>
                  </div>
                  <div class="content-bottom">
                    <p style="margin-bottom:-0.2px">{{ $invoice->event->start_date }} - {{ $invoice->event->end_date }}</p>
                    <p style="margin-bottom:-0.2px">{{ $invoice->event->location }}</p>
                  </div>
                  <div class="content-cta">
                    @php
                      $boothNames = [];
                      foreach($invoice->booths as $booth){
                        $boothNames[] = $booth->booth_name;
                      }
                      $boothNamesString = implode(', ', $boothNames); 
                    @endphp
                    <b><p style="color: #FFC60B; font-size: 15px;">{{ $boothNamesString }}</p></b>
                    <a href="{{ url('booking-detail/'. $invoice->event->name) }}"><button class="detail-button" type="button" style="padding">Detail</button></a>
                  </div>
                </div>
            </div>
            @endforeach
        </div>
          
      


      <h2 style="color:#2FA8E8; padding-bottom: 2rem; padding-top: 5rem;">Past Events</h2>

      <div class="booth-card-container">
        @foreach($pastinvoices as $invoice)
          <div class="booth-card">
              <div style="width:290px; height: 150px;">
                <img style="width: 100%; height:100%; object-fit:cover; border-radius:18px;" src="data:image/jpeg;base64,{{ base64_encode($invoice->event->banner_photo) }}" alt="">
              </div>
                <div class="card-content">
                <div class="content-top"> 
                  <b><p style="color:#FFC60B; margin-bottom:-1.5px;">{{ $invoice->event->name }}</p></b>
                  <b><p style="color:#2FA8E8; margin-bottom:-1px;">{{ $invoice->event->category }}</p></b>
                  <b><p style="color:#2FA8E8;">{{ $invoice->event->user->name }}</p></b>
                </div>
                <div class="content-bottom" style="padding-bottom: 1rem;">
                  <p style="margin-bottom:-0.2px">{{ $invoice->event->start_date }} - {{ $invoice->event->end_date }}</p>
                  <p style="margin-bottom:-0.2px">{{ $invoice->event->location }}</p>
                </div>
                <div class="content-cta-2">
                  <a href="{{ url('booking-detail/'. $invoice->event->name) }}"><button class="detail-button" type="button">Detail</button></a>
                  @if (! $invoice->event->user->isRatedBy(Auth::user(), $invoice->event)) 
                    <button class="rate-button" type="button" onclick="ratingPopup('{{ $invoice->event->user->id }}', '{{ $invoice->event->user->name }}', '{{ $invoice->event->id }}')">Rate</button>
                  @else
                    <button class="rate-button" type="button" disabled>Rated</button> 
                  @endif
                  </div>
              </div>
          </div>
          @endforeach
      </div>

    
      <div id="overlay" class="overlay">
        <div id="ratePopup" class="rate-popup">
          <b><p style="color: #FFC60B">Rate Event Organizer</p></b>
          <b><p style="color: #2FA8E8" id="eoName"></p></b>
          <form action="{{ route('rate.eo') }}" method="POST">
            @csrf
            <div class="rating" style="padding-bottom: 1rem;">
              <input type="radio" id="star5" name="rating" value="1">
              <label for="1" style="padding-right: 1rem;">1</label>
              <input type="radio" id="star4" name="rating" value="2">
              <label for="2" style="padding-right: 1rem;">2</label>
              <input type="radio" id="star3" name="rating" value="3">
              <label for="3" style="padding-right: 1rem;">3</label>
              <input type="radio" id="star2" name="rating" value="4">
              <label for="4" style="padding-right: 1rem;">4</label>
              <input type="radio" id="star1" name="rating" value="5">
              <label for="5">5</label>
              <input type="hidden" name="eo_id" id="eo_id" value="">
              <input type="hidden" name="event_id" id="event_id" value="">
            </div>
            <p style="color:#FFC60B">Feedback/Comment</p>
            <input type="text" placeholder="Type here...." name="comment" style="padding-bottom: 1rem; margin-bottom: 10px;"><br>
            <button class="ok-button" style="background-color:#FFC60B; border-color:#FFC60B" type="submit">Done</button></a>
          </form>
        </div>
      </div>

      @if(session('success'))  
        <div id="sessionMessage" style="display: none;">{{ session('success') }}</div>  
        <div id="successModal" class="modal">  
            <div class="modal-content">  
                <span class="checkmark">
                    <i class="fa-solid fa-check"></i>
                </span> 
                <h5 id="modalMessage"></h5>
                <button id="closeModal" class="close-button" style="color: white; background-color:#FFC60B">OK</button>  
            </div>  
        </div>  
      @endif

</body>
</html>