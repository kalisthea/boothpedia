<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <script type="text/javascript" src="myscript.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <title>Event Detail</title>
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

      <b><h2 style="color: #FFC60B; padding-bottom: 2rem; padding-top: 2rem;"> Booth Booking </h2></b>
      

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

      <div class="book-cred-container">
        <div class="book-detail-input"> 
            <b><h2 style="color: #FFC60B; padding-top: 3rem;">Booking Detail</h2></b>
            <div class="booking-forms">
              <label for="fullname">Fullname</label><br>
              <input class="book-input"  type="fullname" id="fullname" name="fullname"><br>
              <label for="phonenumber">Phone Number</label><br>
              <input class="book-input" type="text" id="phonenumber" name="phonenumber"><br>
              <label for="email">Email</label><br>
              <input class="book-input"  type="text" id="email" name="email"><br>
            </div>
        </div>
        <div class="book-payment-sum">
            <b><h2 style="color: #FFC60B; padding-top: 3rem; padding-bottom: 2rem; padding-right: 100px;">Payment Summary</h2></b>
            <div class="payment-sum-container"> 
              <div class="payment-sum-content-container"> 
                <div class="payment-sum-content-1">
                  <p>Booth Price</p>
                  <p>Booth Quantity</p>
                  <p>Platform Fee</p>
                </div>
                <div class="payment-sum-content-2">
                  <p>Rp x-</p>
                  <p>Rp x-</p>
                  <p>Rp x-</p>
                </div>
              </div>
              <hr>
              <div class="total-payment">
                <div class="total-payment-content-1"> 
                  <p>Total Payment</p>
                </div>
                <div class="total-payment-content-2"> 
                  <p>Rp x-</p>
                </div>
              </div>
                <button class="confirm-button" onclick="paymentPopup()" type="button">Confirm</button></a>
            </div>
        </div>
      </div>
    
      <b><h2 style="color: #FFC60B; padding-top: 3rem; padding-bottom: 2rem;">Payment Method</h2></b>

      <div class="payment-method-container"> 
        <img class="payment-method-content" onclick="selectPaymentMethod(event)" src="images/bca.png" alt="">
        <img class="payment-method-content" onclick="selectPaymentMethod(event)" src="images/mandiri.png" alt="">
        <img class="payment-method-content" onclick="selectPaymentMethod(event)" src="images/gopay.png" alt="">
        <img class="payment-method-content" onclick="selectPaymentMethod(event)" src="images/dana.png" alt="">
      </div>

      <div id="overlay" class="overlay">
        <div id="paymentInfoPopup" class="payment-info-popup">
          <b><p style="color: #FFC60B">Complete Payment</p></b>
          <div class="payment-info-container">
            <b><p>Virtual Account</p></b>
            <b><p>17128111700769</p></b>
          </div>
          <div class="payment-status-detail">
            <b><p style="font-size: 13px;">Payment Status</p></b>
            <b><p style="font-size: 13px;">Incomplete</p></b>
          </div>
          <a href="/bookingdetail"><button class="ok-button">OK</button></a>
        </div>
      </div>
      
</body>
</html>