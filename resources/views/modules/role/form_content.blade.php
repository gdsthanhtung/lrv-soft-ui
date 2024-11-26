<form action="{{ $action }}" method="POST" accept-charset="UTF-8">
	@csrf
    @method($method)

	<div class="form-group">
		<label for="name" class="{{ $flClass }}">Name</label>
		<div class=""><input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $name }}" placeholder="Role name" required></div>
	</div>

    <div class="form-group">
            <label for="permissions">Permissions</label>
            <select multiple class="form-control" id="permissions" name="permissions[]">
                @foreach($permissions as $permission)
                    @if($id)
                        <option value="{{ $permission->name }}" {{ $data->permissions->contains('name', $permission->name) ? 'selected' : '' }}>
                    @else
                        <option value="{{ $permission->name }}" {{ collect(old('permissions'))->contains($permission->name) ? 'selected' : '' }}>
                    @endif
                        {{ $permission->name }} {{ ($permission->note) ? "|".$permission->note : '' }}
                    </option>
                @endforeach
            </select>
        </div>

	<div class="d-flex justify-content-end mt-4">
        <a href="{{ route($routePrefix.'index') }}" type="button" class="btn btn-light m-0">BACK</a>
        <button type="submit" class="btn bg-gradient-primary m-0 ms-2">SUBMIT</button>
    </div>
</form>

@section('modules_script')
    <script src="{{ asset('assets/gds-custom/gds/js/toggle_checkbox.js') }}"></script>
    <script>
        $(document).ready(function () {
            toggleCheckbox('toggleCheckboxPermission', 'permission[]');
        });
    </script>
@endsection
