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
            <a href=""><img style="width:35px; height:auto;" src="images/user.png" alt=""></a>
          </div>
        </nav>
      </header>

      <hr style="border: 2px solid #2FA8E8; color:#2FA8E8;">
      <hr style="border: 2px solid #FFC60B; color: #FFC60B;">

      <b><h2 style="color: #FFC60B; padding-bottom: 2rem; padding-top: 2rem;"> Successfully Booked Booth! </h2></b>
      

      <div class="booking-info-container">
        <div class=book-content>
            <b><p style="color: #2FA8E8; font-size: 30px; margin:-1px;">Stoodi Fest</p></b>
            <p style="">Educational</p>
            <div class="book-content-mid">
                <p>10-10-2024 - 12-10-2024</p>
                <p>Tangerang Selatan</p>
                <p>Nina Busantara University</p>
            </div>
            <div class="book-content-bottom" style="color: #FFC60B;">
                <b><p style="margin:-1px;">Kategori A</p></b>
                <b><p>Booth A11</p></b>
            </div>
        </div>
        <div class=book-img>
            <img class="book-img-css" src="images/booking-img.png" alt="">
        </div>
      </div>

      <div style="padding-bottom: 7rem;" class="book-cred-container">
        <div class="book-detail-input"> 
            <b><h2 style="color: #FFC60B; padding-top: 3rem;">Booking Detail</h2></b>
            <div class="booking-detail-container">
              <div class="book-detail-content-1">
                <b><p>Invoice</p></b>
                <b><p>Transaction Date</p></b>
                <b><p>Name</p></b>
                <b><p>Phone Number</p></b>
                <b><p>Email</p></b>
              </div>
              <div class="book-detail-content-2">
                <p>:</p>
                <p>:</p>
                <p>:</p>
                <p>:</p>
                <p>:</p>
              </div>
              <div class="book-detail-content-3">
                <p>INV/100923/002</p>
                <p>10-09-2023</p>
                <p>John Doe</p>
                <p>081234567890</p>
                <p>johndoe@iniemail.com</p>
              </div>
            </div>
        </div>
        <div class="book-payment-sum">
            <b><h2 style="color: #FFC60B; padding-top: 3rem;padding-right: 100px;">Transaction Detail</h2></b>
            <div class="transaction-detail-container"> 
                <div class="transaction-detail-content-container">
                    <div class="transaction-detail-content-1">
                        <b><p>Payment Method</p></b>
                        <b><p>Booth Price</p></b>
                        <b><p>Booth Quantity</p></b>
                        <b><p>Platform Fee</p></b>
                    </div>
                    <div class="transaction-detail-content-2">
                        <p>:</p>
                        <p>:</p>
                        <p>:</p>
                        <p>:</p>
                    </div>
                    <div class="transaction-detail-content-3">
                        <p>Virtual Account BCA</p>
                        <p>Rp x-</p>
                        <p>1</p>
                        <p>Rp x-</p>
                    </div>
                </div>
                <hr style="position: relative; left: 7%; width: 500px;">
                <div class="transaction-detail-content-container-2">
                    <div class="transaction-detail-content-4">
                        <b><p>Total Payment</p></b>
                    </div>
                    <div class="transaction-detail-content-5">
                        <b><p>Rp x-</p></b>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <a href="/home"><button style="position:relative; left: 45%;" class="ok-button">OK</button></a>
</body>
</html>