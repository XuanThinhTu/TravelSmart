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
                                    <h4>Edit Country: {{ $country->country_name }}</h4>
                                </div>
                            </div>
                            <div class="card-body p-0">

                                @if(Session::has('msg'))
                                    <p class="alert alert-success">{{ session('msg') }}</p>
                                @endif

                                <form method="POST" action="{{ route('update_country', $country->id) }}">
                                    @csrf
                                    <div class="container mt-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Country Code</label>
                                                    <input type="text" name="country_code" value="{{ old('country_code', $country->country_code) }}" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Country Name</label>
                                                    <input type="text" name="country_name" value="{{ old('country_name', $country->country_name) }}" class="form-control" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary mt-2">Update Country</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
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
    </div>

    <!-- Modal Start -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

    <!-- Additional JavaScript -->
    <script src="{{ asset('Admin_template/js/script.js') }}"></script>
</body>

</html>
