<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        .form-group input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group button {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }

        .form-group a {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #007BFF;
            text-decoration: none;
            border: 1px solid #007BFF;
            border-radius: 4px;
            text-align: center;
        }

        .form-group a:hover {
            background-color: #007BFF;
            color: #fff;
        }

        .alert {
            padding: 15px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    @include('admin.header')

    <div class="d-flex align-items-stretch">
        @include('admin.sidebar')
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">Category Management</h2>
                </div>
            </div>
            <div class="container">
                <h3>Edit Category</h3>

                @if(Session::has('msg'))
                <div class="alert">{{ session('msg') }}</div>
                @endif

                <form method="post" action="{{ url('category/update') }}">
                    @csrf
                    <div class="form-group">
                        <label for="categoryName">Name</label>
                        <input type="text" id="categoryName" name="category_name" value="{{ $category->category_name }}">
                        <input type="hidden" name="id" value="{{ $category->id }}">
                    </div>
                    <div class="form-group">
                        <button type="submit">Save</button>
                    </div>
                    <div class="form-group">
                        <a href="{{ url('view_category') }}">Back to Index</a>
                    </div>
                </form>
            </div>

            <!-- JavaScript files -->
            <script src="{{ asset('Admin_template/vendor/jquery/jquery.min.js') }}"></script>
            <script src="{{ asset('Admin_template/vendor/popper.js/umd/popper.min.js') }}"></script>
            <script src="{{ asset('Admin_template/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
            <script src="{{ asset('Admin_template/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
            <script src="{{ asset('Admin_template/vendor/chart.js/Chart.min.js') }}"></script>
            <script src="{{ asset('Admin_template/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
            <script src="{{ asset('Admin_template/js/charts-home.js') }}"></script>
            <script src="{{ asset('Admin_template/js/front.js') }}"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>