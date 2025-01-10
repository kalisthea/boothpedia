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
            <img src="${window.imageUrl}" alt="GoPay QR Code" style="width:30%"> 
        `;
    } else if (selectedPaymentMethod === "Dana") {
        paymentSpecificInfo.innerHTML = `
            <p><b>Payment Method:</b> Dana</p>
            <p><b>Instructions:</b> Scan the QR code below:</p> 
            <img src="${window.imageUrl}" alt="Dana QR Code" style="width:30%">
        `;
    }
        document.getElementById("overlay").style.display = "block";
        document.getElementById("paymentInfoPopup").style.display = "block"; 

        document.getElementById("selectedPaymentMethod").value = selectedPaymentMethod;
}



function submitPaymentForm() {
    document.getElementById("paymentConfirmationForm").submit(); 
}


function ratingPopup(eoId, eoName, eventId){

    document.getElementById(
        "overlay"
    ).style.display = "block";
    document.getElementById(
        "ratePopup"
    ).style.display = "block";
    document.getElementById('eoName').textContent = eoName; 
    document.getElementById('eo_id').value = eoId; 
    document.getElementById('event_id').value = eventId; 

    
}

function closePopup() {
    document.getElementById("overlay").style.display = "none";
    document.getElementById("ratePopup").style.display = "none";
}

function reviewPopup(){
    document.getElementById(
        "overlay"
    ).style.display = "block";
    document.getElementById(
        "review-popup"
    ).style.display = "block";
}

function reviewClose(){
    document.getElementById(
        "overlay"
    ).style.display = "none";
    document.getElementById(
        "review-popup"
    ).style.display = "none";
}

function refundForm(){
    document.getElementById(
        "overlay"
    ).style.display = "block";
    document.getElementById(
        "refund-form"
    ).style.display = "block";
}

function refundClose(){
    document.getElementById(
        "overlay"
    ).style.display = "none";
    document.getElementById(
        "refund-form"
    ).style.display = "none";
}

function refundPopup(){
    document.getElementById(
        "overlay"
    ).style.display = "block";
    document.getElementById(
        "refund-popup"
    ).style.display = "block";
}


