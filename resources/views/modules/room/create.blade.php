<form action="{{ $action }}" method="POST" accept-charset="UTF-8">
	@csrf
    @method($method)

    <div class="form-group">
        <label for="name" class="{{ $flClass }}">Name</label>
        <div class="">
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
    </div>

    <div class="form-group">
        <label for="note" class="{{ $flClass }}">Note</label>
        <div class="">
            <input type="text" class="form-control" id="note" name="note">
        </div>
    </div>

    <div class="form-group">
        <label for="status" class="{{ $flClass }}">Status</label>
        <div class="">
            <x-select.radio :listToSelect="$statusEnum" elName="status" :valToChecked="old('status')" required="true" />
        </div>
    </div>

    <div class="d-flex justify-content-end mt-4">
        <a href="{{ route($routePrefix.'index') }}" type="button" class="btn btn-light m-0">BACK</a>
        <button type="submit" class="btn bg-gradient-primary m-0 ms-2">SUBMIT</button>
    </div>
</form>
