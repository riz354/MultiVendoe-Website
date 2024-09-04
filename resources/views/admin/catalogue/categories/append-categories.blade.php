<option value=""> Select Category</option>

<option value="0">Main Category</option>

@foreach ($categories as $category)
    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
@endforeach
