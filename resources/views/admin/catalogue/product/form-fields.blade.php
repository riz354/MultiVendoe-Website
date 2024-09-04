<div class="position-relative mb-2">
    <label class="form-label fs-6" style="font-size: 15px" for="category_id">
        Select Category Level <span class="text-danger">*</span>
    </label>
    <select class="form-select form-select-md fs-6" id="category_id" name="category_id" placeholder="">
        <option value="">Select Category</option>
        @foreach ($sections as $section)
            <optgroup label="{{ $section->name }}">
                @foreach ($section->category as $category)
                    <option value="{{ $category->id }}" @if (isset($product) && $product->category_id==$category->id)
                        @selected(true)
                    @endif>{{ $category->category_name }}</option>
                    @foreach ($category->subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}"  @if (isset($product) && $product->category_id==$subcategory->id)
                            @selected(true)
                        @endif>-- {{ $subcategory->category_name }}</option>
                    @endforeach
                @endforeach
            </optgroup>
        @endforeach
    </select>

    @error('category_id')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="mb-3">
    <label for="product_name" class="form-label">Product Name</label>
    <input type="text" class="form-control" id="product_name" name="product_name"
        value="{{ isset($product) ? $product->product_name : '' }}">
    @error('product_name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

{{-- <div class=" position-relative mb-2">
    <label class="form-label  fs-6" style="font-size: 15px" for="status">Select
        Section<span class="text-danger">*</span></label>
    <select class="form-select  form-select-md fs-6" id="section_id" name="section_id" placeholder="">
        <option value="">Select Section</option>
        @foreach ($sections as $section)
            <option value="{{ $section->id }}" @if (isset($product) && $section->id == $product->section_id) @selected(true) @endif>
                {{ $section->name }}
            </option>
        @endforeach

    </select>
    @error('section_id')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div> --}}


{{-- <div class="position-relative mb-2">
    <label class="form-label fs-6" style="font-size: 15px" for="category_id">
        Select Category level<span class="text-danger">*</span>
    </label>
    <select class="form-select form-select-md fs-6" id="category_id" name="category_id" placeholder="">
        <option value="">Select Category</option>
        @foreach ($sections as $section)
            <optgroup label="{{$section->name}}">
               @foreach ($section['categories'] as $category)
              <option value="{{$category->id}}">{{$category->category_name}}</option>
                @foreach ($category['subcatergories'] as $subcategory)
                    <option value="{{$subcategory->id}}">{{$subcategory->category_name}}</option>
                @endforeach
               @endforeach
            </optgroup>
        @endforeach
    </select>

    @error('category_id')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div> --}}





<div class=" position-relative mb-2">
    <label class="form-label  fs-6" style="font-size: 15px" for="brand_id">Select
        Brand<span class="text-danger">*</span></label>
    <select class="form-select  form-select-md fs-6" id="brand_id" name="brand_id" placeholder="">
        <option value="">Select Brand</option>
        @foreach ($brands as $brand)
            <option value="{{ $brand->id }}" @if (isset($product) && $brand->id == $product->brand_id) @selected(true) @endif>
                {{ $brand->name }}
            </option>
        @endforeach

    </select>
    @error('brand_id')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>



<div class="mb-3">
    <label for="product_code" class="form-label">Product Code</label>
    <input type="text" class="form-control" id="product_code" name="product_code"
        value="{{ isset($product) ? $product->product_code : '' }}">
    @error('product_code')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label for="product_color" class="form-label">Product Color</label>
    <input type="text" class="form-control" id="product_color" name="product_color"
        value="{{ isset($product) ? $product->product_color : '' }}">
    @error('product_color')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<div class="mb-3">
    <label for="product_price" class="form-label">Product Price</label>
    <input type="text" class="form-control" id="product_price" name="product_price"
        value="{{ isset($product) ? $product->product_price : '' }}">
    @error('product_price')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label for="product_discount" class="form-label">Product Discount</label>
    <input type="text" class="form-control" id="product_discount" name="product_discount"
        value="{{ isset($product) ? $product->product_discount : '' }}">
    @error('product_discount')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label for="product_weight" class="form-label">Product WEight</label>
    <input type="text" class="form-control" id="product_weight" name="product_weight"
        value="{{ isset($product) ? $product->product_weight : '' }}">
    @error('product_weight')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <input type="text" class="form-control" id="description" name="description"
        value="{{ isset($product) ? $product->description : '' }}">
    @error('description')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>






<div class="mb-3">
    <label for="meta_title" class="form-label">Meta Title</label>
    <input type="text" class="form-control" id="meta_title" name="meta_title"
        value="{{ isset($product) ? $product->meta_title : '' }}">
    @error('meta_title')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label for="meta_description" class="form-label">Meta description</label>
    <input type="text" class="form-control" id="meta_description" name="meta_description"
        value="{{ isset($product) ? $product->meta_description : '' }}">
    @error('meta_description')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label for="meta_keywords" class="form-label">Meta Keywords</label>
    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
        value="{{ isset($product) ? implode(',',(json_decode($product->meta_keywords)) ): '' }}">
    @error('meta_keywords')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<div class=" position-relative mb-2">
    <label class="form-label  fs-6" style="font-size: 15px" for="status">Select
        Status<span class="text-danger">*</span></label>
    <select class="form-select  form-select-md fs-6" id="status" name="status" placeholder="">
        <option value="1" @if (isset($product) && $product->status == 1) @selected(true) @endif>Active
        </option>
        <option value="0" @if (isset($product) && $product->status == 0) @selected(true) @endif>InActive
        </option>
    </select>
    <small class="text-muted">Select status</small>
    @error('status')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>


<div class=" position-relative mb-2">
    <label class="form-label  fs-6" style="font-size: 15px" for="is_featured">Select
        Is featured<span class="text-danger">*</span></label>
    <select class="form-select  form-select-md fs-6" id="is_featured" name="is_featured" placeholder="">
        <option value="1" @if (isset($product) && $product->is_featured == 1) @selected(true) @endif>Yes
        </option>
        <option value="0" @if (isset($product) && $product->is_featured == 0) @selected(true) @endif>No
        </option>
    </select>
    <small class="text-muted">Select is_featured</small>
    @error('is_featured')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>


<div class="mb-4">
    <label for="file" class="form-label">Upload Images</label>
    <input type="file" class="filepond" name="upload_image[]" id="upload_image" multiple>
    @error('upload_image')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-4">
    <label for="upload_video" class="form-label">Upload Video</label>
    <input type="file" class="filepond" name="upload_video" id="upload_video">
    @error('upload_video')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
