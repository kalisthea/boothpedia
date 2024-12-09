<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <title>Home Boothpedia</title>
</head>

<body>
  <header>
    <img class= "blogo" src="images/Logo.png" alt="">
    <nav class="navbar">
      <div class='nav-left'>
        <a class = "active" href="home">Home</a></li>
        <a href="explore">Explore</a></li>
        <a href="booth">Booth</a></li>
      </div>
      <div  class="nav-right">
        <input class="search-hold" type="text" placeholder="Search">
          <a href=""><img style="width:35px; height:auto;" src="images/mail.png" alt=""></a>
          <a href="/profile"><img style="width:35px; height:auto;" src="images/user.png" alt=""></a>
      </div>
    </nav>
  </header>
  
  <hr style="border: 2px solid #2FA8E8; color:#2FA8E8;">
  <hr style="border: 2px solid #FFC60B; color: #FFC60B;">

  <h2 style="color:#FFC60B; padding-bottom: 2rem; padding-top: 2rem;">Current Events</h2>

  

  <div class="card-container">
    @foreach ($events as $event)
      @php
          $src = base64_encode($event->banner_photo);
      @endphp
      <a href="{{ url('event-detail-desc/'.$event->name) }}">
        <div class="card">
          <img src="{{ $src }}" alt="">
          <div class="card-content">
            <div class="content-top"> 
              <b><p style="color:#FFC60B; margin-bottom:-1.5px;">{{ $event->name }}</p></b>
              <b><p style="color:#2FA8E8; margin-bottom:-1px;">{{ $event->category }}</p></b>
              <b><p style="color:#2FA8E8;">{{ $event->eo->name }}</p></b>
            </div>
            <div class="content-bottom">
              <p style="margin-bottom:-0.2px">{{ $event->start_date }} - {{ $event->end_date }}</p>
              <p style="margin-bottom:-0.2px">{{ $event->location }}</p>
              <p>Rp 100.000,00 - Rp 300.000,00</p>
            </div>
          </div>
        </div>
      </a>
    @endforeach
  </div>
  {{-- <div class="card-container">
    <a href="/event-detail-desc">
      <div class="card">
        <img src="images/evt-1.png" alt="">
        <div class="card-content">
          <div class="content-top"> 
            <b><p style="color:#FFC60B; margin-bottom:-1.5px;">MafSuzon</p></b>
            <b><p style="color:#2FA8E8; margin-bottom:-1px;">Social Gathering</p></b>
            <b><p style="color:#2FA8E8;">EO ABC</p></b>
          </div>
          <div class="content-bottom">
            <p style="margin-bottom:-0.2px">12-02-2050 - 15-02-2050</p>
            <p style="margin-bottom:-0.2px">Ciputat</p>
            <p>Rp 100.000,00 - Rp 300.000,00</p>
          </div>
        </div>
    </div>
    </a>

    <div class="card">
      <img src="images/evt-1.png" alt="">
      <div class="card-content">
        <div class="content-top"> 
          <b><p style="color:#FFC60B; margin-bottom:-1.5px;">MafSuzon</p></b>
          <b><p style="color:#2FA8E8; margin-bottom:-1px;">Social Gathering</p></b>
          <b><p style="color:#2FA8E8;">EO ABC</p></b>
        </div>
        <div class="content-bottom">
          <p style="margin-bottom:-0.2px">12-02-2050 - 15-02-2050</p>
          <p style="margin-bottom:-0.2px">Ciputat</p>
          <p>Rp 100.000,00 - Rp 300.000,00</p>
        </div>
      </div>
    </div>
    <div class="card">
      <img src="images/evt-1.png" alt="">
      <div class="card-content">
        <div class="content-top"> 
          <b><p style="color:#FFC60B; margin-bottom:-1.5px;">MafSuzon</p></b>
          <b><p style="color:#2FA8E8; margin-bottom:-1px;">Social Gathering</p></b>
          <b><p style="color:#2FA8E8;">EO ABC</p></b>
        </div>
        <div class="content-bottom">
          <p style="margin-bottom:-0.2px">12-02-2050 - 15-02-2050</p>
          <p style="margin-bottom:-0.2px">Ciputat</p>
          <p>Rp 100.000,00 - Rp 300.000,00</p>
        </div>
      </div>
    </div>
    <div class="card">
      <img src="images/evt-1.png" alt="">
      <div class="card-content">
        <div class="content-top"> 
          <b><p style="color:#FFC60B; margin-bottom:-1.5px;">MafSuzon</p></b>
          <b><p style="color:#2FA8E8; margin-bottom:-1px;">Social Gathering</p></b>
          <b><p style="color:#2FA8E8;">EO ABC</p></b>
        </div>
        <div class="content-bottom">
          <p style="margin-bottom:-0.2px">12-02-2050 - 15-02-2050</p>
          <p style="margin-bottom:-0.2px">Ciputat</p>
          <p>Rp 100.000,00 - Rp 300.000,00</p>
        </div>
      </div>
    </div>
  </div> --}}

  <h2 style="color:#2FA8E8; padding-top: 4rem; padding-bottom: 2rem;">Events You Might Like</h2>

  <div class="card-container">
    <div class="card">
        <img src="images/evt-1.png" alt="">
        <div class="card-content">
          <div class="content-top"> 
            <b><p style="color:#FFC60B; margin-bottom:-1.5px;">MafSuzon</p></b>
            <b><p style="color:#2FA8E8; margin-bottom:-1px;">Social Gathering</p></b>
            <b><p style="color:#2FA8E8;">EO ABC</p></b>
          </div>
          <div class="content-bottom">
            <p style="margin-bottom:-0.2px">12-02-2050 - 15-02-2050</p>
            <p style="margin-bottom:-0.2px">Ciputat</p>
            <p>Rp 100.000,00 - Rp 300.000,00</p>
          </div>
        </div>
    </div>
    <div class="card">
      <img src="images/evt-1.png" alt="">
      <div class="card-content">
        <div class="content-top"> 
          <b><p style="color:#FFC60B; margin-bottom:-1.5px;">MafSuzon</p></b>
          <b><p style="color:#2FA8E8; margin-bottom:-1px;">Social Gathering</p></b>
          <b><p style="color:#2FA8E8;">EO ABC</p></b>
        </div>
        <div class="content-bottom">
          <p style="margin-bottom:-0.2px">12-02-2050 - 15-02-2050</p>
          <p style="margin-bottom:-0.2px">Ciputat</p>
          <p>Rp 100.000,00 - Rp 300.000,00</p>
        </div>
      </div>
    </div>
    <div class="card">
      <img src="images/evt-1.png" alt="">
      <div class="card-content">
        <div class="content-top"> 
          <b><p style="color:#FFC60B; margin-bottom:-1.5px;">MafSuzon</p></b>
          <b><p style="color:#2FA8E8; margin-bottom:-1px;">Social Gathering</p></b>
          <b><p style="color:#2FA8E8;">EO ABC</p></b>
        </div>
        <div class="content-bottom">
          <p style="margin-bottom:-0.2px">12-02-2050 - 15-02-2050</p>
          <p style="margin-bottom:-0.2px">Ciputat</p>
          <p>Rp 100.000,00 - Rp 300.000,00</p>
        </div>
      </div>
    </div>
    <div class="card">
      <img src="images/evt-1.png" alt="">
      <div class="card-content">
        <div class="content-top"> 
          <b><p style="color:#FFC60B; margin-bottom:-1.5px;">MafSuzon</p></b>
          <b><p style="color:#2FA8E8; margin-bottom:-1px;">Social Gathering</p></b>
          <b><p style="color:#2FA8E8;">EO ABC</p></b>
        </div>
        <div class="content-bottom">
          <p style="margin-bottom:-0.2px">12-02-2050 - 15-02-2050</p>
          <p style="margin-bottom:-0.2px">Ciputat</p>
          <p>Rp 100.000,00 - Rp 300.000,00</p>
        </div>
      </div>
    </div>
  </div>


 
    
</body>
</html>