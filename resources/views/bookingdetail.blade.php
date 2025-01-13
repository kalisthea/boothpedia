
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script type="text/javascript" src="{{ asset('myscript.js') }}"></script>
    <script type="text/javascript" src="{{ asset('script.js') }}"></script>
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
        @php
            $refund = \App\Models\Refund::where('event_id', $events->id)
                                      ->where('tenant_id', auth()->id())
                                      ->first(); 

            $refundExists = $refund !== null;

        
            foreach($invoices as $invoice){
              $invoiceid = $invoice->id;
            }

            if ($refundExists) {
                if ($refund->status === 'approved') {
                    $refundMessage = "Your refund request has been approved. Please wait 3-7 working days for your refund.";
                } elseif ($refund->status === 'denied') {
                    $refundMessage = "Your refund request has been denied.";
                } elseif ($refund->status === 'finished') {
                    $refundMessage = "Your booking has been refunded. Please check your bank account.";  
                } else {
                    $refundMessage = "A refund request has already been submitted.";
                }

                echo "<p class='refund-message' style='padding-left:2rem;'>{$refundMessage}</p>";
            }
            elseif ($invoice->finished == 'Y'){
              echo "<p class='refund-message' style='padding-left:2rem;''>You have finished this rental!</p>";
              
            }
            elseif($events->end_date < date('Y-m-d')){
              echo "<p class='refund-message' style='padding-left:2rem;'>Please note that if no action or response is received within 14 days, your booking order will be automatically finalized. </p>";
            }
        @endphp
        {{-- @if($invoice->finished == 'Y')
          <p class="refund-message" style="padding-left:2rem;">You have finished this rental!</p>
        @endif --}}
        <div class="cta-buttons">
          <button class="ok-button" onclick="refundForm()" @if($refundExists || $invoice->finished == 'Y') style="border: 1px solid #d0d0d6; background-color: #d0d0d6;" disabled @endif>Request Refund</button><br>
          <form action="{{ route('finish-rental', ['event_name' => $events->name]) }}" method="POST">
            @csrf  
            <input type="hidden" name="invoice_id" id="" value="{{ $invoiceid }}">
            <button class="ok-button" type="submit" 
            @if($invoice->finished == 'Y' || $refundExists || (isset($events) && $events->first()->end_date > date('Y-m-d'))) 
            style="border: 1px solid #d0d0d6; background-color: #d0d0d6;" disabled 
            @endif>
            Finish Rental
          </button><br>
          </form>
        </div>
      </div>
      
    @endforeach
  
    <a href="/booth"><button style="position:relative; left: 45%;" class="ok-button">OK</button></a>

    <div id="overlay" class="overlay">
      <div id="refund-form" class="refund-popup">
          <div class="center-container"> 
              <p style="font-size: 20px; color:#FFC60B">Refund Form</p>
          </div>
          <div class="scroll-container"> 
              <form action="{{ route('refund' , ['event_name' => $events->name ]) }}" method="POST">
                  @csrf
                  <label for="reason" style="padding-bottom:1rem; color:#FFC60B">Choose Reason</label><br>
                  <div style="padding-left: 1rem; padding-bottom:1rem; margin-top: -5px">
                      <input type="radio" id="star5" name="reason" value="Event did not go well" required>
                      <label for="1" style="padding-left: 1rem;">Event did not go well</label><br>
                      <input type="radio" id="star4" name="reason" value="Accidental purchase">
                      <label for="2" style="padding-left: 1rem;">Accidental purchase</label><br>
                      <input type="radio" id="star3" name="reason" value="Incorrect booking selection">
                      <label for="3" style="padding-left: 1rem;">Incorrect booking selection</label><br>
                      <input type="radio" id="star2" name="reason" value="No longer able to attend">
                      <label for="4" style="padding-left: 1rem;">No longer able to attend</label><br>
                  </div>
                  <div style="padding-bottom:2rem;" >
                      <p style="margin-bottom: -5px; color:#FFC60B">Additional Information</p>
                      <p>This will help us evaluate the situation further</p>
                      <input type="text" name="additional" id="" placeholder="Type here" style="padding-right: 100px;" required>
                      <p style="padding-top:1rem;">Attach image (If any)</p>
                      <input type="file" name="image">
                  </div>
  
                  <p style="margin-bottom: -5px; color:#FFC60B">Insert your bank information</p>
                  <p>Please insert the correct information as this is for refund purposes</p>
                  <div style="padding-bottom:2rem;">
                      <select id="mySelect" name="bank">
                          <option value="Bank BCA">Bank BCA</option>
                          <option value="Mandiri">Mandiri</option>
                          <option value="CIMB">CIMB</option>
                          <option value="Bank BSI">Bank BSI</option>
                      </select>
                      <div>
                          <label for="">Bank Account Number</label>
                          <input type="text" name="bank_number" required><br>
                          <label for="" style="padding-top:1rem;">Account Name</label>
                          <input type="text" name="account_name" required><br>
                      </div>
                  </div>
                  <input type="hidden" name="event_id" value="{{ $events->id }}">
                  <input type="hidden" name="eo_id" value="{{ $events->user->id }}">
                  @php
                      foreach($invoices as $invoice){
                          $invoiceid = $invoice->id;
                      }
                  @endphp
                  <input type="hidden" name="invoice_id" value="{{ $invoiceid }}">
              </form>
              <div class="center-container">
                <p style=" color:#FFC60B">Terms and Conditions</p>
              </div>
              <p>Refunds for upcoming events can only be done maximum 10 days before event start date.</p>
              <p>Refunds for ended events can only be done within 14 days after event end date.</p>
              <p>All refund requests will be reviewed by our team. We reserve the right to approve or deny any refund request.</p>
          </div>
         
          <div class="center-container" style="display: flex; gap:1rem; padding-top: 2rem;">
              <button type="button" onclick="refundClose()" class="ok-button">Return</button>
              <button type="submit" class="ok-button">Submit</button>
          </div>
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