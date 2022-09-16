<div class="col-lg-3 col-md-12 mb-lg-0 mb-4 px-lg-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
        <div class="container-fluid flex-lg-column align-items-stretch">
            <h4 class="mt-2">FILTERS</h4>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown" aria-controls="filterDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-column align-items-stretch mt-2 gap-3" id="filterDropdown">
                <div class="border bg-light p-3 rounded">
                    <h5 class="mb-3" style="font-size: 18px;">CHECK AVAILABILITY</h5>
                    <label class="form-label mb-3" style="font-weight: 500;">Check-in</label>
                    <input type="date" class="form-control shadow-none" >
                    <label class="form-label" style="font-weight: 500;">Check-out</label>
                    <input type="date" class="form-control shadow-none" >
                </div>
                <div class="border bg-light p-3 rounded">
                    <h5 class="mb-3" style="font-size: 18px;">FACILITIES</h5>
                    <div class="mb-2">
                        <input type="checkbox" class="form-check-input shadow-none me-1" id="f1">
                        <label class="form-check-label mb-3" style="font-weight: 500;" for="f1">Facility one</label>
                    </div>
                    <div class="mb-2">
                        <input type="checkbox" class="form-check-input shadow-none me-1" id="f2">
                        <label class="form-check-label mb-3" style="font-weight: 500;" for="f2">Facility two</label>
                    </div>
                    <div class="mb-2">
                        <input type="checkbox" class="form-check-input shadow-none me-1" id="f3">
                        <label class="form-check-label mb-3" style="font-weight: 500;" for="f3">Facility three</label>
                    </div>
                </div>
                <div class="border bg-light p-3 rounded">
                    <h5 class="mb-3" style="font-size: 18px;">GUESTS</h5>
                    <div class="d-flex gap-3">
                        <div class="mb-2">
                            <label class="form-label" style="font-weight: 500;">Adults</label>
                            <input type="number" class="form-control shadow-none" >
                        </div>
                        <div class="mb-2">
                            <label class="form-label" style="font-weight: 500;">Children</label>
                            <input type="number" class="form-control shadow-none" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>