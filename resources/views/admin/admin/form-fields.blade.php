<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ isset($admin) ? $admin->name : '' }}">
    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>



<div class=" position-relative mb-2">
    @foreach ($roles as $role)
        <div>

            <input type="checkbox" class="form-checkbox" name="role[]" id="role-{{ $admin->id }}"
                value="{{ $role->name }}" @if (isset($hasRoles) && in_array($role->id,$hasRoles) ) @checked(true)

                @endif>
            <label for="permission-{{ $role->id }}">{{ $role->name }}</label>
        </div>
    @endforeach
</div>
