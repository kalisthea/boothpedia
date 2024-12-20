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

function showPopupAddBooth(eventName, categoryName) {  
    document.getElementById('selectedCategoryId').value = document.getElementById('categoryDropdown').value;  
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

function loadBooths() {
    const categoryId = document.getElementById('categoryDropdown');

    fetch
}