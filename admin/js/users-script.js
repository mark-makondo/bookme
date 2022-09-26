let usersTableBody = document.getElementById('users-table-body');

function getUsers() {
    const xhr = new XMLHttpRequest();

    xhr.open('POST', 'ajax/users_crud.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('getUsers');

    xhr.onload = function() {
        usersTableBody.innerHTML = this.responseText;
    }
}
function onUserRemove(id) {
    const xhr = new XMLHttpRequest();

    xhr.open('POST', 'ajax/users_crud.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('sr_no='+id+'&removeUser');

    xhr.onload = function() {
        if(this.responseText) {
            if(this.responseText == 'picture_not_deleted')
                customAlert('error', 'Failed to remove row, unable to remove picture', 'top-right-alert');
            else {
                customAlert('success', 'Row removed succesfully.', 'top-right-alert');
                getUsers();
            }
        }else {
            customAlert('error', 'Failed to remove row. Server is down.', 'top-right-alert');
        }
    }
}
function onStatusToggle(id, value) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'ajax/users_crud.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('sr_no='+id+'&status='+value+'&toggleStatus');

    xhr.onload = function() {
        console.log(this.responseText, { id, value });

        if(this.responseText) {
            customAlert('success', 'User status updated.', 'top-right-alert');
            getUsers();
        }else {
            customAlert('error', 'Failed to remove row. Server is down.', 'top-right-alert');
        }
    }
}
function onUserSearch(value) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'ajax/users_crud.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send("name="+value+"&searchUser");
    
    xhr.onload = function() {
        usersTableBody.innerHTML = this.responseText;
    }
}

window.onload = function() {
    getUsers();
};