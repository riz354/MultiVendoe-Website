<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ isset($role) ? $role->name : '' }}">
    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>



<div class=" position-relative mb-2">
    @foreach ($permissions as $permission)
        <div>

            <input type="checkbox" class="form-checkbox" name="permission[]" id="permission-{{ $permission->id }}"
                value="{{ $permission->name }}" @if (isset($role_permissions) && in_array($permission->id,$role_permissions) ) @checked(true)

                @endif>
            <label for="permission-{{ $permission->id }}">{{ $permission->show_name }}</label>
        </div>
    @endforeach
</div>
