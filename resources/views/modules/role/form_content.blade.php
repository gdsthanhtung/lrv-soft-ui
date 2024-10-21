<form action="{{ $action }}" method="POST" accept-charset="UTF-8">
	@csrf
    @method($method)

	<div class="form-group">
		<label for="name" class="{{ $flClass }}">Name</label>
		<div class=""><input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $name }}" placeholder="John Doe" required></div>
	</div>

	<div class="form-group">
		<label for="email" class="{{ $flClass }}">Status</label>
		<div class="">
            <x-select.radio :listToSelect="$statusEnum" elName='status' valToChecked='{{$status}}' required='true' />
        </div>
	</div>

	<div class="form-group">
		<label for="name" class="{{ $flClass }}">Permission</label>
		<div class="">
            <x-select.checkbox :listToSelect="$permission" elName='permission' :valToChecked="$permissionSelected" required='true' col='col-4' />
        </div>
        <button type="button" id="toggleCheckboxPermission" class="btn btn-sm btn-secondary">Check all</button>
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
