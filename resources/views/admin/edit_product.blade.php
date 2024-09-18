<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
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

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group textarea {
            resize: vertical;
            height: 100px;
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
                    <h2 class="h5 no-margin-bottom">Edit Product</h2>
                </div>
            </div>
            <div class="container">
                <h3>Edit Product</h3>

                @if(Session::has('msg'))
                <div class="alert">{{ session('msg') }}</div>
                @endif

                <form method="post" action="{{ url('product/update') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">

                    <div class="form-group">
                        <label for="title">Product Title</label>
                        <input type="text" id="title" name="title" value="{{ $product->title }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Product Description</label>
                        <textarea id="description" name="description" required>{{ $product->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="price">Product Price</label>
                        <input type="text" id="price" name="price" value="{{ $product->price }}">
                    </div>

                    <div class="form-group">
                        <label for="quantity">Product Quantity</label>
                        <input type="number" id="quantity" name="quantity" value="{{ $product->quantity }}">
                    </div>

                    <div class="form-group">
                        <label for="category_id">Product Category</label>
                        <select id="category_id" name="category_id">
                            <option value="">Select a Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="image">Product Image</label>
                        <input type="file" id="image" name="image">
                        @if($product->image)
                        <p>Current Image: <img src="{{ asset('products/' . $product->image) }}" alt="Product Image" style="max-width: 100px;" /></p>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit">Update Product</button>
                    </div>

                    <div class="form-group">
                    <a href="{{ url('view_product') }}">Back to Products</a>
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
        </div>
    </div>
</body>

</html>
