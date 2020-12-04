<div class="form-group{{ $errors->has($id) ? ' has-danger' : '' }}">
<label class="form-control-label" for="{{ $id }}">{{ __($name) }}@isset($link)<a target="_blank" href="{{$link}}">{{$linkName}}</a>@endisset</label>
<input @isset($accept) accept="{{ $accept }}" @endisset @isset($readonly) readonly="{{ $readonly }}" @endisset @isset($step) step="{{ __($step) }}" @else step=".01" @endisset type="{{ isset($type)?$type:"text"}}" name="{{ $id }}" id="{{ $id }}" class="form-control form-control-alternative{{ $errors->has($id) ? ' is-invalid' : '' }}" placeholder="{{ __($placeholder) }}" value="{{ old($id, isset($value)?$value:'') }}" <?php if($required) {echo 'required';} ?> autofocus>
    @isset($additionalInfo)
        <small class="text-muted"><strong>{{ __($additionalInfo) }}</strong></small>
    @endisset
    @if ($errors->has($id))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first($id) }}</strong>
        </span>
    @endif
</div>
