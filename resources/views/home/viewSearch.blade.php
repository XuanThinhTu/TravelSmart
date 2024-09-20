@extends('layouts.app')

@section('content')
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <h2 class="mb-4">Search Results</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @if($results->isEmpty())
                <div class="col-md-12">
                    <p class="text-center">No hotels found matching your criteria.</p>
                </div>
            @else
                @foreach($results as $hotel)
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="hotel-item">
                        <a href="#" class="img-prod">
                            <img class="img-fluid" src="{{ asset('images/hotel_placeholder.png') }}" alt="Hotel Image">
                            <span class="status">{{ $hotel->type_name }}</span>
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3 text-center">
                            <h3><a href="#">{{ $hotel->hotel_name }}</a></h3>
                            <p>{{ $hotel->city_name }}</p>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price">
                                        <span class="mr-2 price-dc">Original Price: {{ number_format($hotel->service_price) }} VND</span><br>
                                        <!-- Optionally show discounted price if applicable -->
                                    </p>
                                </div>
                            </div>
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">
                                    <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                        <span><i class="ion-ios-menu"></i></span>
                                    </a>
                                    <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                        <span><i class="ion-ios-cart"></i></span>
                                    </a>
                                    <a href="#" class="heart d-flex justify-content-center align-items-center">
                                        <span><i class="ion-ios-heart"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
@endsection
