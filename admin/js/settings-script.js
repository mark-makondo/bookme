let generalData,  
    contactDetailsData,
    generalSettingsForm = document.getElementById('general-settings-form'),
    contactSettingsForm = document.getElementById('contact-settings-form'),
    teamSettingsForm = document.getElementById('manage-team-settings-form');

let address = document.getElementById('address'),
    email = document.getElementById('email'),
    pn1 = document.getElementById('pn1'),
    pn2 = document.getElementById('pn2'),
    gmap = document.getElementById('gmap'),
    iframe = document.getElementById('iframe'),
    facebook = document.getElementById('facebook'),
    twitter = document.getElementById('twitter'),
    instagram = document.getElementById('instagram');

let addressInput = document.getElementById('address-input'),
    emailInput = document.getElementById('email-input'),
    pn1Input = document.getElementById('pn1-input'),
    pn2Input = document.getElementById('pn2-input'),
    gmapInput = document.getElementById('gmap-input'),
    iframeInput = document.getElementById('iframe-input'),
    facebookInput = document.getElementById('facebook-input'),
    twitterInput = document.getElementById('twitter-input'),
    instagramInput = document.getElementById('instagram-input');

let memberNameInput = document.getElementById('member-name-input'),
    memberPictureInput = document.getElementById('member-picture-input');

// ------------------------------- GENERAL SETTINGS

generalSettingsForm.addEventListener('submit', function(e){
    e.preventDefault();
    
    let siteTitleInput = document.getElementById('site-title-content-input'), 
        siteAboutInput = document.getElementById('site-about-content-input'); 

    onGeneralSettingsModalSave(siteTitleInput.value, siteAboutInput.value);
})  

