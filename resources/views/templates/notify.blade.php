@if(session('notify'))
    @php
        $type = session('notify')['type'];
        $message = session('notify')['message'];
        $emo = ($type == 'success') ? 'Congras!' : 'Opps!';
        $icon = ($type == 'success') ? 'fa-check-circle' : 'fa-triangle-exclamation';
    @endphp

    {{-- <div class="alert alert-{{ $type }} alert-dismissible fade show m-3 text-white" role="alert">
        <span class="alert-icon"><i class="fa-solid {{ $icon }}"></i></span>
        <span class="alert-text"><strong>{{ $emo }}</strong> {{ $message }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <div style="margin-top: -3px;"><span aria-hidden="true">&times;</span></div>
        </button>
    </div> --}}

    <div class="alert alert-{{ $type }} alert-dismissible text-white m-3" role="alert">
        <span class="alert-icon"><i class="fa-solid {{ $icon }}"></i></span>
        <span class="alert-text"><strong>{{ $emo }}</strong> {{ $message }}</span>
        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif
