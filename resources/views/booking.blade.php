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
    <title>Booking {{ $event->name }}</title>
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
            <a href=""><img style="width:35px; height:auto;" src="{{ asset('images/mail.png') }}" alt=""></a>
            <a href=""><img style="width:35px; height:auto;" src="{{ asset('images/user.png') }}" alt=""></a>
          </div>
        </nav>
    </header>
    <hr style="border: 2px solid #2FA8E8; color:#2FA8E8;">
    <hr style="border: 2px solid #FFC60B; color: #FFC60B;">

    <b><h2 style="color: #FFC60B; padding-bottom: 2rem; padding-top: 2rem;"> Booth Booking </h2></b>
      
      <div class="booking-info-container">
        <div class=book-content>
            <b><p style="color: #2FA8E8; font-size: 30px; margin-bottom: -1px;">{{ $event->name }}</p></b>
            <p style="">{{ $event->category}}</p>
            <div class="book-content-mid">
                <p>{{ $event->start_date }} - {{ $event->end_date }}</p>
                <p>{{ $event->location }}</p>
                <p>{{ $event->venue }}</p>
            </div>
            <div class="book-content-bottom" style="color: #FFC60B;">
              @if (isset($selectedBooth) && $selectedBooth->count() > 0)
                @php
                  $boothNames = [];
                  foreach ($selectedBooth as $booth) {
                      $boothNames[] = $booth->booth_name;
                  }
                  $boothNamesString = implode(', ', $boothNames); 
                @endphp
                <b><p>Booths: {{ $boothNamesString }}</p></b>
              @endif
            </div>
        </div>
        <div class=book-img>
            <img class="book-img-css" style="width: 100%; height:100%; object-fit:cover; border-radius:18px;" src="data:image/jpeg;base64,{{ $event->image_base64 }}" alt="">
        </div>
      </div>
   
      <div class="book-cred-container">
          <div class="book-payment-sum">
              <b><h2 style="color: #FFC60B; padding-top: 3rem; padding-bottom: 2rem; padding-right: 100px;">Payment Summary</h2></b>
              <div class="payment-sum-container"> 
                <div class="payment-sum-content-container"> 
                  <div class="payment-sum-content-1">
                    <p>Booth Price</p>
                    <p>Booth Quantity</p>
                    <p>Platform Fee</p>
                  </div>
                    @if (isset($selectedBooth) && $selectedBooth->count() > 0)
                    
                      <?php 
                        $qty = $selectedBooth->count(); 
                        $total = 0; 
                      ?>
                      @foreach($selectedBooth as $booth)
                  
                        <?php $total += $booth->booth_price; ?>
                      @endforeach
                      
                      <div class="payment-sum-content-2">
                        <p>Rp {{ number_format($total, 0, ',', '.') }},00</p>
                        <p>{{ $qty }}</p>
                        <p>Rp 25.000,00</p>
                      </div>
                    </div>
                    <hr>
                    <div class="total-payment">
                      <div class="total-payment-content-1"> 
                        <p>Total Payment</p>
                      </div>
                      <div class="total-payment-content-2"> 

                        <p>Rp {{ number_format($total + 25000 , 0, ',', '.')}},00</p>
                      </div>
                    </div>
                    <a href="{{ url('event-detail-booth/' . $event->name) }}"><button class="confirm-button" type="button">Cancel</button></a>
                    @endif
              </div>
          </div>
        </div>
      
        <b><h2 style="color: #FFC60B; padding-top: 3rem; padding-bottom: 2rem;">Payment Method</h2></b>
      
            
        <div class="payment-method-container"> 
          <input type="radio" id="bca" name="payment_method" value="BCA Virtual Account" checked>
          <img class="payment-method-content"  src={{ asset("images/bca.png") }} alt="">
          {{-- <img class="payment-method-content" onclick="selectPaymentMethod(event)" src={{ asset("images/mandiri.png") }} alt=""> --}}
          <input type="radio" id="gopay" name="payment_method" value="GoPay QRIS">
          <img class="payment-method-content"  src={{ asset("images/gopay.png") }} alt="">
          <input type="radio" id="dana" name="payment_method" value="Dana">
          <img class="payment-method-content"  src={{ asset("images/dana.png") }} alt="">
        </div>
  
        <button class="confirm-button" onclick="paymentPopup()">Confirm</button></a>
      
        <div id="overlay" class="overlay" style="display: none;"> 
          <div id="paymentInfoPopup" class="payment-info-popup"> 
              <div id="paymentSpecificInfo"></div> 
              <form id="paymentConfirmationForm" method="POST" action="{{ route('booked.data', $event->name) }}">
                @csrf
                @foreach ($selectedBooth as $booth)
                  <input type="hidden" name="booth_id[]" value="{{ $booth->id }}">
                  <input type="hidden" name="booth_price[]" value="{{ $booth->booth_price }}">
                @endforeach  
                <input type="hidden" name="payment_method" id="selectedPaymentMethod"> 
                <input type="hidden" name="payment_confirmed" value="true"> 
                <button type="button" class="ok-button" onclick="submitPaymentForm()">OK</button>
            </form>
          </div>
        </div>
    
</body>
</html>