@php
    use App\Helpers\Template;
    use App\Helpers\FormTemplate;

    $formLabelClass = Config::get('gds.template.formLabel.class');
    $formInputClass = Config::get('gds.template.formInput.class');

    $username       = $id ? $data['username'] : '';
    $fullname       = $id ? $data['fullname'] : '';
    $email          = $id ? $data['email'] : '';
    $status         = $id ? $data['status'] : '';
    $level          = $id ? $data['level'] : '';
    $avatar         = $id ? $data['avatar'] : '';

    //$hiddenID       = Form::hidden('id', $id);
    //$hiddenTask     = Form::hidden('task', 'change-password');

    // $element = [
    //     [
    //         'label' => Form::label('password', 'Password', ['class' => $formLabelClass]),
    //         'el'    => Form::password('password', ['class' => $formInputClass, 'required' => true])
    //     ],[
    //         'label' => Form::label('password_confirmation', 'Re-Password', ['class' => $formLabelClass]),
    //         'el'    => Form::password('password_confirmation', ['class' => $formInputClass, 'required' => true])

    //     ],[
    //         'el' => $hiddenID . $hiddenTask . Form::submit('Lưu', ['class' => 'btn btn-success']),
    //         'type'  => 'btn-submit'
    //     ]
    // ];
@endphp

<div class="col-lg-7">
    <div class="card z-index-2">
    <div class="card-header pb-0">
    <h6>Sales overview</h6>
    <p class="text-sm">
    <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
    <span class="font-weight-bold">4% more</span> in 2021
    </p>
    </div>
    <div class="card-body p-3">
    akshdakjsd
    </div>
    </div>
    </div>

{{-- <div class="col-6">
    <div class="card overflow-auto">
        <div class="card-body">
            <h5 class="card-title">Change password</h5>
            <div class="row">

                {!!
                    Form::open([
                        'url' => route($ctrl.'/save'),
                        'accept-charset' => 'UTF-8',
                        'method' => 'POST',
                        'enctype' => 'multipart/form-data',
                        'class' => 'form-horizontal form-label-left',
                        'id' => 'main-form'
                    ])
                !!}

                    {!! FormTemplate::export($element) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div> --}}