const getGeneral = () => new Promise((res)=> {
    let siteTitle = document.getElementById('site-title-content'), 
        siteAbout = document.getElementById('site-about-content'), 
        siteTitleInput = document.getElementById('site-title-content-input'), 
        siteAboutInput = document.getElementById('site-about-content-input'), 
        shutdownToggle = document.getElementById('shutdown-switch');
        xhr = new XMLHttpRequest();

    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('getGeneral');

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
        res({ loaded: true });
    }
})
function onShutdownChange(value) {
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onload = function() {
        // if update success
        if(this.responseText == 1) {
            if(generalData.shutdown == 1) {
                customAlert('success', 'Site is now available.', 'bottom-alert');
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
function onGeneralSettingsModalSave(siteTitleValue, siteAboutValue) {
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

// ------------------------------- CONTACT SETTINGS

contactSettingsForm.addEventListener('submit', function(e){
    e.preventDefault();
    
    const domQueries = { 
        addressInput, emailInput, pn1Input, pn2Input, gmapInput, 
        iframeInput, facebookInput, twitterInput, instagramInput
    };

    onContactSettingsSave(domQueries);
})  
const getContact = () => new Promise((res) => {
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('getContact');

    xhr.onload = function() {
        contactDetailsData = JSON.parse(this.responseText);

        address.innerText = contactDetailsData.address;
        email.innerText = contactDetailsData.email;
        pn1.innerText = contactDetailsData.pn1;
        pn2.innerText = contactDetailsData.pn2;
        gmap.innerText = contactDetailsData.gmap;
        iframe.src = contactDetailsData.iframe;
        facebook.innerText = contactDetailsData.facebook;
        twitter.innerText = contactDetailsData.twitter;
        instagram.innerText = contactDetailsData.instagram;

        addressInput.value = contactDetailsData.address;
        emailInput.value = contactDetailsData.email;
        pn1Input.value = contactDetailsData.pn1;
        pn2Input.value = contactDetailsData.pn2;
        gmapInput.value = contactDetailsData.gmap;
        iframeInput.value = contactDetailsData.iframe;
        facebookInput.value = contactDetailsData.facebook;
        twitterInput.value = contactDetailsData.twitter;
        instagramInput.value = contactDetailsData.instagram;

        res({ loaded: true });
    }
})
function onContactSettingsModalCancel(email, pn1, pn2, gmap, iframe, facebook, twitter, instagram, address) {
    address.value = contactDetailsData.address;
    email.value = contactDetailsData.email;
    pn1.value = contactDetailsData.pn1;
    pn2.value = contactDetailsData.pn2;
    gmap.value = contactDetailsData.gmap;
    iframe.value = contactDetailsData.iframe;
    facebook.value = contactDetailsData.facebook;
    twitter.value = contactDetailsData.twitter;
    instagram.value = contactDetailsData.instagram;
}
function onContactSettingsSave(queries) {
    let xhr = new XMLHttpRequest(),
        xhrData ='address='+queries.addressInput.value+'&email='+queries.emailInput.value+'&pn1='+queries.pn1Input.value+
                '&pn2='+queries.pn2Input.value+'&gmap='+queries.gmapInput.value+'&iframe='+queries.iframeInput.value+'&facebook='+
                queries.facebookInput.value+'&twitter='+queries.twitterInput.value+'&instagram='+queries.instagramInput.value;

    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onload = function() {
        let contactSettingsEditModalEl = document.getElementById('contact-setting-edit');
        let contactSettingsEditModal = bootstrap.Modal.getInstance(contactSettingsEditModalEl);
        
        contactSettingsEditModal.hide();

        if(this.responseText == 1) {
            customAlert('success', 'Data updated!', 'bottom-alert');
            getContact();
        }else {
            customAlert('error', '<strong>Error!</strong> No changes made.', 'bottom-alert');
        }
    }
    xhr.send(xhrData+'&updateContactSettings');
}

// ------------------------------- TEAM SETTINGS

teamSettingsForm.addEventListener('submit', function(e) {
    e.preventDefault();
    addMember();
})
const getMembers = () => new Promise((res)=> {
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('getMembers');

    xhr.onload = function() {
        let teamDataElement = document.getElementById('team-data');
        teamDataElement.innerHTML = this.responseText;
        res({ loaded: true });
    }
})
function addMember() {
    let pictureData = new FormData();
    pictureData.append('name', memberNameInput.value);
    pictureData.append('picture', memberPictureInput.files[0]);
    pictureData.append('addMember', '');

    let xhr = new XMLHttpRequest();
    
    xhr.open("POST", "ajax/settings_crud.php", true);
    
    xhr.onload = function() {
        let teamSettingsAddModalEl = document.getElementById('add-team-setting');
        let teamSettingsAddModal = bootstrap.Modal.getInstance(teamSettingsAddModalEl);

        teamSettingsAddModal.hide();
        
        if(this.responseText == 'inv_img') 
            customAlert('error', '<strong>Error!</strong> Only JPG & PNG are allowed.', 'bottom-alert');
        if(this.responseText == 'inv_size') 
            customAlert('error', '<strong>Error!</strong> Image should be less than 2MB.', 'bottom-alert');
        if(this.responseText == 'upd_failed') 
            customAlert('error', '<strong>Error!</strong> Image upload failed.', 'bottom-alert');
        else {
            customAlert('success', 'Team Member added!', 'bottom-alert');
            memberNameInput.value='';
            memberPictureInput.value='';
            getMembers();
        }
    }
    
    xhr.send(pictureData);
}
function removeMember(val) {
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onload = function() {
        if(this.responseText==1) {
            customAlert('success', 'Team Member removed!', 'bottom-alert');
            getMembers();
        }else {
            customAlert('error', '<strong>Error!</strong> Server down!', 'bottom-alert');
        }
    }
    xhr.send('removeMember='+val);
}
function onAddTeamSettingsModalCancel(nameInput, pictureInput) {
    nameInput.value = '';
    pictureInput.value = '';
}

window.onload = async function() {
    await getGeneral();
    await getContact();
    await getMembers();
}