<form action="{{ route('admin.'.$ctrl.'.save') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
	@csrf

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
	</div>

	<div class="d-flex justify-content-end mt-4">
        <input type="hidden" class="form-control" id="id" name="id" value="{{ $id }}">
        <input type="hidden" class="form-control" id="task" name="task" value="{{ $task }}">
        {{--  --}}
		<a href="{{ route('admin.'.$ctrl) }}" type="button" class="btn btn-light m-0">BACK</a>
		<button type="submit" class="btn bg-gradient-primary m-0 ms-2">SUBMIT</button>
	</div>
</form>
