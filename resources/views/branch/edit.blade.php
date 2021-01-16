@extends('layouts.app', ['title' => __('Branch Management')])

@section('admin_title')
{{__('Branch Management')}}
@endsection

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
</div>
<div class="container-fluid mt--7">
    <div class="row"> 
        <div class="col-xl-6 mb-5 mb-xl-0 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Branch Management') }}</h3>
                            @if (env('WILDCARD_DOMAIN_READY',false))
                            <span
                                class="blockquote-footer">{{ (isset($_SERVER['HTTPS'])&&$_SERVER["HTTPS"] ?"https://":"http://").$branch->subdomain.".".$_SERVER['HTTP_HOST'] }}</span>
                            @endif
                        </div>
                        <div class="col-4 text-right">
                            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('owner'))
                                <a href="{{ route('branch.index') }}"
                                class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            @endif

                            @if (env('WILDCARD_DOMAIN_READY',false))
                            <a target="_blank"
                                href="{{ (isset($_SERVER['HTTPS'])&&$_SERVER["HTTPS"] ?"https://":"http://").$branch->subdomain.".".$_SERVER['HTTP_HOST'] }}"
                                class="btn btn-sm btn-success">{{ __('View it') }}</a>
                            @else
                            <a target="_blank" href="{{ route('vendor',[$branch->restorant->subdomain, $branch->subdomain]) }}"
                                class="btn btn-sm btn-success">{{ __('View it') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        @include('partials.flash')
                    </div>
                    <h6 class="heading-small text-muted mb-4">{{ __('Branch information') }}</h6>
                    <div class="pl-lg-4">
                        <form method="post" action="{{ route('branch.update', $branch) }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="name">{{ __('Branch Name') }}</label>
                                <input type="text" name="name" id="name"
                                    class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Branch Name here') }} ..." value="{{ __($branch->name) }}" required autofocus>
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="address">{{ __('Branch Address') }}</label>
                                <input type="text" name="address" id="address"
                                    class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Branch Address here') }} ..." value="{{ __($branch->address) }}" required autofocus>
                                @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="description">{{ __('Branch Description') }}</label>
                                <input type="text" name="description" id="description"
                                    class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Branch Description here') }} ..." value="{{ __($branch->description) }}" required autofocus>
                                @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                            
                            <div class="row">
                                <?php
                                    $images=[
                                        ['name'=>'branch_cover','label'=>__('Branch Cover Image'),'value'=>$branch->coverm,'style'=>'width: 200px; height: 100px;']
                                    ]
                                        ?>
                                @foreach ($images as $image)
                                <div class="col-md-6">
                                    @include('partials.images',$image)
                                </div>
                                @endforeach
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                            </div>
                            <hr />
                            <h6 class="heading-small text-muted mb-4">{{ __('Manager information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name_manager') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="name_manager">{{ __('Manger Name') }}</label>
                                    <input type="text" name="name_manager" id="name_manager"
                                        class="form-control form-control-alternative{{ $errors->has('name_manager') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Manger Name here') }} ..." value="{{ __($branch->user->name) }}" readonly autofocus>
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
                                        placeholder="{{ __('Manager Email here') }} ..." value="{{ __($branch->user->email) }}" readonly autofocus>
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
                                        placeholder="{{ __('Manager Phone here') }} ..." value="{{ __($branch->user->phone) }}" readonly autofocus>
                                    @if ($errors->has('phone_manager'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_manager') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 mb-5 mb-xl-0 order-xl-1">
            <div class="card card-profile shadow">
                <div class="card-header">
                    <h5 class="h3 mb-0">{{ __("Branch Location")}}</h5>
                </div>
                <div class="card-body">
                    <div class="nav-wrapper">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab"
                                    href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1"
                                    aria-selected="true">{{ __('Location') }}</a>
                            </li>
                            @if(!config('app.isqrsaas'))
                            @if (!env('DISABLE_DELIVER',false))
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab"
                                    href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2"
                                    aria-selected="false">{{ __('Delivery Area') }}</a>
                            </li>
                            @endif
                            @endif
                        </ul>
                    </div>
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel"
                                    aria-labelledby="tabs-icons-text-1-tab">
                                    <div id="map_location" class="form-control form-control-alternative"></div>
                                </div>
                                <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel"
                                    aria-labelledby="tabs-icons-text-2-tab">
                                    <div id="map_area" class="form-control form-control-alternative"></div>
                                    <br />
                                    <button type="button" id="clear_area"
                                        class="btn btn-danger btn-sm btn-block">{{ __("Clear Delivery Area")}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <div class="card card-profile bg-secondary shadow">
                <div class="card-header">
                    <h5 class="h3 mb-0">{{ __("Working Hours") }}</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('branch.workinghours') }}" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="branchid" name="branchid" value="{{ $branch->id }}" />
                        <input type="hidden" id="restorantid" name="restorantid" value="{{ $branch->restorant->id }}" />
                        <div class="form-group">
                            @foreach($days as $key => $value)
                            <br />
                            <div class="row">
                                <div class="col-4">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="days" class="custom-control-input"
                                            id="{{ 'day'.$key }}" value={{ $key }}>
                                        <label class="custom-control-label"
                                            for="{{ 'day'.$key }}">{{ __($value) }}</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-time-alarm"></i></span>
                                        </div>
                                        <input id="{{ $key.'_from' }}" name="{{ $key.'_from' }}"
                                            class="flatpickr datetimepicker form-control" type="text"
                                            placeholder="{{ __('Time') }}">
                                    </div>
                                </div>
                                <div class="col-2 text-center">
                                    <p class="display-4">-</p>
                                </div>
                                <div class="col-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-time-alarm"></i></span>
                                        </div>
                                        <input id="{{ $key.'_to' }}" name="{{ $key.'_to' }}"
                                            class="flatpickr datetimepicker form-control" type="text"
                                            placeholder="{{ __('Time') }}">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@endsection

@section('js')
<script type="text/javascript">
"use strict";
var defaultHourFrom = "09:00";
var defaultHourTo = "17:00";

var timeFormat = '{{ env('TIME_FORMAT ',' 24 hours ') }}';

function formatAMPM(date) {
    //var hours = date.getHours();
    //var minutes = date.getMinutes();
    var hours = date.split(':')[0];
    var minutes = date.split(':')[1];

    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    //minutes = minutes < 10 ? '0'+minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
}

//console.log(formatAMPM("19:05"));

var config = {
    enableTime: true,
    dateFormat: timeFormat == "AM/PM" ? "h:i K" : "H:i",
    noCalendar: true,
    altFormat: timeFormat == "AM/PM" ? "h:i K" : "H:i",
    altInput: true,
    allowInput: true,
    time_24hr: timeFormat == "AM/PM" ? false : true,
    onChange: [
        function(selectedDates, dateStr, instance) {
            //...
            this._selDateStr = dateStr;
        },
    ],
    onClose: [
        function(selDates, dateStr, instance) {
            if (this.config.allowInput && this._input.value && this._input.value !== this._selDateStr) {
                this.setDate(this.altInput.value, false);
            }
        }
    ]
};

$("input[type='checkbox'][name='days']").change(function() {


    var hourFrom = flatpickr($('#' + this.value + '_from'), config);
    var hourTo = flatpickr($('#' + this.value + '_to'), config);

    if (this.checked) {
        hourFrom.setDate(timeFormat == "AP/PM" ? formatAMPM(defaultHourFrom) : defaultHourFrom, false);
        hourTo.setDate(timeFormat == "AP/PM" ? formatAMPM(defaultHourTo) : defaultHourTo, false);
    } else {
        hourFrom.clear();
        hourTo.clear();
    }
}); 
//Initialize working hours
function initializeWorkingHours() {
    var workingHours = <?php echo json_encode($hours); ?>;
    if (workingHours != null) {
        Object.keys(workingHours).map((key, index) => {
            if (workingHours[key] != null) {
                var hour = flatpickr($('#' + key), config);
                hour.setDate(workingHours[key], false);

                var day_key = key.split('_')[0];
                $('#day' + day_key).attr('checked', 'checked');
            }
        })
    }
}

window.onload = function() {
    //var map, infoWindow, marker, lng, lat;

    //Working hours
    initializeWorkingHours(); 
} 
</script>

<script>
    window.intlTelInput(document.getElementById("phone_owner"), {
    // any initialisation options go here
    customContainer: "w-100"
    });
</script>
@endsection