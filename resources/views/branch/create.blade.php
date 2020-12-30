@extends('layouts.app', ['title' => __('Branch Management')])

@section('admin_title')
{{__('Branch Management')}}
@endsection

@section('content')
@include('restorants.partials.header', ['title' => __('Add Branch')])
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Branch Management') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('branch.index') }}"
                                class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">{{ __('Branch information') }}</h6>
                    <div class="pl-lg-4">
                        <form method="post" action="{{ route('branch.store') }}" autocomplete="off">
                            @csrf
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="name">{{ __('Branch Name') }}</label>
                                <input type="text" name="name" id="name"
                                    class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Branch Name here') }} ..." value="" required autofocus>
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="description">{{ __('Branch Description') }}</label>
                                <input type="text" name="description" id="description"
                                    class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Branch Description here') }} ..." value="" required autofocus>
                                @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                            <hr />
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name_manager') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="name_manager">{{ __('Manger Name') }}</label>
                                    <input type="text" name="name_manager" id="name_manager"
                                        class="form-control form-control-alternative{{ $errors->has('name_manager') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Manger Name here') }} ..." value="" required autofocus>
                                    @if ($errors->has('name_manager'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name_manager') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email_manager') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="email_manager">{{ __('Manager Email') }}</label>
                                    <input type="email" name="email_manager" id="email_manager"
                                        class="form-control form-control-alternative{{ $errors->has('email_manager') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Manager Email here') }} ..." value="" required autofocus>
                                    @if ($errors->has('email_manager'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email_manager') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('phone_manager') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="phone_manager">{{ __('Manager Phone') }}</label>
                                    <input type="text" name="phone_manager" id="phone_manager"
                                        class="form-control form-control-alternative{{ $errors->has('phone_manager') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Manager Phone here') }} ..." value="" required autofocus>
                                    @if ($errors->has('phone_manager'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_manager') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@endsection

@section('js')
<script>
    window.intlTelInput(document.getElementById("phone_manager"), {
    // any initialisation options go here
    customContainer: "w-100"
    });
</script>
@endsection