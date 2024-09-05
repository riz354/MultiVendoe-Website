

    <div class="card my-3">
        <input type="hidden" name="product_id"
        value="{{ isset($product) ? $product->id : '' }}">
        <div class="cartd-body">
            <h1 style="text-align: center">Add Attribute </h1>
            <h6>Product Name : {{ $product->name }}</h6>
            <h6>Product Code : {{ $product->product_code }}</h6>
            <h6>Product Color : {{ $product->product_color }}</h6>
            <h6>Product Price : {{ $product->price }}</h6>

            <img src="{{ $product->getFirstMediaUrl('product_images') }}" alt="" height="100px" width="100px">
        </div>

        <div class="attribute_repeaater mt-1">
            <div data-repeater-list="product_attribute">
            <input data-repeater-create type="button" class="btn btn-primary my-3" value="Add" />

                <div data-repeater-item class="" style="border: 1px dotted black">
                    <div class="row">
                        <div class="col-6">
                            <label for="product_name" class="form-label">Price</label>
                            <input type="text" class="form-control" id="price" name="price"
                                value="{{ isset($product) ? $product->price : '' }}">
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="size" class="form-label">Size</label>
                            <input type="text" class="form-control" id="size" name="size"
                                value="{{ isset($product) ? $product->size : '' }}">
                            @error('size')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">

                    <div class="col-6">
                        <label for="sku" class="form-label">SKU</label>
                        <input type="text" class="form-control" id="sku" name="sku"
                            value="{{ isset($product) ? $product->sku : '' }}">
                        @error('sku')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-6">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="text" class="form-control" id="stock" name="stock"
                            value="{{ isset($product) ? $product->stock : '' }}">
                        @error('stock')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    </div>

                    <input data-repeater-delete type="button" class="btn btn-danger my-2" value="Delete" />
                </div>
            </div>
        </div>

    </div>
