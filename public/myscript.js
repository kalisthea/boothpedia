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
    document.getElementById(
        "overlay"
    ).style.display = "block";
    document.getElementById(
        "paymentInfoPopup"
    ).style.display = "block";
}

function ratingPopup(){
    document.getElementById(
        "overlay"
    ).style.display = "block";
    document.getElementById(
        "ratePopup"
    ).style.display = "block";
}