<div class=" position-relative mb-2">
    <label class="form-label  fs-6" style="font-size: 15px" for="coupon_option">Select
        Coupon option<span class="text-danger">*</span></label>
    <select class="form-select  form-select-md fs-6" id="coupon_option" name="coupon_option" placeholder="">
        <option value="">Select  Coupon option</option>

            <option value="Automatic" >
                Automatic
            </option>
            <option value="Manual" >
                Manual
            </option>

    </select>
    @error('brand_id')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="mb-3">
    <label for="coupon_code" class="form-label"> Coupon Code</label>
    <input type="text" class="form-control" id="coupon_code" name="coupon_code"
        value="{{ isset($product) ? $product->coupon_code : '' }}">
    @error('coupon_code')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label for="expiry_date" class="form-label"> expiry date</label>
    <input type="date" class="form-control" id="expiry_date" name="expiry_date"
        value="{{ isset($product) ? $product->expiry_date : '' }}">
    @error('expiry_date')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class=" position-relative mb-2">
    <label class="form-label  fs-6" style="font-size: 15px" for="coupon_type">Select
        Coupon type<span class="text-danger">*</span></label>
    <select class="form-select  form-select-md fs-6" id="coupon_type" name="coupon_type" placeholder="">
        <option value="">Select  Coupon type</option>

            <option value="Multiple Times" >
                Multiple Times
            </option>
            <option value="Single Times" >
                Single Times
            </option>

    </select>
    @error('brand_id')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>



<div class=" position-relative mb-2">
    <label class="form-label  fs-6" style="font-size: 15px" for="amount_type">Select
        Amount type<span class="text-danger">*</span></label>
    <select class="form-select  form-select-md fs-6" id="amount_type" name="amount_type" placeholder="">
        <option value="">Select  Amount type</option>

            <option value="Percentage" >
                Percentage
            </option>
            <option value="Fix" >
               Fix
            </option>

    </select>
    @error('brand_id')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="mb-3">
    <label for="amount" class="form-label"> Amount</label>
    <input type="text" class="form-control" id="amount" name="amount"
        value="{{ isset($product) ? $product->amount : '' }}">
    @error('amount')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>



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





<div class=" position-relative mb-2">
    <label class="form-label  fs-6" style="font-size: 15px" for="users">Select
        User<span class="text-danger">*</span></label>
    <select class="form-select  form-select-md fs-6" id="users" name="users" placeholder="">
        <option value="">Select Brand</option>
        @foreach ($users as $user)
            <option value="{{ $user->id }}" @if (isset($product) && $user->id == $product->user_id) @selected(true) @endif>
                {{ $user->email }}
            </option>
        @endforeach

    </select>
    @error('brand_id')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>




