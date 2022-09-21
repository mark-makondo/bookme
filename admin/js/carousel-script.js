(function(){
    let carouselModalForm = document.getElementById('carousel-modal-form'),
    carouselPictureInput = document.getElementById('carousel-picture-input');

    // ------------------------------- TEAM SETTINGS

    carouselModalForm.addEventListener('submit', function(e) {
        e.preventDefault();
        addImage();
    })
    const getImages = () => new Promise((res)=> {
        let xhr = new XMLHttpRequest();

        xhr.open("POST", "ajax/carousel_crud.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('getImages');

        xhr.onload = function() {
            let element = document.getElementById('carousel-data');
            element.innerHTML = this.responseText;
            res({ loaded: true });
        }
    })
    function addImage() {
        let pictureData = new FormData();
        pictureData.append('image', carouselPictureInput.files[0]);
        pictureData.append('addImage', '');

        let xhr = new XMLHttpRequest();
        
        xhr.open("POST", "ajax/carousel_crud.php", true);
        
        xhr.onload = function() {
            let carouselAddModalEl = document.getElementById('carousel-modal');
            let carouselAddModal = bootstrap.Modal.getInstance(carouselAddModalEl);

            carouselAddModal.hide();
            
            if(this.responseText == 'inv_img') 
                customAlert('error', '<strong>Error!</strong> Only JPG & PNG are allowed.', 'top-right-alert');
            if(this.responseText == 'inv_size') 
                customAlert('error', '<strong>Error!</strong> Image should be less than 2MB.', 'top-right-alert');
            if(this.responseText == 'upd_failed') 
                customAlert('error', '<strong>Error!</strong> Image upload failed.', 'top-right-alert');
            else {
                customAlert('success', 'Image added!', 'top-right-alert');
                carouselPictureInput.value='';
                getImages();
            }
        }
        xhr.send(pictureData);
    }
    function removeImage(val) {
        let xhr = new XMLHttpRequest();

        xhr.open("POST", "ajax/carousel_crud.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        xhr.onload = function() {
            if(this.responseText==1) {
                customAlert('success', 'Image removed!', 'top-right-alert');
                getImages();
            }else {
                customAlert('error', '<strong>Error!</strong> Server down!', 'top-right-alert');
            }
        }
        xhr.send('removeImage='+val);
    }
    function onAddImageModalCancel(pictureInput) {
        pictureInput.value = '';
    }

    window.onload = async function() {
        await getImages();
    }
})()