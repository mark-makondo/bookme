let featureForm = document.getElementById('feature-modal-setting-form'),
    featureNameInput = featureForm.elements['feature-name'],
    featureTableBody = document.getElementById('feature-table-body');

    if(featureForm) {
    featureForm.addEventListener('submit', e => {
        e.preventDefault();
        addFeature();    
    })
}

function getFeatures() {
    const xhr = new XMLHttpRequest();

    xhr.open('POST', 'ajax/features_crud.php', true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    xhr.send('getFeatures');
    
    xhr.onload = function() {
        featureTableBody.innerHTML = this.responseText;
    }
}
function addFeature() {
    const xhr = new XMLHttpRequest();

    xhr.open("POST", 'ajax/features_crud.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('name='+featureNameInput.value+'&addFeature');

    xhr.onload = function(){
        let modalEl = document.getElementById('feature-modal-setting');
        let modal = bootstrap.Modal.getInstance(modalEl);

        modal.hide();

        if(this.responseText == 1) {
            customAlert('success', 'Feature added!', 'bottom-alert');
            featureForm.reset();
            getFeatures();
        }else {
            customAlert('error', 'Server down! please try again later.', 'bottom-alert');
        }
    }
}
function removeFeature(id) {
    const xhr = new XMLHttpRequest();

    xhr.open('POST', 'ajax/features_crud.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('sr_no='+id+'&removeFeature');
    
    xhr.onload = function() {
        if(this.responseText) {
            customAlert('success', 'Row removed succesfully.', 'bottom-alert');
            getFeatures();
        }else {
            customAlert('error', 'Failed to remove row. Server is down.', 'bottom-alert');
        }
    }
}

window.onload = function() {
    getFeatures();
}