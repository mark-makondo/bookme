<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form method="post">
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
                  <input type="text" class="form-control shadow-none" placeholder="Enter your full name">
                </div>
                <div class="col-md-6 ps-0">
                  <label class="form-label">Email address</label>
                  <input type="email" class="form-control shadow-none" placeholder="youremail@sample.com">
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Phone Number</label>
                  <input type="number" class="form-control shadow-none" placeholder="+6305038972730">
                </div>
                <div class="col-md-6 ps-0">
                  <label class="form-label">Picture</label>
                  <input type="file" class="form-control shadow-none" >
                </div>
                <div class="col-md-12 ps-0 mb-3">
                  <label class="form-label">Address</label>
                  <textarea class="form-control shadow-none" rows="1" placeholder="Enter your complete address"></textarea>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Pincode</label>
                  <input type="number" class="form-control shadow-none" placeholder="00000">
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Date of birth</label>
                  <input type="date" class="form-control shadow-none" >
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Password</label>
                  <input type="password" class="form-control shadow-none" placeholder="Enter a secure password.">
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Confirm Password</label>
                  <input type="password" class="form-control shadow-none" placeholder="Confirm your password.">
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