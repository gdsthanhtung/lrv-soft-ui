<form action="{{ $action }}" method="POST" accept-charset="UTF-8">
	@csrf
    @method($method)

    <div class="form-group">
        <label for="parent_id">Parent Menu</label>
        <select class="form-control" id="parent_id" name="parent_id">
            <option value="">-- No Parent --</option>
            @foreach($parentMenus as $parent)
                <option value="{{ $parent->id }}"
                    {{ old('parent_id', $data->parent_id ?? '') == $parent->id ? 'selected' : '' }}>
                    {{ $parent->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="name" class="{{ $flClass }}">Name</label>
        <div class="">
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $data->name) }}" required>
        </div>
    </div>

    <div class="form-group">
        <label for="url" class="{{ $flClass }}">URL</label>
        <input type="text" class="form-control" id="url" name="url" value="{{ old('url', $data->url) }}">
    </div>

    <div class="form-group">
        <label for="icon" class="{{ $flClass }}">Icon</label>
        <input type="text" class="form-control" id="icon" name="icon" value="{{ old('icon', $data->icon) }}" required>
    </div>

    <div class="form-group">
        <label for="order" class="{{ $flClass }}">Order</label>
        <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $data->order) }}" required>
    </div>

    <div class="form-group">
        <label for="permission">Permission</label>
        <select class="form-control" id="permission" name="permission">
            <option value="">Select Permission</option>
            @foreach($permissions as $permission)
                <option value="{{ $permission->name }}" {{ old('permission', $data->permission) == $permission->name ? 'selected' : '' }}>
                    {{ $permission->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="status" class="{{ $flClass }}">Status</label>
        <div class="">
            <x-select.radio :listToSelect="$statusEnum" elName="status" :valToChecked="old('status', $data->status)" :required="true" />
        </div>
    </div>

    <div class="d-flex justify-content-end mt-4">
        <a href="{{ route($routePrefix.'index') }}" type="button" class="btn btn-light m-0">BACK</a>
        <button type="submit" class="btn bg-gradient-primary m-0 ms-2">SUBMIT</button>
    </div>
</form>
