<div class="modal fade" id="forgot-password-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" id="forgot-password-form">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center gap-2">
                        <i class="bi bi-person-circle fs-3"></i> Forgot Password
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                        Note: A link will be sent to your email to reset your password!
                    </span>
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input name="email" type="text" class="form-control shadow-none" placeholder="youremail@sample.com">
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <button type="submit" class="btn btn-dark shadow-none">SUBMIT</button>
                        <button type="button" class="btn text-secondary text-decoration-none shadow-none p-1" data-bs-toggle="modal" data-bs-target="#login-modal" data-bs-dismiss="modal">
                            Go to Login
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>