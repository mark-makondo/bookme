<div class="modal fade" id="register-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form method="POST" id="register-form">
          <div class="modal-header">
            <h5 class="modal-title d-flex align-items-center gap-2">
              <i class="bi bi-person-lines-fill fs-3"></i> User Registration
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
              Note: Your detauls must match with your ID (Password, QID, etc..) that will be required during check-in.
            </span>

            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Name</label>
                  <input name="name" type="text" class="form-control shadow-none" placeholder="Enter your full name" required>
                </div>
                <div class="col-md-6 ps-0">
                  <label class="form-label">Email address</label>
                  <input name="email" type="email" class="form-control shadow-none" placeholder="youremail@sample.com" required>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Phone Number</label>
                  <input name="phonenumber" type="number" class="form-control shadow-none" placeholder="+6305038972730" required>
                </div>
                <div class="col-md-6 ps-0">
                  <label class="form-label">Picture</label>
                  <input name="picture" type="file" accept=".jpg, .jpeg, .png, .webp" class="form-control shadow-none">
                </div>
                <div class="col-md-12 ps-0 mb-3">
                  <label class="form-label">Address</label>
                  <textarea name="address" class="form-control shadow-none" rows="1" placeholder="Enter your complete address" required></textarea>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Pincode</label>
                  <input name="pincode" type="number" class="form-control shadow-none" placeholder="00000" required>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Date of birth</label>
                  <input name="birthday" type="date" class="form-control shadow-none" >
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Password</label>
                  <input name="password" type="password" class="form-control shadow-none" placeholder="Enter a secure password." required>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Confirm Password</label>
                  <input name="cpassword" type="password" class="form-control shadow-none" placeholder="Confirm your password." required>
                </div>
              </div>
            </div>
            <div class="text-center my-1">
              <button type="submit" class="btn btn-dark shadow-none">REGISTER</button>
            </div>
          </div>
      </form>
    </div>
  </div>
</div>