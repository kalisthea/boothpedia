function registerSuccessPopup() {
    document.getElementById(
        "overlay"
    ).style.display = "block";
    document.getElementById(
        "registerSuccessPopup"
    ).style.display = "block";
}

function registerSuccessPopupClose() {
    document.getElementById(
        "overlay"
    ).style.display = "none";
    document.getElementById(
        "registerSuccessPopup"
    ).style.display = "none";
}

function selectPaymentMethod(e) {
    // Unset selected class from other options
    const selected = document.querySelectorAll('.payment-method-container .payment-method-content-selected');
    selected.forEach(function(el) {
      el.classList.remove('payment-method-content-selected');
    });
    e.target.classList.add('payment-method-content-selected');
}

function paymentPopup(){

    var selectedPaymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
    var paymentSpecificInfo = document.getElementById("paymentSpecificInfo");

    paymentSpecificInfo.innerHTML = ""; // Clear previous content


    if (selectedPaymentMethod === "BCA Virtual Account") {
        paymentSpecificInfo.innerHTML = `
            <b><p style="color: #FFC60B">Complete Payment</p></b>
            <div class="payment-info-container">
                <b><p style="color:#2FA8E8;">Virtual Account</p></b>
                <b><p>17128111700769</p></b>
            </div>
            
        `;

    } else if (selectedPaymentMethod === "GoPay QRIS") {
        paymentSpecificInfo.innerHTML = `
            <p><b>Payment Method:</b> GoPay</p>
            <p><b>Instructions:</b> Scan the QR code below:</p> 
            <img src="{{ asset("images/gopay_qr.png") }}" alt="GoPay QR Code"> 
        `;
    } else if (selectedPaymentMethod === "Dana") {
        paymentSpecificInfo.innerHTML = `
            <p><b>Payment Method:</b> Dana</p>
            <p><b>Instructions:</b> Enter the Dana ID: 081234567890</p> 
        `;
    }
        document.getElementById("overlay").style.display = "block";
        document.getElementById("paymentInfoPopup").style.display = "block"; 

        document.getElementById("selectedPaymentMethod").value = selectedPaymentMethod;
}



function submitPaymentForm() {
    document.getElementById("paymentConfirmationForm").submit(); 
}


function ratingPopup(){
    document.getElementById(
        "overlay"
    ).style.display = "block";
    document.getElementById(
        "ratePopup"
    ).style.display = "block";
}

