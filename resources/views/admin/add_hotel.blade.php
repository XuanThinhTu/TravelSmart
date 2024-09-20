<!DOCTYPE html>
<html lang="en" dir="ltr">

@include('admin.css')

<body>
    <!-- Tap on top start -->
    <div class="tap-top">
        <span class="lnr lnr-chevron-up"></span>
    </div>
    <!-- Tap on top end -->

    <!-- Page-wrapper Start -->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start -->
        @include('admin.header')
        <!-- Page Header Ends -->

        <!-- Page Body Start -->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start -->
            @include('admin.sidebar')
            <!-- Page Sidebar Ends -->

            <div class="page-body" style="margin-left: 260px; padding: 20px;">
                <div class="container-fluid">

                    <!-- Add Hotel Body Start -->
                    <div class="col-12">
                        <div class="card o-hidden card-hover">
                            <div class="card-header border-0 pb-1">
                                <div class="card-header-title p-0">
                                    <h4>Add Hotel</h4>
                                </div>
                            </div>
                            <div class="card-body p-0">

                                <!-- Flash Message -->
                                @if(Session::has('msg'))
                                <p class="alert alert-success">{{ session('msg') }}</p>
                                @endif

                                <!-- Add Hotel Form -->
                                <div class="container mt-4">
                                    <form method="POST" action="{{ route('save_hotel') }}">
                                        @csrf

                                        <div class="form-group">
                                            <label for="hotel_name">Hotel Name</label>
                                            <input type="text" name="hotel_name" id="hotel_name" class="form-control" required>
                                            @error('hotel_name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="city_id">City</label>
                                            <select name="city_id" id="city_id" class="form-control" required>
                                                <option value="">Select City</option>
                                                @foreach($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->city_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('city_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="hotel_address">Hotel Address</label>
                                            <input type="text" name="hotel_address" id="hotel_address" class="form-control" required>
                                            @error('hotel_address')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="details">Details</label>
                                            <textarea name="details" id="details" class="form-control" rows="3"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="active">Status</label>
                                            <select name="active" id="active" class="form-control" required>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                            @error('active')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="available_from">Available From</label>
                                            <input type="date" name="available_from" id="available_from" class="form-control" required>
                                            @error('available_from')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="available_to">Available To</label>
                                            <input type="date" name="available_to" id="available_to" class="form-control" required>
                                            @error('available_to')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary">Add Hotel</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Add Hotel Body End -->

                </div>
            </div>
            <!-- Page Body End -->
        </div>
        <!-- Page-wrapper End -->

        <!-- JavaScript Files -->
        <script src="{{ asset('Admin_template/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('Admin_template/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('Admin_template/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('Admin_template/js/front.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <script src="{{ asset('Admin_template/js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('Admin_template/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('Admin_template/js/icons/feather-icon/feather.min.js') }}"></script>
        <script src="{{ asset('Admin_template/js/icons/feather-icon/feather-icon.js') }}"></script>
        <script src="{{ asset('Admin_template/js/scrollbar/simplebar.js') }}"></script>
        <script src="{{ asset('Admin_template/js/scrollbar/custom.js') }}"></script>
        <script src="{{ asset('Admin_template/js/config.js') }}"></script>
        <script src="{{ asset('Admin_template/js/tooltip-init.js') }}"></script>
        <script src="{{ asset('Admin_template/js/sidebar-menu.js') }}"></script>
        <script src="{{ asset('Admin_template/js/notify/bootstrap-notify.min.js') }}"></script>
        <script src="{{ asset('Admin_template/js/notify/index.js') }}"></script>
        <script src="{{ asset('Admin_template/js/chart/apex-chart/apex-chart1.js') }}"></script>
        <script src="{{ asset('Admin_template/js/chart/apex-chart/moment.min.js') }}"></script>
        <script src="{{ asset('Admin_template/js/chart/apex-chart/apex-chart.js') }}"></script>
        <script src="{{ asset('Admin_template/js/chart/apex-chart/stock-prices.js') }}"></script>
        <script src="{{ asset('Admin_template/js/chart/apex-chart/chart-custom1.js') }}"></script>
        <script src="{{ asset('Admin_template/js/slick.min.js') }}"></script>
        <script src="{{ asset('Admin_template/js/custom-slick.js') }}"></script>
        <script src="{{ asset('Admin_template/js/customizer.js') }}"></script>
        <script src="{{ asset('Admin_template/js/ratio.js') }}"></script>
        <script src="{{ asset('Admin_template/js/sidebareffect.js') }}"></script>
        <script src="{{ asset('Admin_template/js/script.js') }}"></script>
    </div>
</body>

</html>
