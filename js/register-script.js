(function(){
    let form = document.getElementById('register-form'),
    inputs = form?.elements || [];

    form?.addEventListener('submit', e => {
        e.preventDefault();
        register();
    })

    function register() {
        const formData = new FormData();
        const xhr = new XMLHttpRequest();

        [...inputs].forEach(data => {
            const key = data.name;
            
            if(key) {
                const value  = data.value;
                formData.append(key, value);
            }
        })

        formData.append('picture', inputs['picture'].files[0]);
        formData.append('register', '');

        xhr.open('POST', 'ajax/auth_crud.php', true);
        xhr.send(formData);

        xhr.onload = function() {
            let modalEl = document.getElementById('register-modal'),
            modal = bootstrap.Modal.getInstance(modalEl);

            const isPassMismatch = this.responseText == 'pass_mismatch';
            const isMailFailed = this.responseText == 'mail_failed';
            const invImageSize = this.responseText == 'inv_size';
            const invImage = this.responseText == 'inv_img';
            const imageUploadFailed = this.responseText == 'upd_failed';
            const isPhoneExist = this.responseText == 'phone_exist';
            const isEmailExist = this.responseText == 'email_exist';

            let message = 'Registeration successful, confirmation link sent to mail';
            let hasError = true;

            if(isPassMismatch)
                message = 'Password do not match';
            else if(isMailFailed) 
                message = 'Email verification link failed to send';
            else if(invImageSize)
                message = 'Image must not be greater than 2MB';
            else if(invImage)
                message = 'Image must be a PNG/JPEG/JPG/WEBP';
            else if(imageUploadFailed)
                message = 'Image failed to upload';
            else if(isPhoneExist)
                message = 'Phone number already exist';
            else if(isEmailExist) 
                message = 'Email address already exist';
            else hasError = false;
            
            if(hasError) {
                customAlert('error', message, 'top-right-alert');
            }else if(this.responseText == 0) {
                customAlert('error', 'Register failed, server is down', 'top-right-alert');
            }else {
                customAlert('success', message, 'top-right-alert');
                form.reset();
                modal.hide();
            }

        }
    }
})();