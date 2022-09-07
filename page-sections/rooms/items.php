<div class="container">
    <div class="row">
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

        <div class="col-lg-9 col-md-12 px-4">
            <div class="card mb-4 border-0 shadow">
                <div class="row g-0 p-3 align-items-center">
                    <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                        <img src="images/rooms/1.jpg" class="img-fluid rounded" alt="...">
                    </div>
                    <div class="col-md-5 px-lg-3 px-md-3 px-0 gap-2">
                        <h5>Simple Room Name</h5>
                        <div class="features mb-3">
                            <h6 class="mb-1">Features</h6>
                            <div class="d-flex gap-1 flex-wrap">
                                <span class="badge rounded-pill bg-light text-dark text-wrap">4 Bathrooms</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">4 Rooms</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">1 Balcony</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">1 Sofa</span>
                            </div>
                        </div>
                        <div class="facilities mb-3">
                            <h6 class="mb-1">Facilities</h6>
                            <div class="d-flex gap-1 flex-wrap">
                                <span class="badge rounded-pill bg-light text-dark text-wrap">AC</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">Wifi</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">TV</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">Netflix</span>
                            </div>
                        </div>
                        <div class="guests mb-4">
                            <h6 class="mb-1">Guests</h6>
                            <div class="d-flex gap-1 flex-wrap">
                                <span class="badge rounded-pill bg-light text-dark text-wrap">5 Adults</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">4 Children</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 text-center">
                        <h6 class="mb-4">200 PHP/night</h6>
                        <a href="<?=$value["link"]?>" class="btn btn-sm text-white w-100 custom-bg shadow-none mb-2">Book Now</a>
                        <a href="<?=$value["link"]?>" class="btn btn-sm btn-outline-dark w-100 shadow-none">More Details</a>
                    </div>
                </div>
            </div>
            <div class="card mb-4 border-0 shadow">
                <div class="row g-0 p-3 align-items-center">
                    <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                        <img src="images/rooms/1.jpg" class="img-fluid rounded" alt="...">
                    </div>
                    <div class="col-md-5 px-lg-3 px-md-3 px-0 gap-2">
                        <h5>Simple Room Name</h5>
                        <div class="features mb-3">
                            <h6 class="mb-1">Features</h6>
                            <div class="d-flex gap-1 flex-wrap">
                                <span class="badge rounded-pill bg-light text-dark text-wrap">4 Bathrooms</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">4 Rooms</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">1 Balcony</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">1 Sofa</span>
                            </div>
                        </div>
                        <div class="facilities mb-3">
                            <h6 class="mb-1">Facilities</h6>
                            <div class="d-flex gap-1 flex-wrap">
                                <span class="badge rounded-pill bg-light text-dark text-wrap">AC</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">Wifi</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">TV</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">Netflix</span>
                            </div>
                        </div>
                        <div class="guests mb-4">
                            <h6 class="mb-1">Guests</h6>
                            <div class="d-flex gap-1 flex-wrap">
                                <span class="badge rounded-pill bg-light text-dark text-wrap">5 Adults</span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">4 Children</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 text-center">
                        <h6 class="mb-4">200 PHP/night</h6>
                        <a href="<?=$value["link"]?>" class="btn btn-sm text-white w-100 custom-bg shadow-none mb-2">Book Now</a>
                        <a href="<?=$value["link"]?>" class="btn btn-sm btn-outline-dark w-100 shadow-none">More Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>