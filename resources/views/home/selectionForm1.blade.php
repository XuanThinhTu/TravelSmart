    <section id="filter-section" style="position: relative; padding: 40px 0; background-color: rgba(255, 255, 255, 0.9);">
                <form class="filter-form" style="max-width: 800px; margin: auto;">
                    <h2 class="text-center mb-4">Find Your Perfect Stay</h2>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="destination" class="form-label">Destination</label>
                            <input type="text" id="destination" class="form-control" placeholder="Enter destination">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="check-in" class="form-label">Check-in</label>
                            <input type="date" id="check-in" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="check-out" class="form-label">Check-out</label>
                            <input type="date" id="check-out" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="guests" class="form-label">Guests</label>
                            <select id="guests" class="form-control">
                                <option value="">Number of guests</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3+</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="room-type" class="form-label">Room Type</label>
                            <select id="room-type" class="form-control">
                                <option value="">Room Type</option>
                                <option value="single">Single</option>
                                <option value="double">Double</option>
                                <option value="suite">Suite</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="price-range" class="form-label">Price Range</label>
                            <div class="price-range-slider" style="margin-top: 5px;">
                                <input type="range" min="0" max="500" value="250" id="price-min" class="form-range" style="width: 100%;">
                                <input type="range" min="0" max="500" value="400" id="price-max" class="form-range" style="width: 100%;">
                                <div class="d-flex justify-content-between">
                                    <span>Min: $<span id="min-value">250</span></span>
                                    <span>Max: $<span id="max-value">400</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </section>