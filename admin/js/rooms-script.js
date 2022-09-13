let addRoomForm = document.getElementById('add-room-modal-form'),
    editRoomForm = document.getElementById('edit-room-modal-form'),
    facilitiesTableBody = document.getElementById('rooms-table-body'),
    editRoomInputsEl = roomFormElements(editRoomForm);

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
            customAlert('success', 'Room successfuly added', 'bottom-alert');
            addRoomForm.reset();
            getRooms();
        }else {
            customAlert('error', 'Server down, please try again later', 'bottom-alert');
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
            customAlert('success', 'Row removed succesfully.', 'bottom-alert');
            getRooms();
        }else {
            customAlert('error', 'Failed to remove row. Server is down.', 'bottom-alert');
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
                customAlert('success', 'Room actived', 'bottom-alert');
            else
                customAlert('success', 'Room deactivated', 'bottom-alert');
            
            getRooms();
        }else {
            customAlert('error', 'Active failed, server is down.', 'bottom-alert');
        }
    }
}

async function updateRoom() {
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
            customAlert('success', 'Room successfuly updated', 'bottom-alert');
            editRoomForm.reset();
            getRooms();
        }else {
            customAlert('error', 'Server down, please try again later', 'bottom-alert');
        }
    }
}

window.onload = function() {
   getRooms();
};