let generalData,  
    contactDetailsData;

// GENERAL
let siteTitle = document.getElementsByClassName('site-title'),
    siteAbout = document.getElementsByClassName('site-about'),
    facebook = document.getElementsByClassName('facebook'),
    twitter = document.getElementsByClassName('twitter'),
    instagram = document.getElementsByClassName('instagram'),
    pn1 = document.getElementsByClassName('pn1'),
    pn2 = document.getElementsByClassName('pn2'),
    address = document.getElementsByClassName('address'),
    email = document.getElementsByClassName('email'),
    gmap = document.getElementsByClassName('gmap'),
    iframe = document.getElementsByClassName('iframe');

let aboutSwiperEl = document.querySelector('.management-swiper-container');

function queryAll(elements = [], callback = ()=> {}) {
    for (i=0; i < elements.length; i++) { 
        const el = elements[i];
        el && callback(el);
    }
}

const getGeneral = () => new Promise((res)=> {
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "admin/ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('getGeneral');

    xhr.onload = function() {
        generalData = JSON.parse(this.responseText);
        
        queryAll(siteTitle, el => el.innerText = generalData.site_title);
        queryAll(siteAbout, el => el.innerText = generalData.site_about);

        res({ loaded: true });
    }
})

const getContact = () => new Promise((res) => {
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "admin/ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('getContact');

    xhr.onload = function() {
        contactDetailsData = JSON.parse(this.responseText);
        
        queryAll(address, el => el.innerText = contactDetailsData.address);
        queryAll(email, el => el.innerText = contactDetailsData.email);
        queryAll(pn1, el => el.innerText = contactDetailsData.pn1);
        queryAll(pn2, el => el.innerText = contactDetailsData.pn2);
        queryAll(iframe, el => el.src = contactDetailsData.iframe);

        queryAll(facebook, el => el.href = contactDetailsData.facebook);
        queryAll(twitter, el => el.href = contactDetailsData.twitter);
        queryAll(instagram, el => el.href = contactDetailsData.instagram);

        res({ loaded: true });
    }
})

window.onload = async function() {
    await getGeneral();
    await getContact();

    const getFileNameFromURL = (str) => str.split('/').pop().split('.')[0];

    let navbar = document.getElementById('main-navbar'),
        atags = navbar.getElementsByTagName('a');

    for (let i = 0; i < atags.length; i++) {
        const element = atags[i];
        const hasEqualHref = getFileNameFromURL(element.href) == getFileNameFromURL(document.location.href); 

        if(hasEqualHref) element.classList.add('active');
        else element.classList.remove('active');
    }
}