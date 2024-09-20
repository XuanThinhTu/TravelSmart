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
                    <div class="col-12">
                        <div class="card o-hidden card-hover">
                            <div class="card-header border-0 pb-1">
                                <div class="card-header-title p-0">
                                    <h4>Add New City</h4>
                                </div>
                            </div>
                            <div class="card-body p-0">

                                @if(Session::has('msg'))
                                <p class="alert alert-success">{{ session('msg') }}</p>
                                @endif

                                @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                <form method="POST" action="{{ url('add_city/save') }}">
                                    @csrf
                                    <div class="container mt-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>City Name</label>
                                                    <input type="text" name="city_name" value="{{ old('city_name') }}" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <select name="country_id" class="form-control" required>
                                                        <option value="">Select Country</option>
                                                        @foreach($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary mt-2">Add City</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Index Body End -->

            <!-- JavaScript Files -->
            <script src="{{ asset('Admin_template/vendor/jquery/jquery.min.js') }}"></script>
            <script src="{{ asset('Admin_template/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
            <script src="{{ asset('Admin_template/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
            <script src="{{ asset('Admin_template/js/front.js') }}"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
            <script type="text/javascript">
                function confirmation(ev) {
                    ev.preventDefault();

                    var urlToRedirect = ev.currentTarget.getAttribute('href');

                    swal({
                        title: "Delete Confirmation",
                        text: "Are you sure you want to delete this country?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            window.location.href = urlToRedirect;
                        }
                    });
                }
            </script>

        </div>
        <!-- Page Body End -->
    </div>
    <!-- Page-wrapper End -->


    <!-- Modal Start -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title" id="staticBackdropLabel">Logging Out</h5>
                    <p>Are you sure you want to log out?</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="button-box">
                        <button type="button" class="btn btn--no" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn btn--yes btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->

    <!-- latest js -->
    <script src="{{ asset('Admin_template/js/jquery-3.6.0.min.js') }}"></script>

    <!-- Bootstrap js -->
    <script src="{{ asset('Admin_template/js/bootstrap/bootstrap.bundle.min.js') }}"></script>

    <!-- feather icon js -->
    <script src="{{ asset('Admin_template/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('Admin_template/js/icons/feather-icon/feather-icon.js') }}"></script>

    <!-- scrollbar simplebar js -->
    <script src="{{ asset('Admin_template/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('Admin_template/js/scrollbar/custom.js') }}"></script>

    <!-- Sidebar jquery -->
    <script src="{{ asset('Admin_template/js/config.js') }}"></script>

    <!-- tooltip init js -->
    <script src="{{ asset('Admin_template/js/tooltip-init.js') }}"></script>

    <!-- Plugins JS -->
    <script src="{{ asset('Admin_template/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('Admin_template/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('Admin_template/js/notify/index.js') }}"></script>

    <!-- Apexchart js -->
    <script src="{{ asset('Admin_template/js/chart/apex-chart/apex-chart1.js') }}"></script>
    <script src="{{ asset('Admin_template/js/chart/apex-chart/moment.min.js') }}"></script>
    <script src="{{ asset('Admin_template/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('Admin_template/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('Admin_template/js/chart/apex-chart/chart-custom1.js') }}"></script>

    <!-- slick slider js -->
    <script src="{{ asset('Admin_template/js/slick.min.js') }}"></script>
    <script src="{{ asset('Admin_template/js/custom-slick.js') }}"></script>

    <!-- customizer js -->
    <script src="{{ asset('Admin_template/js/customizer.js') }}"></script>

    <!-- ratio js -->
    <script src="{{ asset('Admin_template/js/ratio.js') }}"></script>

    <!-- sidebar effect -->
    <script src="{{ asset('Admin_template/js/sidebareffect.js') }}"></script>

    <!-- Theme js -->
    <script src="{{ asset('Admin_template/js/script.js') }}"></script>
</body>

</html>