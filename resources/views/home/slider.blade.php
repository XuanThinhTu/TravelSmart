<div class="ftco-section img" style="background-image: url(images/land.jpg);">
    <div class="overlay"></div>
    <div class="container">
        <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
            <div class="col-md-12 text-center">
                <h2 class="mb-4">Find Your Perfect Stay</h2>
                <select id="option-selector" class="form-control mb-4" onchange="toggleForms()">
                    <option value="1">Accommodation</option>
                    <option value="2">Hotel + Transportation</option>
                </select>
            </div>
        </div>

        <!-- Keep Khoa's section -->
        <section id="filter-section" style="position: relative; padding: 40px 0; background-color: rgba(255, 255, 255, 0.9);">
            <form class="filter-form" style="max-width: 800px; margin: auto;" method="GET" action="{{ route('search.product') }}">
                <h2 class="text-center mb-4">Find Your Perfect Stay</h2>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="destination" class="form-label">Destination</label>
                        <input type="text" id="destination" name="destination" class="form-control" placeholder="Enter destination">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="check-in" class="form-label">Check-in</label>
                        <input type="date" id="check-in" name="check_in" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="check-out" class="form-label">Check-out</label>
                        <input type="date" id="check-out" name="check_out" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="guests" class="form-label">Guests</label>
                        <select id="guests" name="guests" class="form-control">
                            <option value="">Number of guests</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3+</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="room-type" class="form-label">Room Type</label>
                        <select id="room-type" name="room_type" class="form-control">
                            <option value="">Room Type</option>
                            <option value="single">Single</option>
                            <option value="double">Double</option>
                            <option value="suite">Suite</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="price-range" class="form-label">Price Range</label>
                        <div class="price-range-slider" style="margin-top: 5px;">
                            <input type="range" min="0" max="500" value="250" id="price-min" name="price_min" class="form-range" style="width: 100%;">
                            <input type="range" min="0" max="500" value="400" id="price-max" name="price_max" class="form-range" style="width: 100%;">
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

        <!-- Original forms toggle -->
        <div id="selection-form-1" class="filter-form" style="display: block;">
            @include('home.selectionForm1')
        </div>

        <div id="selection-form-2" class="filter-form" style="display: none;">
            @include('home.selectionForm2')
        </div>

        <style>
            #filter-section {
                position: relative;
            }

            .filter-form {
                position: relative;
                z-index: 1;
                background-color: rgba(255, 255, 255, 0.8);
                padding: 10px;
                border-radius: 6px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .filter-form h2 {
                font-size: 1.5em;
                margin-bottom: 10px;
            }

            .form-control {
                font-size: 0.9em;
            }

            .price-range-slider {
                display: flex;
                flex-direction: column;
                gap: 5px;
            }

            .image-slider {
                margin-top: 10px;
            }

            .image-item {
                width: 100%;
                height: 150px;
                background-size: cover;
                background-position: center;
            }
        </style>

        <script>
            function toggleForms() {
                const selectedValue = document.getElementById('option-selector').value;
                const form1 = document.getElementById('selection-form-1');
                const form2 = document.getElementById('selection-form-2');

                if (selectedValue === '1') {
                    form1.style.display = 'block';
                    form2.style.display = 'none';
                } else {
                    form1.style.display = 'none';
                    form2.style.display = 'block';
                }
            }

            const minSlider = document.getElementById('price-min');
            const maxSlider = document.getElementById('price-max');
            const minValue = document.getElementById('min-value');
            const maxValue = document.getElementById('max-value');

            minSlider.oninput = function() {
                minValue.innerText = this.value;
                if (parseInt(minSlider.value) > parseInt(maxSlider.value)) {
                    maxSlider.value = minSlider.value;
                }
            }

            maxSlider.oninput = function() {
                maxValue.innerText = this.value;
                if (parseInt(maxSlider.value) < parseInt(minSlider.value)) {
                    minSlider.value = maxSlider.value;
                }
            }
        </script>
    </div>
</div>
