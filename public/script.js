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

function showPopupAddBooth(eventName, categoryId, categoryName) {  
    document.getElementById('selectedCategoryId').value = categoryId;  
    const encodedCategoryName = encodeURIComponent(categoryName);   
    const actionUrl = `/boothsaya/${encodeURIComponent(eventName)}/${encodedCategoryName}`; 
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

    // Ambil file yang di-upload (jika ada)  
    if (input.files.length > 0) {  
        // Tampilkan nama file  
        fileNameSpan.textContent = input.files[0].name;  
    } else {  
        // Jika tidak ada file, kosongkan  
        fileNameSpan.textContent = '';  
    }  
}