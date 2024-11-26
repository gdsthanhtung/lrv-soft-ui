<form action="{{ $action }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
	@csrf
    @method($method)

	<div class="form-group">
		<label for="email" class="{{ $flClass }}">Email</label>
		<div class=""><input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="john.doe@icloud.com" required></div>
	</div>

	<div class="form-group">
		<label for="password" class="{{ $flClass }}">Password</label>
		<div class=""><input type="password" class="form-control" id="password" name="password" placeholder="******" required></div>
	</div>

	<div class="form-group">
		<label for="password_confirmation" class="{{ $flClass }}">Password confirmation</label>
		<div class=""><input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="******" required></div>
	</div>

	<div class="form-group">
		<label for="name" class="{{ $flClass }}">Name</label>
		<div class=""><input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="John Doe" required></div>
	</div>

    <div class="form-group">
        <label for="roles">Roles</label>
        <select multiple class="form-control" id="roles" name="roles[]">
            @foreach($roles as $role)
                <option value="{{ $role->name }}" {{ collect(old('roles'))->contains($role->name) ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="permissions">Permissions</label>
        <select multiple class="form-control" id="permissions" name="permissions[]">
            @foreach($permissions as $permission)
                <option value="{{ $permission->name }}" {{ collect(old('permissions'))->contains($permission->name) ? 'selected' : '' }}>
                    {{ $permission->name }} ({{ $permission->note }})
                </option>
            @endforeach
        </select>
    </div>

	<div class="form-group">
		<label for="email" class="{{ $flClass }}">Status</label>
		<div class="">
            <x-select.radio :listToSelect="$statusEnum" elName='status' :valToChecked="old('status')" required='true' />
        </div>
	</div>

	<div class="form-group">
		<label for="avatar" class="{{ $flClass }}">Avatar</label>
		<div class=""><input type="file" class="form-control" id="avatar" name="avatar"></div>
	</div>

	<div class="d-flex justify-content-end mt-4">
        <a href="{{ route($routePrefix.'index') }}" type="button" class="btn btn-light m-0">BACK</a>
        <button type="submit" class="btn bg-gradient-primary m-0 ms-2">SUBMIT</button>
	</div>
</form>
