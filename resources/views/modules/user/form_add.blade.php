<form action="{{ route($ctrl.'/save') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
	@csrf

	<div class="form-group">
		<label for="email" class="{{ $flClass }}">Email</label>
		<div class=""><input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required></div>
	</div>

	<div class="form-group">
		<label for="password" class="{{ $flClass }}">Password</label>
		<div class=""><input type="password" class="form-control" id="password" name="password" required></div>
	</div>

	<div class="form-group">
		<label for="password_confirmation" class="{{ $flClass }}">Password confirmation</label>
		<div class=""><input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required></div>
	</div>

	<div class="form-group">
		<label for="name" class="{{ $flClass }}">Name</label>
		<div class=""><input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required></div>
	</div>

	<div class="form-group">
		<label for="email" class="{{ $flClass }}">Status</label>
		<div class="">
            <select class="form-control" id="status" name="status" required>
                <option>Select a item...</option>
                @foreach ($statusEnum as $key => $val)
                    <option {{ old('status') == $key ? "selected" : "" }} value="{{ $key }}">{{ $val }}</option>
                @endforeach
            </select>
        </div>
	</div>

	<div class="form-group">
		<label for="email" class="{{ $flClass }}">Level</label>
		<div class="">
            <select class="form-control" id="level" name="level" required>
                <option>Select a item...</option>
                @foreach ($levelEnum as $key => $val)
                    <option {{ old('level') == $key ? "selected" : "" }} value="{{ $key }}">{{ $val }}</option>
                @endforeach
            </select>
        </div>
	</div>

	<div class="form-group">
		<label for="avatar" class="{{ $flClass }}">Avatar</label>
		<div class=""><input type="file" class="form-control" id="avatar" name="avatar"></div>
	</div>

	<div class="d-flex justify-content-end mt-4">
        <input type="hidden" class="form-control" id="task" name="task" value="{{ $task }}">
        {{--  --}}
		<a href="{{ route($ctrl) }}" type="button" class="btn btn-light m-0">BACK</a>
		<button type="submit" class="btn bg-gradient-primary m-0 ms-2">SUBMIT</button>
	</div>
</form>
