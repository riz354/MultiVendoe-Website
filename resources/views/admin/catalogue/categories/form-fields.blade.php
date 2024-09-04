<div class="mb-3">
    <label for="category_name" class="form-label">Name</label>
    <input type="text" class="form-control" id="category_name" name="category_name"
        value="{{ isset($category) ? $category->category_name : '' }}">
    @error('category_name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class=" position-relative mb-2">
    <label class="form-label  fs-6" style="font-size: 15px" for="status">Select
        Section<span class="text-danger">*</span></label>
    <select class="form-select  form-select-md fs-6" id="section_id" name="section_id" placeholder="">
        <option value="">Select Section</option>
        @foreach ($sections as $section)
            <option value="{{ $section->id }}" @if (isset($category) && $section->id == $category->section_id) @selected(true) @endif>
                {{ $section->name }}
            </option>
        @endforeach

    </select>
    @error('section_id')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>


<div class="position-relative mb-2">
    <label class="form-label fs-6" style="font-size: 15px" for="parent_id">
        Select Category level<span class="text-danger">*</span>
    </label>
    <select class="form-select form-select-md fs-6" id="parent_id" name="parent_id" placeholder="">
        <option value="">Select Category</option>

        @if (isset($category) && $category->parent_id == 0)
            <option value="0" selected>Main Category</option>
        @elseif (isset($category))
            <option value="{{ $category->parent_id }}" selected>
                {{ $category->parent->category_name ?? '-' }}
            </option>
        @endif
    </select>

    @error('parent_id')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>


<div class="mb-3">
    <label for="category_discount" class="form-label">Discount</label>
    <input type="text" class="form-control" id="category_discount" name="category_discount"
        value="{{ isset($category) ? $category->category_discount : '' }}">
    @error('category_discount')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <input type="text" class="form-control" id="description" name="description"
        value="{{ isset($category) ? $category->description : '' }}">
    @error('description')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label for="url" class="form-label">Url</label>
    <input type="text" class="form-control" id="url" name="url"
        value="{{ isset($category) ? $category->url : '' }}">
    @error('url')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label for="meta_title" class="form-label">Meta Title</label>
    <input type="text" class="form-control" id="meta_title" name="meta_title"
        value="{{ isset($category) ? $category->meta_title : '' }}">
    @error('meta_title')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label for="meta_description" class="form-label">Meta description</label>
    <input type="text" class="form-control" id="meta_description" name="meta_description"
        value="{{ isset($category) ? $category->meta_description : '' }}">
    @error('meta_description')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label for="meta_keywords" class="form-label">Meta Keywords</label>
    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
        value="{{ isset($category) ? $category->meta_keywords : '' }}">
    @error('meta_keywords')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<div class=" position-relative mb-2">
    <label class="form-label  fs-6" style="font-size: 15px" for="status">Select
        Status<span class="text-danger">*</span></label>
    <select class="form-select  form-select-md fs-6" id="status" name="status" placeholder="">
        <option value="1" @if (isset($category) && $category->status == 1) @selected(true) @endif>Active
        </option>
        <option value="0" @if (isset($category) && $category->status == 0) @selected(true) @endif>InActive
        </option>
    </select>
    <small class="text-muted">Select status</small>
    @error('status')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>


<div class="mb-4">
    <label for="file" class="form-label">Upload Images</label>
    <input type="file" class="filepond" name="file[]" id="file" multiple>
    @error('file')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
