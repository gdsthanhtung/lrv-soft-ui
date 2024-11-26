@php
    use App\Helpers\Template;

    $name           = $data['name'];
    $email          = $data['email'];
    $status         = $data['status'];
    $level          = $data['level'];
    $avatar         = $data['avatar'];
    $current_avatar = $data['avatar'];

    $avatarImg      = Template::showItemAvatar($ctrl, $avatar, $name, $size='l');
@endphp

<div class="card card-body p-4">
    <div class="row">
        <div class="col-md-8 align-items-center">
            <h6 class="mb-0">{{ $tt }}</h6>
            <p class="text-sm mb-0">{{ $stt }}</p>
        </div>
        <div class="col-md-4 text-end">
            {!! $avatarImg !!}
        </div>
    </div>
    <hr class="horizontal dark my-3">

    <form action="{{ $action }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
        @csrf
        @method($method)

        <div class="form-group">
            <label for="email" class="{{ $flClass }}">Email</label>
            <div class=""><input type="email" class="form-control" id="email" name="email" value="{{ old('email') ?? $email }}" placeholder="john.doe@icloud.com" required></div>
        </div>
        <div class="form-group">
            <label for="name" class="{{ $flClass }}">Name</label>
            <div class=""><input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $name }}" placeholder="John Doe" required></div>
        </div>
        <div class="form-group">
            <label for="email" class="{{ $flClass }}">Status</label>
            <div class="">
                <x-select.radio :listToSelect="$statusEnum" elName='status' :valToChecked="old('status') ?? $status" required='true' />
            </div>
        </div>
        <div class="form-group">
            <label for="avatar" class="{{ $flClass }}">Avatar</label>
            <div class=""><input type="file" class="form-control" id="avatar" name="avatar"></div>
        </div>
        <div class="d-flex justify-content-end mt-4">
            <input type="hidden" class="form-control" id="task" name="task" value="update-info">
            <input type="hidden" class="form-control" id="current_avatar" name="current_avatar" value="{{ $current_avatar }}">
            {{--  --}}
            <a href="{{ route($routePrefix.'index') }}" type="button" class="btn btn-light m-0">BACK</a>
            <button type="submit" class="btn bg-gradient-primary m-0 ms-2">SUBMIT</button>
        </div>
    </form>
</div>
