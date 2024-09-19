@php
    $task = 'change-password';
@endphp

<div class="col-lg-5 col-md-6 col-md-12 mb-5">
    <div class="card card-body p-4">
    <h6 class="mb-0">{{ $tt }}</h6>
    <p class="text-sm mb-0">{{ $stt }}</p>
    <hr class="horizontal dark my-3">

    <form action="{{ route($ctrl.'/save') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="password" class="{{ $flClass }}">Password</label>
            <div class=""><input type="password" class="form-control" id="password" name="password" placeholder="******" required></div>
        </div>
        <div class="form-group">
            <label for="password_confirmation" class="{{ $flClass }}">Password confirmation</label>
            <div class=""><input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="******" required></div>
        </div>
        <div class="d-flex justify-content-end mt-4">
            <input type="hidden" class="form-control" id="id" name="id" value="{{ $id }}">
            <input type="hidden" class="form-control" id="task" name="task" value="{{ $task }}">
            {{--  --}}
            <a href="{{ route($ctrl) }}" type="button" class="btn btn-light m-0">BACK</a>
            <button type="submit" class="btn bg-gradient-primary m-0 ms-2">SUBMIT</button>
        </div>
    </form>
</div>
