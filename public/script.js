const mobileMenu = document.getElementById('mobile-menu');
const navLinks = document.querySelector('.nav-links');

mobileMenu.addEventListener('click', () => {
    navLinks.classList.toggle('active');
});

function showTab(tabName) {  
    // Hide all tabs  
    document.querySelectorAll('.tab').forEach(tab => {  
        tab.classList.remove('active');  
    });  
    // Remove active class from all tab events  
    document.querySelectorAll('.tab-event').forEach(event => {  
        event.classList.remove('active');  
    });  
    // Show the clicked tab and set it as active  
    document.getElementById(tabName).classList.add('active');  
    document.querySelector(`.tab-event[onclick="showTab('${tabName}')"]`).classList.add('active');  
}  

function showPopup() {  
    document.getElementById('popupBox').style.display = 'flex';  
}  

function hidePopup() {  
    document.getElementById('popupBox').style.display = 'none';  
}