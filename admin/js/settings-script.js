
let generalData; 

function onShutdownChange(value) {
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onload = function() {
        // if update success
        if(this.responseText == 1) {
            if(generalData.shutdown == 1) {
                customAlert('success', 'Site is now availabled.', 'bottom-alert');
            }else {
                customAlert('success', 'Site has been shutdown.', 'bottom-alert');
            }

            getGeneral();
        }else {
            customAlert('error', 'Something went wrong, please try again later..', 'bottom-alert');
        }
    }
    
    xhr.send('updateShutdown='+value);
}

function onGeneralSettingsModalSave(siteTitleValue, siteAboutValue, customAlert) {
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onload = function() {
        let generalSettingsEditModalEl = document.getElementById('general-setting-edit');
        let generalSettingsEditModal = bootstrap.Modal.getInstance(generalSettingsEditModalEl);
        
        generalSettingsEditModal.hide();

        if(this.responseText == 1) {
            customAlert('success', 'Data updated!', 'bottom-alert');
            getGeneral();
        }else {
            customAlert('error', '<strong>Error!</strong> No changes made.', 'bottom-alert');
        }
    }
    
    xhr.send('site_title='+siteTitleValue+'&site_about='+siteAboutValue+'&updateGeneral');
}

function onGeneralSettingsModalCancel(siteTitle, siteAbout) {
    siteTitle.value = generalData.site_title;
    siteAbout.value = generalData.site_about;
}

function getGeneral() {
    let siteTitle = document.getElementById('site-title-content'), 
        siteAbout = document.getElementById('site-about-content'), 
        siteTitleInput = document.getElementById('site-title-content-input'), 
        siteAboutInput = document.getElementById('site-about-content-input'), 
        shutdownToggle = document.getElementById('shutdown-switch');
        xhr = new XMLHttpRequest();

    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onload = function() {
        generalData = JSON.parse(this.responseText);

        siteTitle.innerText = generalData.site_title;
        siteAbout.innerText = generalData.site_about;

        siteTitleInput.value = generalData.site_title;
        siteAboutInput.value = generalData.site_about;

        if(generalData.shutdown == 0) {
            shutdownToggle.checked = false;
            shutdownToggle.value = 0;
        }else {
            shutdownToggle.checked = true;
            shutdownToggle.value = 1;
        }
    }
    
    xhr.send('getGeneral');
}

window.onload = function() {
    getGeneral()
}