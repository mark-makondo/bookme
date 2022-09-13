let facilityForm = document.getElementById('facilities-modal-setting-form'),
    facilityNameInput = facilityForm.elements['facility-name'],
    facilityIconInput = facilityForm.elements['facility-icon'],
    facilityDescriptionInput = facilityForm.elements['facility-description'],
    facilityTableBody = document.getElementById('facility-table-body');

if(facilityForm) {
    facilityForm.addEventListener('submit', e => {
        e.preventDefault();
        addFacility();
    })
}

function getFacilities() {
    const xhr = new XMLHttpRequest();

    xhr.open('POST', 'ajax/facilities_crud.php', true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    xhr.send('getFacilities');
    
    xhr.onload = function() {
        facilityTableBody.innerHTML = this.responseText;
    }
}
function addFacility() {
    const data = new FormData();

    data.append('name', facilityNameInput.value);
    data.append('description', facilityDescriptionInput.value);
    data.append('icon', facilityIconInput.files[0]);
    data.append('addFacility', '');

    const xhr = new XMLHttpRequest();
    xhr.open("POST", 'ajax/facilities_crud.php', true);
    xhr.send(data);

    xhr.onload = function(){
        let modalEl = document.getElementById('facilities-modal-setting');
        let modal = bootstrap.Modal.getInstance(modalEl);

        modal.hide();

        if(this.responseText == 'inv_img') 
            customAlert('error', '<strong>Error!</strong> Only SVG are allowed.', 'bottom-alert');
        if(this.responseText == 'inv_size') 
            customAlert('error', '<strong>Error!</strong> Image should be less than 2MB.', 'bottom-alert');
        if(this.responseText == 'upd_failed') 
            customAlert('error', '<strong>Error!</strong> Image upload failed.', 'bottom-alert');
        else {
            customAlert('success', 'Facility added!', 'bottom-alert');
            facilityForm.reset();
            getFacilities();
        }
    }
}
function removeFacility(id) {
    const xhr = new XMLHttpRequest();

    xhr.open('POST', 'ajax/facilities_crud.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('sr_no='+id+'&removeFacility');
    
    xhr.onload = function() {
        if(this.responseText) {
            if(this.responseText == 'err-in-use') 
                customAlert('error', 'Unable to remove, facility is currently being used.', 'bottom-alert');
            else {
                customAlert('success', 'Row removed succesfully.', 'bottom-alert');
                getFacilities();
            }
        }else {
            customAlert('error', 'Failed to remove row. Server is down.', 'bottom-alert');
        }
    }
}

window.onload = function() {
    getFacilities();
}