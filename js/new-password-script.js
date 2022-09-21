(function(){
    let form = document.getElementById('change-password-form'),
    inputs = form?.elements || [];

    form?.addEventListener('submit', e => {
        e.preventDefault();
        changePassword();

    })

    function changePassword() {
        const params = window.location.search.split('&');
        params.shift();

        const email = params[0].split('=')[1];
        const token = params[1].split('=')[1];

        const formData = new FormData();
        const xhr = new XMLHttpRequest();

        formData.append('newPassword', inputs['newPassword'].value);
        formData.append('confirmPassword', inputs['confirmPassword'].value);
        formData.append('email', email);
        formData.append('token', token);
        formData.append('changePassword', '');

        xhr.open('POST', 'ajax/auth_crud.php', true);
        xhr.send(formData);

        xhr.onload = function() {
            const isReqFailed = this.responseText == 'new_pass_req_failed';
            const invalidConfirmPass = this.responseText == 'incorrect_confirm_pass';
            const oldPass = this.responseText == 'old_pass';

            let message = 'Password successfully changed.';
            let hasError = true;

            if(isReqFailed)
                message = 'Something went wrong, please try again later';
            else if(invalidConfirmPass)
                message = 'New and confirm password must be the same';
            else if(oldPass) 
                message = 'Cannot use old password';
            else hasError = false;
            
            if(hasError) {
                customAlert('error', message, 'top-right-alert');
            }else {
                alert(message);
                location.href = 'index.php';
            }
        }
    }
})();