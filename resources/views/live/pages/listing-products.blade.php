@if (isset($products))
@foreach ($products as $product)
    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
        <div class="product-item bg-light mb-4">
            <div class="product-img position-relative overflow-hidden">
                <img class="img-fluid w-100 h-75"
                    src="{{ $product->getFirstMediaUrl('product_images') }}" alt=""
                    height="200px" style="max-height: 450px;min-height:450px">

                <div class="product-action">
                    <a class="btn btn-outline-dark btn-square" href=""><i
                            class="fa fa-shopping-cart"></i></a>
                    <a class="btn btn-outline-dark btn-square" href=""><i
                            class="far fa-heart"></i></a>
                    <a class="btn btn-outline-dark btn-square" href=""><i
                            class="fa fa-sync-alt"></i></a>
                    <a class="btn btn-outline-dark btn-square" href=""><i
                            class="fa fa-search"></i></a>
                </div>
            </div>
            @php
                $discounted_pric = \App\Models\Product::getDiscountedPrice($product->id);
            @endphp

            <div class="text-center py-4">
                <a class="h6 text-decoration-none text-truncate"
                    href="{{route('product',['id'=>$product->id])}}">{{ $product->product_name }}</a>
                <div class="d-flex align-items-center justify-content-center mt-2">
                    @if ($discounted_pric > 0)
                        <h5>{{ $discounted_pric }}</h5>
                        <h6 class="text-muted ml-2"><del>{{ $product->product_price }}</del></h6>
                    @else
                        <h5>{{ $product->product_price }}</h5>
                    @endif

                </div>
                <div class="d-flex align-items-center justify-content-center mb-1">
                    <small class="fa fa-star text-primary mr-1"></small>
                    <small class="fa fa-star text-primary mr-1"></small>
                    <small class="fa fa-star text-primary mr-1"></small>
                    <small class="fa fa-star text-primary mr-1"></small>
                    <small class="fa fa-star text-primary mr-1"></small>
                    <small>(99)</small>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endif
