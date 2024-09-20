<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            <!-- chart caard section start -->
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                    <div class="custome-1-bg b-r-4 card-body">
                        <div class="media align-items-center static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Total Contracts</span>
                                <h4 class="mb-0 counter">{{$totalContracts}}
                                    <span class="badge badge-light-primary grow">
                                        <i data-feather="trending-up"></i></span>
                                </h4>
                            </div>
                            <div class="align-self-center text-center">
                                <i class="ri-database-2-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                    <div class="custome-2-bg b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Total User</span>
                                <h4 class="mb-0 counter">{{$totalUsers}}
                                    <span class="badge badge-light-danger grow">
                                        <i data-feather="trending-down"></i></span>
                                </h4>
                            </div>
                            <div class="align-self-center text-center">
                                <i class="ri-shopping-bag-3-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0  card o-hidden">
                    <div class="custome-3-bg b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Total Hotels</span>
                                <h4 class="mb-0 counter">{{$totalHotel}}
                                    <a href="/add_hotel" class="badge badge-light-secondary grow">
                                        ADD NEW</a>
                                </h4>
                            </div>

                            <div class="align-self-center text-center">
                                <i class="ri-chat-3-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                    <div class="custome-4-bg b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Total TransportService</span>
                                <h4 class="mb-0 counter">{{$totalTransportService}}
                                    <span class="badge badge-light-success grow">
                                        <i data-feather="trending-down"></i></span>
                                </h4>
                            </div>

                            <div class="align-self-center text-center">
                                <i class="ri-user-add-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card o-hidden card-hover">
                    <div class="card-header border-0 pb-1">
                        <div class="card-header-title p-0">
                            <h4>Contracts</h4>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @foreach($contracts as $contract)
                        <div class="dashboard-category">
                            <a href="javascript:void(0)" class="category-name">
                                <h6>Contract ID: {{ $contract->id }}</h6> <!-- Display the contract ID -->
                                <p>User: {{ $contract->user->name }}</p> <!-- Assuming you want to display the user's name -->
                                <p>Total Price: ${{ number_format($contract->total_price, 2) }}</p> <!-- Display total price -->
                                <p>Status: {{ $contract->paid_status }}</p> <!-- Display payment status -->
                            </a>
                        </div>
                        ------------------------------------------------------------------------------------------
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Container-fluid Ends-->

            <!-- footer start-->
            <div class="container-fluid">
                <footer class="footer">
                    <div class="row">
                        <div class="col-md-12 footer-copyright text-center">
                            <p class="mb-0">Copyright 2022 © Fastkart theme by pixelstrap</p>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- footer End-->
        </div>