@php
    $task = 'update-role';
@endphp

<div class="card card-body p-4">
    <h6 class="mb-0">{{ $tt }}</h6>
    <p class="text-sm mb-0">{{ $stt }}</p>
    <hr class="horizontal dark my-3">

    <form action="{{ route('admin.'.$ctrl.'.save') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="password" class="{{ $flClass }}">Role</label>
            <div class="">
                <x-select.checkbox :listToSelect="$dataRole" elName='roles' :valToChecked="$uRole" required='true' col='col-12' />
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
</div>
