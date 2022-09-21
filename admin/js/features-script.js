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
                customAlert('success', 'Feature added!', 'top-right-alert');
                featureForm.reset();
                getFeatures();
            }else {
                customAlert('error', 'Server down! please try again later.', 'top-right-alert');
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
                if(this.responseText == 'err-in-use') 
                    customAlert('error', 'Unable to remove, feature is currently being used.', 'top-right-alert');
                else {
                    customAlert('success', 'Row removed succesfully.', 'top-right-alert');
                    getFeatures();
                }
            }else {
                customAlert('error', 'Failed to remove row. Server is down.', 'top-right-alert');
            }
        }
    }

    window.onload = function() {
        getFeatures();
    }