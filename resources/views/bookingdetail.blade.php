<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script type="text/javascript" src="{{ asset('myscript.js') }}"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <title>Booked {{ $events->name }}</title>
</head>
<body>
  <header>
    <img class= "blogo" src="{{ asset('images/Logo.png') }}" alt="">
      <nav class="navbar">
        <div class='nav-left'>
          <a class = "active" href="/home">Home</a></li>
          <a href="explore">Explore</a></li>
          <a href="booth">Booth</a></li>
        </div>
        <div  class="nav-right">
          <input class="search-hold" type="text" placeholder="Search">
          <a href=""><img style="width:35px; height:auto;" src="{{ asset('images/mail.png') }}" alt=""></a>
          <a href=""><img style="width:35px; height:auto;" src="{{ asset('images/user.png') }}" alt=""></a>
        </div>
      </nav>
  </header>
      <hr style="border: 2px solid #2FA8E8; color:#2FA8E8;">
      <hr style="border: 2px solid #FFC60B; color: #FFC60B;">

      <b><h2 style="color: #FFC60B; padding-bottom: 2rem; padding-top: 2rem;"> Successfully Booked Booth! </h2></b>
      
    @foreach($invoices as $invoice)
      <div class="booking-info-container">
        <div class=book-content>
            <b><p style="color: #2FA8E8; font-size: 30px; margin:-1px;">{{ $events->name }}</p></b>
            <p style="">{{ $events->category }}</p>
            <div class="book-content-mid">
                <p>{{ $events->start_date }} - {{ $events->end_date }}</p>
                <p>{{ $events->location }}</p>
                <p>{{ $events->venue }}</p>
            </div>
            <div class="book-content-bottom" style="color: #FFC60B;">
                @php
                  $boothNames = [];
                  $categoryNames = [];
                  foreach($invoice->booths as $booth){
                    $boothNames[] = $booth->booth_name;
                    $categoryNames[] =  $booth->category->category_name;
                  }
                  $boothNamesString = implode(', ', $boothNames); 
                  $catNamesString = implode(', ', $categoryNames); 
                @endphp
                <b><p>{{ $boothNamesString }}</p></b>
            </div>
        </div>
        <div class=book-img>
          <img class="book-img-css" style="width: 100%; height:100%; object-fit:cover; border-radius:18px;" src="data:image/jpeg;base64,{{ $events->image_base64 }}" alt="">
        </div>
      </div>

      <div style="padding-bottom: 7rem;" class="book-cred-container">
        <div class="book-payment-sum">
            <b><h2 style="color: #FFC60B; padding-top: 3rem;padding-right: 100px;">Invoice Detail</h2></b>
            <div class="transaction-detail-container"> 
                <div class="transaction-detail-content-container">
                    <div class="transaction-detail-content-1">
                        <b><p>Payment Method</p></b>
                        <b><p>Booth Quantity</p></b>
                        <b><p>Booth Price</p></b>
                        <b><p>Platform Fee</p></b>
                    </div>
                    <div class="transaction-detail-content-2">
                        <p>:</p>
                        <p>:</p>
                        <p>:</p>
                        <p>:</p>
                    </div>
                    <div class="transaction-detail-content-3">
                        <p>{{ $invoice->payment_method }}</p>
                        <p>{{ $invoice->quantity }}</p>
                        <p>Rp {{ number_format($invoice->price , 0, ',', '.')}},00</p>
                        <p>Rp 25.000,00</p>
                    </div>
                </div>
                <hr style="position: relative; left: 2%; width: 500px;">
                <div class="transaction-detail-content-container-2">
                    <div class="transaction-detail-content-4">
                        <b><p>Total Payment</p></b>
                    </div>
                    <div class="transaction-detail-content-5">
                        <b><p>Rp {{ number_format($invoice->total_price , 0, ',', '.')}},00</p></b>
                    </div>
                </div>
            </div>
        </div>
      </div>
    @endforeach
      <a href="/home"><button style="position:relative; left: 45%;" class="ok-button">OK</button></a>
</body>
</html>