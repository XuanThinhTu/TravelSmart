<!DOCTYPE html>
<html lang="en">

<head>
    <!-- head -->
    @include('admin.css')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .page-content {
            padding: 20px;
        }

        .page-header {
            margin-bottom: 20px;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        input[type="file"] {
            padding: 3px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>

<body>
    <!-- header -->
    @include('admin.header')

    <div class="d-flex align-items-stretch">
        @include('admin.sidebar')
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">Add Products</h2>
                </div>
            </div>

            <!-- Flash message -->
            @if(Session::has('msg'))
                <p class="alert alert-success">{{ session('msg') }}</p>
            @endif

            <!-- Add New Product Form -->
            <div class="container mt-4">
                <form action="{{ url('add_product/save') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Product Title</label>
                        <input type="text" id="title" name="title" placeholder="Product Title" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Product Description</label>
                        <textarea id="description" name="description" placeholder="Product Description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Product Price</label>
                        <input type="number" id="price" name="price" placeholder="Product Price" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="discount_price">Product Discount Price</label>
                        <input type="number" id="discount_price" name="discount_price" placeholder="Product Discount Price" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Product Quantity</label>
                        <input type="number" id="quantity" name="quantity" placeholder="Product Quantity" step="1">
                    </div>
                    <div class="form-group">
                        <label for="category_id">Product Category</label>
                        <select id="category_id" name="category_id">
                            <option>Select an Option</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Product Image</label>
                        <input type="file" id="image" name="image" placeholder="New Product Image">
                    </div>
                    <button type="submit">Add Product</button>
                </form>
            </div>
        </div>
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
</body>

</html>
