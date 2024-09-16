@if(session('notify'))
    @php
        $type = session('notify')['type'];
        $message = session('notify')['message'];
        $emo = ($type == 'success') ? 'Congras!' : 'Opps!';
        $icon = ($type == 'success') ? 'fa-check-circle' : 'fa-triangle-exclamation';
    @endphp

    <div class="alert alert-{{ $type }} alert-dismissible text-white m-3" role="alert">
        <span class="alert-icon"><i class="fa-solid {{ $icon }}"></i></span>
        <span class="alert-text"><strong>{{ $emo }}</strong> {{ $message }}</span>
        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif
