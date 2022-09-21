(function(){
    let form = document.getElementById('forgot-password-form'),
    inputs = form?.elements || [];

    form?.addEventListener('submit', e => {
        e.preventDefault();
        forgotPassword();
    })

    function forgotPassword() {
        const formData = new FormData();
        const xhr = new XMLHttpRequest();

        formData.append('email', inputs['email'].value);
        formData.append('forgotPassword', '');

        xhr.open('POST', 'ajax/auth_crud.php', true);
        xhr.send(formData);

        xhr.onload = function() {
            let modalEl = document.getElementById('forgot-password-modal'),
            modal = bootstrap.Modal.getInstance(modalEl);

            const isReqFailed = this.responseText == 'new_pass_req_failed';
            const isNotVerified = this.responseText == 'not_verified';
            const isNotActive = this.responseText == 'not_active';

            let message = 'Password reset link has been sent to your email.';
            let hasError = true;

            if(isReqFailed)
                message = 'Something went wrong, please try again later.';
            else if(isNotVerified) 
                message = 'Email is not verified, unable to reset password.';
            else if(isNotActive)
                message = 'Email is suspended, please contact support for reactivation.';
            else hasError = false;
            
            if(hasError) {
                customAlert('error', message, 'top-right-alert');
            }else {
                customAlert('success', message, 'top-right-alert');
                form.reset();
                modal.hide();
            }

        }
    }
})();