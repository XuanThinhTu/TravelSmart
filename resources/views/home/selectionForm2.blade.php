<section id="filter-section" style="position: relative; padding: 40px 0; background-color: rgba(255, 255, 255, 0.9);">
    <form class="filter-form" style="max-width: 1200px; margin: auto;" onsubmit="return validateDates()">
        <h2 class="text-center mb-4">Book Your Trip</h2>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="travel-from" class="form-label">Travel From</label>
                <input type="text" id="travel-from" class="form-control wide-input" placeholder="Enter departure city" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="travel-to" class="form-label">Travel To</label>
                <input type="text" id="travel-to" class="form-control wide-input" placeholder="Enter destination city" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="transport-type" class="form-label">Transport Type</label>
                <select id="transport-type" class="form-control wide-input" required>
                    <option value="">Select type</option>
                    <option value="flight">Flight</option>
                    <option value="train">Train</option>
                    <option value="bus">Bus</option>
                    <option value="car">Car Rental</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="flight-type" class="form-label">Trip Type</label>
                <select id="flight-type" class="form-control wide-input" required>
                    <option value="">Select type</option>
                    <option value="one-way">One Way</option>
                    <option value="round-trip">Round Trip</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="departure-date" class="form-label">Departure Date</label>
                <input type="date" id="departure-date" class="form-control wide-input" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="return-date" class="form-label">Return Date</label>
                <input type="date" id="return-date" class="form-control wide-input" required disabled>
            </div>
            <div class="col-md-4 mb-3">
                <label for="guests" class="form-label">Guests</label>
                <select id="guests" class="form-control wide-input">
                    <option value="">Number of guests</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3+</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="room-type" class="form-label">Room Type</label>
                <select id="room-type" class="form-control wide-input">
                    <option value="">Room Type</option>
                    <option value="single">Single</option>
                    <option value="double">Double</option>
                    <option value="suite">Suite</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="check-in" class="form-label">Check-in</label>
                <input type="date" id="check-in" class="form-control wide-input" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="check-out" class="form-label">Check-out</label>
                <input type="date" id="check-out" class="form-control wide-input" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <label for="price-range-flight" class="form-label">Flight Price Range</label>
                <input type="range" id="price-range-flight" class="form-range" min="0" max="1000" value="500" step="10">
                <div class="d-flex justify-content-between">
                    <span>Min: $<span id="min-flight-value">0</span></span>
                    <span>Max: $<span id="max-flight-value">1000</span></span>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="price-range-hotel" class="form-label">Hotel Price Range</label>
                <input type="range" id="price-range-hotel" class="form-range" min="0" max="1000" value="500" step="10">
                <div class="d-flex justify-content-between">
                    <span>Min: $<span id="min-hotel-value">0</span></span>
                    <span>Max: $<span id="max-hotel-value">1000</span></span>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
</section>

<style>
    .wide-input {
        width: 100%; /* Make inputs full width */
    }

    .form-range {
        width: 100%; /* Ensure range inputs are full width */
    }
</style>

<script>
    document.getElementById('flight-type').addEventListener('change', function() {
        const returnDateInput = document.getElementById('return-date');
        if (this.value === 'round-trip') {
            returnDateInput.disabled = false;
        } else {
            returnDateInput.disabled = true;
            returnDateInput.value = ''; // Reset return date when switching to one-way
        }
    });

    document.getElementById('transport-type').addEventListener('change', function() {
        const flightTypeSelect = document.getElementById('flight-type');
        if (this.value === 'flight') {
            flightTypeSelect.disabled = false;
        } else {
            flightTypeSelect.value = '';
            flightTypeSelect.disabled = true; // Disable trip type for non-flight transport
        }
    });

    document.getElementById('price-range-flight').addEventListener('input', function() {
        document.getElementById('max-flight-value').innerText = this.value;
    });

    document.getElementById('price-range-hotel').addEventListener('input', function() {
        document.getElementById('max-hotel-value').innerText = this.value;
    });

    function validateDates() {
        const departureDate = new Date(document.getElementById('departure-date').value);
        const returnDate = new Date(document.getElementById('return-date').value);
        const checkInDate = new Date(document.getElementById('check-in').value);
        const checkOutDate = new Date(document.getElementById('check-out').value);

        if (checkInDate < departureDate || checkInDate > returnDate) {
            alert("Check-in date must be between departure and return dates.");
            return false;
        }

        if (checkOutDate < checkInDate || checkOutDate > returnDate) {
            alert("Check-out date must be after check-in date and within return date.");
            return false;
        }

        return true;
    }
</script>
