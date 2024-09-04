<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{isset($section) ? $section->name:'' }}">
    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<div class=" position-relative mb-2">
    <label class="form-label  fs-6" style="font-size: 15px" for="status">Select
        Status<span class="text-danger">*</span></label>
    <select class="form-select  form-select-md fs-6" id="status" name="status" placeholder="">
        <option value="1" @if ( isset($section) && $section->status == 1) @selected(true) @endif>Active
        </option>
        <option value="0" @if ( isset($section) && $section->status == 0) @selected(true) @endif>InActive
        </option>
    </select>
    <small class="text-muted">Select status</small>
    @error('status')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
