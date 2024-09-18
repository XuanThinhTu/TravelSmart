<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
    <style>
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
            /* Zoom effect on hover */
            color: #fff
           
        }

        .btn-delete {
            background-color: #dc3545;
            /* Bootstrap red for delete */
        }

        .btn-delete:hover {
            transform: scale(1.05);
            /* Zoom effect on hover */
            color: #fff

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
    @include('admin.header')

    <div class="d-flex align-items-stretch">
        @include('admin.sidebar')
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">Category Management</h2>
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
                        <h4>Search Categories</h4>
                        <form method="GET" action="{{ url('searchByKeyword') }}">
                            <input type="text" name="keyword" placeholder="Search by category name" value="{{ request('search') }}" class="form-control">
                            <button type="submit" class="btn btn-primary mt-2">Search</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Add New Category Form -->
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Add New Category</h4>
                        <form method="post" action="{{ url('add_category') }}">
                            @csrf
                            <input type="text" name="category_name" placeholder="New Category Name" class="form-control">
                            <button type="submit" class="btn btn-success mt-2">Add Category</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Display Categories -->
            <div class="container mt-4">
                <div class="col-md-12" style="background-color: white;">
                    <p style="color: black; margin-bottom: 0">Total Categories: {{ $totalcategories }}</p>
                </div>
            </div>


            <!-- Display Categories -->
            <div class="container mt-4">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th style="padding-left:1.3vw ;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>
                                <!-- Action Buttons -->
                                <a href="{{ url('edit_category', $category->id) }}" class="btn btn-edit">Edit</a>
                                <a href="{{ url('delete_category', $category->id) }}" class="btn btn-delete" onclick="return confirmation(event)">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
                    title:"Delete Confirmation",
                    text: "Are You Sure You Want To Delete This Category",
                    icon: "warning",
                    buttons: true,
                    dagerMode:true,
                })
                .then((willCancel)=>{
                    window.location.href=urlToRedirect;
                });

            }
        </script>
    </div>
    </div>
</body>

</html>