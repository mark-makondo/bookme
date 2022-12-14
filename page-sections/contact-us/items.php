<div class="container">
    <div class="row gap-3">
        <div class="bg-white rounded shadow col-lg-6 col-md-6 mb-5 p-4 gap-3 d-flex flex-column" style="flex: 1;">
            <iframe height="320" class="w-100 rounded iframe" loading="lazy"></iframe>
            <div>
                <h5>Address</h5>
                <a href="#" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2 address"><i class="bi bi-geo-alt-fill"></i> </a>
            </div>
            <div class="d-flex flex-column gap-1">
                <h5>Call Us</h5>
                <a href="tel: +63123456789" class="d-inline-block mb-2 text-decoration-none text-dark pn1">
                    <i class="bi bi-telephone-fill"></i>
                </a>
                <a href="tel: +63123456789" class="d-inline-block text-decoration-none text-dark pn2">
                    <i class="bi bi-telephone-fill"></i>
                </a>
            </div>
            <div>
                <h5>Email</h5>
                <a href="mailto: sample@mail.com" class="d-inline-block text-decoration-none text-dark email">
                    <i class="bi bi-envelope-fill"></i>
                </a>
            </div>
            <div class="d-flex flex-column gap-2">
                <h5>Follow Us</h5>
                <div class="d-flex gap-2">
                    <a href="#" class="d-inline-block text-dark me-2 text-decoration-none fs-5 facebook">
                        <i class="bi bi-facebook"></i> 
                    </a>
                    <a href="#" class="d-inline-block text-dark me-2 text-decoration-none fs-5 twitter">
                        <i class="bi bi-twitter"></i> 
                    </a>
                    <a href="#" class="d-inline-block text-dark me-2 text-decoration-none fs-5 instagram">
                        <i class="bi bi-instagram"></i> 
                    </a>
                </div>
            </div>
        </div>
        <div class="bg-white rounded shadow col-lg-6 col-md-6 mb-5 p-4">
            <form method="POST" class="d-flex flex-column gap-2" id="contact-us-send-form">
                <h5>Send a message</h5>
                <div>
                    <label class="form-label" style="font-weight: 500;">Name</label>
                    <input name="name" type="text" class="form-control shadow-none" placeholder="Enter your full name" required>
                </div>
                <div>
                    <label class="form-label" style="font-weight: 500;">Email</label>
                    <input name="email" type="email" class="form-control shadow-none" placeholder="mail@sample.com" required>
                </div>
                <div>
                    <label class="form-label" style="font-weight: 500;">Subject</label>
                    <input name="subject" type="text" class="form-control shadow-none" placeholder="Type your email subject" required>
                </div>
                <div>
                    <label class="form-label" style="font-weight: 500;">Message</label>
                    <textarea name="message" class="form-control shadow-none" rows="5" placeholder="Type your Message" style="resize: none;" required></textarea>
                </div>
                <button type="submit" name="contact-us-send" class="btn text-white custom-bg d-inline-block">
                    SEND
                </button>
            </form>
        </div>
    </div>
</div>