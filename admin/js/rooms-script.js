    let addRoomForm = document.getElementById('add-room-modal-form'),
    editRoomForm = document.getElementById('edit-room-modal-form'),
    facilitiesTableBody = document.getElementById('rooms-table-body'),
    editRoomInputsEl = roomFormElements(editRoomForm);

    let imageRoomForm = document.getElementById('image-room-modal-form'), 
        image = imageRoomForm.elements['image'],
        thumb = imageRoomForm.elements['thumb'],
        imageTableBody = document.getElementById('image-table-body'),
        imageHeaderName = document.getElementById('image-room-name');
        
    let selectedRoomRow = '',
        selectedFacilities = [],
        selectedFeatures = [],
        selectedRoom = {};

    function resetGlobal() {
        selectedRoomRow = '',
        selectedFacilities = [],
        selectedFeatures = [],
        selectedRoom = {};
    }

    addRoomForm.addEventListener('submit', e => {
        e.preventDefault();
        addRoom();
    })

    editRoomForm.addEventListener('submit', e => {
        e.preventDefault();
        updateRoom();
    })

    //#region --------------- HELPERS

    function roomFormElements(formElement) {
        nameInput = formElement.elements['name'],
        areaInput = formElement.elements['area'],
        priceInput = formElement.elements['price'],
        quantityInput = formElement.elements['quantity'],
        adultInput = formElement.elements['adult'],
        childrenInput = formElement.elements['children'],
        descriptionInput = formElement.elements['description'],
        featuresInputs = formElement.elements['features'],
        facilitiesInputs = formElement.elements['facilities'];

        return { nameInput, areaInput, priceInput, quantityInput, adultInput, childrenInput, descriptionInput, featuresInputs, facilitiesInputs };
    }
    function transformCheckedElements(inputElements = []) {
        const temp = new Set();

        inputElements.forEach(el => {
            const isChecked = el.checked;

            if(isChecked) temp.add(el.value);
            else {
                const exist = temp.has(el.value);
                exist && temp.delete(el.value);
            }
        });

        return [...temp];
    }

    //#endregion

    //#region --------------- ROOMS

    function getRooms() {
        const xhr = new XMLHttpRequest();

        xhr.open('POST', 'ajax/rooms_crud.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('getRooms');

        xhr.onload = function() {
            facilitiesTableBody.innerHTML = this.responseText;
        }
    }
    function getRoom(id = '') {
        const { facilitiesInputs, featuresInputs } = editRoomInputsEl;
        const checkActiveInputs = (inputs = [], original = []) => original.forEach(data=> {
                const foundCheckbox = [...inputs].find(input => input.value == data);
                if(foundCheckbox) foundCheckbox.checked = true;
                else foundCheckbox.checked = false;
            }
        );
        const xhr = new XMLHttpRequest();

        xhr.open('POST', 'ajax/rooms_crud.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('sr_no='+id+'&getRoom');

        xhr.onload = function(){
            const { room, features, facilities } = JSON.parse(this.responseText);
            console.info(room.name, { features, facilities, facilitiesInputs })
            const facilitiesTemp = facilities.map(facility=> facility[0]);
            const featuresTemp = features.map(feature=> feature[0]);

            for (const key in room) {
                if (Object.hasOwnProperty.call(room, key)) {
                    const item = room[key];
                    const inputEl = editRoomForm.elements[key];

                    inputEl && (inputEl.value = item);
                }
            }
            
            checkActiveInputs(facilitiesInputs, facilitiesTemp);
            checkActiveInputs(featuresInputs, featuresTemp);

            selectedRoom = room;
            selectedFacilities = facilitiesTemp;
            selectedFeatures = featuresTemp;
            selectedRoomRow = id;
        };
    }
    function addRoom() {
        const { 
            adultInput, areaInput, childrenInput, descriptionInput, facilitiesInputs, 
            featuresInputs, nameInput, priceInput, quantityInput 
        } = roomFormElements(addRoomForm);
        
        const features = transformCheckedElements(featuresInputs);
        const facilities = transformCheckedElements(facilitiesInputs);

        const data = new FormData();
        const xhr = new XMLHttpRequest();

        data.append('name', nameInput.value);
        data.append('area', areaInput.value);
        data.append('price', priceInput.value);
        data.append('quantity', quantityInput.value);
        data.append('adult', adultInput.value);
        data.append('children', childrenInput.value);
        data.append('description', descriptionInput.value);
        data.append('features', JSON.stringify(features));
        data.append('facilities', JSON.stringify(facilities));
        data.append('addRoom', '');
        
        xhr.open('POST', 'ajax/rooms_crud.php', true);
        xhr.send(data);

        xhr.onload = function() {
            let modalEl = document.getElementById('add-room-modal-setting');
            let modal = bootstrap.Modal.getInstance(modalEl);

            modal.hide();

            if(this.responseText) {
                customAlert('success', 'Room successfuly added', 'top-right-alert');
                addRoomForm.reset();
                getRooms();
            }else {
                customAlert('error', 'Server down, please try again later', 'top-right-alert');
            }
        }
    }
    function removeRoom(id) {
        const xhr = new XMLHttpRequest();

        xhr.open('POST', 'ajax/rooms_crud.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('sr_no='+id+'&removeRoom');

        xhr.onload = function() {
            if(this.responseText) {
                if(this.responseText == 'room-image-exist') {
                    customAlert('success', 'Unable to remove, please remove all the images first', 'top-right-alert');
                }else {
                    customAlert('success', 'Row removed succesfully.', 'top-right-alert');
                    getRooms();
                }
            }else {
                customAlert('error', 'Failed to remove row. Server is down.', 'top-right-alert');
            }
        }
    }
    function onStatusClick(id) {
        const xhr = new XMLHttpRequest();

        xhr.open('POST', 'ajax/rooms_crud.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('sr_no='+id+'&changeStatus');

        xhr.onload = function() {
            if(this.responseText) {
                if(this.responseText == 'active')
                    customAlert('success', 'Room actived', 'top-right-alert');
                else
                    customAlert('success', 'Room deactivated', 'top-right-alert');
                
                getRooms();
            }else {
                customAlert('error', 'Active failed, server is down.', 'top-right-alert');
            }
        }
    }
    function updateRoom() {
        const { facilitiesInputs, featuresInputs } = editRoomInputsEl;
        const formData = new FormData();
        const xhr = new XMLHttpRequest();

        for (const key in selectedRoom) {
            if (Object.hasOwnProperty.call(selectedRoom, key)) {
                const item = editRoomForm.elements[key];
                item && formData.append(key, item.value);
                key == 'sr_no' && formData.append(key, selectedRoom[key]);
            }
        }
        
        const features = transformCheckedElements(featuresInputs);
        const facilities = transformCheckedElements(facilitiesInputs);

        formData.append('features', JSON.stringify(features));
        formData.append('facilities', JSON.stringify(facilities));
        formData.append('updateRoom', '');

        xhr.open("POST", "ajax/rooms_crud.php", true);
        xhr.send(formData);
        
        xhr.onload = function() {
            let modalEl = document.getElementById('edit-room-modal-setting');
            let modal = bootstrap.Modal.getInstance(modalEl);

            modal.hide();

            if(this.responseText) {
                customAlert('success', 'Room successfuly updated', 'top-right-alert');
                editRoomForm.reset();
                getRooms();
            }else {
                customAlert('error', 'Server down, please try again later', 'top-right-alert');
            }
            resetGlobal();
        }
    }

    //#endregion

    //#region --------------- IMAGES

    imageRoomForm.addEventListener('submit', e => {
        e.preventDefault();
        addImage();
    })

    function onImageBtnClick(id = '', roomName = '') {
        selectedRoomRow = id;
        imageHeaderName.innerText = roomName;
        getImages();
    }
    function getImages() {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/rooms_crud.php");
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("sr_no="+selectedRoomRow+"&getImages");

        xhr.onload = function() {
            imageTableBody.innerHTML = this.responseText;
        }
    }
    function addImage() {
        const xhr = new XMLHttpRequest();
        const formData = new FormData();
        
        formData.append('image', image.files[0]);
        formData.append('sr_no', selectedRoomRow);
        formData.append('addImage', '');

        xhr.open("POST", "ajax/rooms_crud.php");
        xhr.send(formData);    
        
        xhr.onload = function() {
            if(this.responseText == 'inv_img') 
                customAlert('error', '<strong>Error!</strong> Only JPG & PNG are allowed.', 'top-right-alert', 'image-alert');
            if(this.responseText == 'inv_size') 
                customAlert('error', '<strong>Error!</strong> Image should be less than 2MB.', 'top-right-alert', 'image-alert');
            if(this.responseText == 'upd_failed') 
                customAlert('error', '<strong>Error!</strong> Image upload failed.', 'top-right-alert', 'image-alert');
            else {
                customAlert('success', 'Image added!', 'top-right-alert', 'image-alert');
                image.value = '';
                getImages();
            }

        }
    }
    function removeImage(id) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/rooms_crud.php");
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("sr_no="+id+"&removeImage");

        xhr.onload = function() {
            if(this.responseText) {
                customAlert('success', 'Image removed succesfully.', 'top-right-alert', 'image-alert');
                getImages();
            }else {
                customAlert('error', 'Failed to remove image. Server is down.', 'top-right-alert', 'image-alert');
            }
        }
    }
    function onThumbClick(id, thumb) {
        const xhr = new XMLHttpRequest();

        xhr.open('POST', 'ajax/rooms_crud.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('sr_no='+id+"&room_id="+selectedRoomRow+"&thumb="+thumb+'&changeThumb');

        xhr.onload = function() {
            if(this.responseText) {
                if(this.responseText == 'set-thumb')
                    customAlert('success', 'Selected image is now a thumbnail', 'top-right-alert', 'image-alert');
                if(this.responseText == 'unset-thumb')
                    customAlert('success', 'Selected image no longer a thumbnail', 'top-right-alert', 'image-alert');
                    
                getImages();
            }else {
                customAlert('error', 'Active failed, server is down.', 'top-right-alert');
            }
        }
    }

    //#endregion

    window.onload = function() {
    getRooms();
    };