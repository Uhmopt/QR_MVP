<nav id="navbar-main" class="navbar navbar-light navbar-expand-lg fixed-top">


  <div class="container-fluid">
      <a class="navbar-brand mr-lg-5 mx-auto d-block" href="/">
        <img class="mx-auto d-block" src="{{ config('global.site_logo') }}">
      </a>
      @if( request()->get('location') )
      <span style="z-index: 10" class="">{{ __('DELIVERING TO')}} :  <b>{{request()->get('location')}}</b></span> <a   data-toggle="modal"  href="#locationset"><span class="ml-sm-2 search description">({{ __('change')}})</span></a>
      @endif
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse collapse" id="navbar_global">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="#">
                <img src="{{ config('global.site_logo') }}">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

  </nav>
