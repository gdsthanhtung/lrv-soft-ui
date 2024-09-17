@php
    use App\Helpers\Template;

    $flClass = Config::get('gds.template.formLabel.class');
    $fiClass = Config::get('gds.template.formInput.class');

    $username       = $id ? $data['username'] : '';
    $name           = $id ? $data['name'] : '';
    $email          = $id ? $data['email'] : '';
    $status         = $id ? $data['status'] : '';
    $level          = $id ? $data['level'] : '';
    $avatar         = $id ? $data['avatar'] : '';

    $statusEnum = Config::get('gds.enum.selectStatus');
    $levelEnum  = Config::get('gds.enum.selectLevel')['value'];
    $task       = ($id) ? 'edit' : 'add';
@endphp

<div class="col-lg-7 col-md-6 col-md-12">
    <div class="card card-body p-4">
    <h6 class="mb-0">{{ $tt }}</h6>
    <p class="text-sm mb-0">{{ $stt }}</p>
    <hr class="horizontal dark my-3">

    <form action="{{ route($ctrl.'/save') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="email" class="{{ $flClass }}">Email</label>
            <div class=""><input type="email" class="form-control" id="email" name="email" value="{{ old('email') ?? $email }}" required></div>
        </div>
        <div class="form-group">
            <label for="name" class="{{ $flClass }}">Name</label>
            <div class=""><input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $name }}" required></div>
        </div>
        <div class="form-group">
            <label for="email" class="{{ $flClass }}">Status</label>
            <div class="">
                <select class="form-control" id="status" name="status" required>
                    <option>Select a item...</option>
                    @foreach ($statusEnum as $key => $val)
                    <option {{ (old('status') ?? $status ) == $key ? "selected" : "" }} value="{{ $key }}">{{ $val }}</option>
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
                    <option {{ (old('level') ?? $level ) == $key ? "selected" : "" }} value="{{ $key }}">{{ $val }}</option>
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
    </div>
</div>
