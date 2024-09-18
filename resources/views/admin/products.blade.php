<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
    <style>
        .page {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
        }

        table th,
        table td {
            padding: 12px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #007BFF;
            /* A pleasant blue for the header */
            color: white;
            font-weight: bold;
            text-align: left;
        }

        table td {
            text-align: left;
        }

        table tr {
            background-color: #f9f9f9;
            /* Light grey for even rows */
        }

        table tr:hover {
            background-color: #f1f1f1;
            /* Slightly darker grey for hover */
        }

        /* Action Buttons */
        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin: 0 4px;
            border-radius: 4px;
            font-size: 14px;
            color: #fff;
            text-decoration: none;
            text-align: center;
            transition: transform 0.2s ease;
            /* Smooth zoom effect */
        }

        .btn-edit {
            background-color: #17a2b8;

            /* Bootstrap teal for edit */
        }

        .btn-edit:hover {
            transform: scale(1.05);
            color: #fff;

            /* Zoom effect on hover */
        }

        .btn-delete {
            background-color: #dc3545;
            /* Bootstrap red for delete */
        }

        .btn-delete:hover {
            transform: scale(1.05);
            color: #fff;

            /* Zoom effect on hover */
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            table {
                width: 100%;
                display: block;
                overflow-x: auto;
            }
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
                    <h2 class="h5 no-margin-bottom">Products Management</h2>
                </div>
            </div>

            <!-- Flash message -->
            @if(Session::has('msg'))
            <p class="alert alert-success">{{ session('msg') }}</p>
            @endif

            <!-- Search Form -->
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Search Products</h4>
                        <form method="GET" action="{{ url('productSearchByKeyword') }}">
                            <input type="text" name="keyword" placeholder="Search by product name" value="{{ request('search') }}" class="form-control">
                            <button type="submit" class="btn btn-primary mt-2">Search</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Display Products -->
            <div class="container mt-4">
                <div class="col-md-12" style="background-color: white;">
                    <p style="color: black; margin-bottom: 0">Total Products: {{ $totalproducts }}</p>
                </div>
            </div>

            <div class="container mt-4">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Discount Price</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->title }}</td>
                            <td>{{ Str::limit($product->description, 50) }}</td>
                            <td><img src="{{ asset('products/'.$product->image) }}" alt="Product Image" style="max-width: 100px;" /></td>
                            <td>{{ number_format($product->price, 0, ',', '.') }} VND</td>
                            <td>{{ number_format($product->discount_price, 0, ',', '.') }} VND</td>
                            <td>{{ $product->category ? $product->category->category_name : 'N/A' }}</td>
                            <td>
                                @if($product->quantity > 0)
                                {{ $product->quantity }}
                                @else
                                <span style="color: red;">Out of Stock</span>
                                @endif
                            </td>
                            <td>
                                <!-- Action Buttons -->
                                <a href="{{ url('edit_product', $product->id) }}" class="btn btn-edit">Edit</a>
                                <a href="{{ url('delete_product', $product->id) }}" class="btn btn-delete" onclick="return confirmation(event)">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            <div class="page">
                {{$products->onEachSide(1)->links()}}
            </div>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        function confirmation(ev) {
            ev.preventDefault();

            var urlToRedirect = ev.currentTarget.getAttribute('href');

            swal({
                    title: "Delete Confirmation",
                    text: "Are you sure you want to delete this product?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = urlToRedirect;
                    }
                });
        }
    </script>
</body>

</html>