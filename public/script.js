const mobileMenu = document.getElementById('mobile-menu');
const navLinks = document.querySelector('.nav-links');

mobileMenu.addEventListener('click', () => {
    navLinks.classList.toggle('active');
});

// Get all tab headers and tab contents  
const tabHeaders = document.querySelectorAll('.tab-events-header');  
const tabs = document.querySelectorAll('.tab-event');  

tabHeaders.forEach(header => {  
    header.addEventListener('click', () => {  
        // Remove active class from all headers and tabs  
        tabHeaders.forEach(h => h.classList.remove('active'));  
        tabs.forEach(t => t.classList.remove('active'));  

        // Add active class to the clicked header and corresponding tab  
        header.classList.add('active');  
        const activeTab = header.getAttribute('data-tab');  
            document.getElementById(activeTab).classList.add('active');  
    });  
}); 