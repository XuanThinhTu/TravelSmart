<!DOCTYPE html>
<html>
<!-- head -->
@include('admin.css')

<body>
    <!-- header -->
    @include('admin.header')

    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin.sidebar')
        <!-- Sidebar Navigation end-->
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">

                @include('admin.body')
                
        </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{ asset('Admin_template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('Admin_template/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('Admin_template/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('Admin_template/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('Admin_template/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('Admin_template/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('Admin_template/js/charts-home.js') }}"></script>
    <script src="{{ asset('Admin_template/js/front.js') }}"></script>
</body>

</html>