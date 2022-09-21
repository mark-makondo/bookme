(function(){
    let form = document.getElementById('login-form'),
    inputs = form?.elements || [];

    form?.addEventListener('submit', e => {
        e.preventDefault();
        login();
    })

    function login() {
        const formData = new FormData();
        const xhr = new XMLHttpRequest();

        [...inputs].forEach(data => {
            const key = data.name;
            
            if(key) {
                const value  = data.value;
                formData.append(key, value);
            }
        })

        formData.append('login', '');

        xhr.open('POST', 'ajax/auth_crud.php', true);
        xhr.send(formData);

        xhr.onload = function() {
            console.info(this.responseText);
            let modalEl = document.getElementById('login-modal'),
            modal = bootstrap.Modal.getInstance(modalEl);

            let hasError = true;

            const isPassIncorrect = this.responseText == 'invalid_pass';
            const isEmailNotExist = this.responseText == 'invalid_email';
            const isEmailNotVerified = this.responseText == 'not_verified';
            const isUserNotActive = this.responseText == 'not_active';

            if(isPassIncorrect)
                message = 'Incorrect password';
            else if(isEmailNotExist) 
                message = 'Email do not exist, please register';
            else if(isEmailNotVerified) 
                message = 'Email not verified';
            else if(isUserNotActive) 
                message = 'Account no longer active, please contact support for reactivation';
            else 
                hasError = false;
            
            if(hasError) {
                customAlert('error', message, 'top-right-alert');
            }else {
                window.location = window.location.pathname;

                form.reset();
                modal.hide();
            }
        }
    }
})()