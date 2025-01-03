function showTab(tabName) {  
    document.querySelectorAll('.tab').forEach(tab => {  
        tab.classList.remove('active');  
    });  
 
    document.querySelectorAll('.tab-event').forEach(event => {  
        event.classList.remove('active');  
    });  
    
    document.getElementById(tabName).classList.add('active');  
    document.querySelector(`.tab-event[onclick="showTab('${tabName}')"]`).classList.add('active');  
} 

function submitLayout() {  
    document.getElementById('fileInput').click();  

    document.getElementById('fileInput').onchange = function() {  
        if (this.files.length > 0) {  
            document.getElementById('layoutForm').submit();  
        }  
    };  
}

function showPopupAddBooth(eventName, categoryId, categoryName) {  
    document.getElementById('selectedCategoryId').value = categoryId;

    const encodedCategoryName = encodeURIComponent(categoryName);   
    const actionUrl = `/mybooths/${encodeURIComponent(eventName)}/${encodedCategoryName}`; 
    document.getElementById('createBooth').setAttribute('action', actionUrl);

    document.getElementById('popup-addbooth').style.display = 'flex';  
}

function showPopup(popupId) {  
    document.getElementById(popupId).style.display = 'flex';  
}  

function hidePopup(popupId) {  
    document.getElementById(popupId).style.display = 'none';  
}

function displayFileName(inputId, spanId) {  
    const input = document.getElementById(inputId);  
    const fileNameSpan = document.getElementById(spanId);  

    if (input.files.length > 0) {  
        fileNameSpan.textContent = input.files[0].name;  
    } else {  
        fileNameSpan.textContent = '';  
    }  
}

function confirmDeletion(form, object) {
    return confirm(`Are you sure you want to delete this ${object}?`);
}

function showSuccessPopup(message) {  
    const successModal = document.getElementById('successModal');  
    const modalMessage = document.getElementById('modalMessage');  

    if (successModal) {  
        modalMessage.innerText = message; // Set the message in the modal  
        successModal.style.display = 'flex'; // Show the modal  
    }  

    const closeModalButton = document.getElementById('closeModal');  
    if (closeModalButton) {  
        closeModalButton.onclick = function() {  
            successModal.style.display = 'none'; // Hide the modal on button click  
        };  
    }  
}

document.addEventListener('DOMContentLoaded', function() {  
    // Check for the success message stored in the session (if applicable)  
    const sessionMessage = document.getElementById('sessionMessage');  
    if (sessionMessage) {  
        showSuccessPopup(sessionMessage.innerText); // Show the success popup with the session message  
    }  
}); 