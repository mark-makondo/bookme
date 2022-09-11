(function autoCorrectNavLink() {
    const getFileNameFromURL = (str) => str.split('/').pop().split('.')[0];

    let navbar = document.getElementById('admin-panel-navbar'),
        atags = navbar.getElementsByTagName('a');

    for (let i = 0; i < atags.length; i++) {
        const element = atags[i];
        const hasEqualHref = getFileNameFromURL(element.href) == getFileNameFromURL(document.location.href); 

        if(hasEqualHref) element.classList.add('active');
        else element.classList.remove('active');
    }
})();