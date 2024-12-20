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

function showPopup(popupId) {  
    document.getElementById(popupId).style.display = 'flex';  
}  

function hidePopup(popupId) {  
    document.getElementById(popupId).style.display = 'none';  
}

// document.addEventListener('DOMContentLoaded', function() {
//     document.getElementById('createCategory').addEventListener('submit', function(e) {  
//         e.preventDefault(); // Mencegah form dari refresh halaman  

//         let formData = new FormData(this); // Ambil data dari form  

//         fetch(this.action, {  
//             method: 'POST',  
//             body: formData,  
//         })  
//         .then(response => {  
//             if (!response.ok) {  
//                 return response.text() // Get the error message from the server
//                     .then(errorMessage => {
//                         throw new Error(`Network response was not ok (${response.status}): ${errorMessage}`);
//                     }); 
//             }
//             return response.json();  
//         })  
//         .then(data => {  
//             // Tampilkan pesan sukses atau error  
//             if (data.success) {  
//                 alert(data.message); // Pesan sukses  
//                 // Reset atau tutup popup jika perlu  
//             } else {  
//                 // Tangani error  
//                 alert(data.error); // Tampilkan kesalahan  
//             }  
//         })  
//         .catch(error => {  
//             console.error('Error:', error);  
//             alert('An error occurred while creating the category.');
//         });  
//     });
// });