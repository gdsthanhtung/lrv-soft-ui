@php
    $task = 'update-role';
@endphp

<div class="card card-body p-4">
    <h6 class="mb-0">{{ $tt }}</h6>
    <p class="text-sm mb-0">{{ $stt }}</p>
    <hr class="horizontal dark my-3">

    <form action="{{ $action }}" method="POST" accept-charset="UTF-8">
        @csrf
        @method($method)

        {{-- <div class="form-group">
            <label for="password" class="{{ $flClass }}">Role</label>
            <div class="">
                <x-select.checkbox :listToSelect="$dataRole" elName='roles' :valToChecked="$uRole" required='true' col='col-12' />
            </div>
        </div> --}}

        <div class="form-group">
            <label for="roles">Roles</label>
            <select multiple class="form-control" id="roles" name="roles[]">
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" {{ $data->roles->contains('name', $role->name) ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="permissions">Permissions</label>
            <select multiple class="form-control" id="permissions" name="permissions[]">
                @foreach($permissions as $permission)
                    <option value="{{ $permission->name }}" {{ $data->permissions->contains('name', $permission->name) ? 'selected' : '' }}>
                        {{ $permission->name }} {{ ($permission->note) ? "|".$permission->note : '' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <input type="hidden" class="form-control" id="task" name="task" value="assign-role">
            {{--  --}}
            <a href="{{ route($routePrefix.'index') }}" type="button" class="btn btn-light m-0">BACK</a>
            <button type="submit" class="btn bg-gradient-primary m-0 ms-2">SUBMIT</button>
        </div>
    </form>
</div>
