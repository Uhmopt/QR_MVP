 <!-- DEMO -->
 <section id="demo" class="section section-lg pb-5 bg-soft">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="mb-4">{{ __('qrlanding.demo_title') }}</h2>
                <p class="lead mb-5">{{ __('qrlanding.demo_subtitle') . " " }}<span class="font-weight-bolder">{{ __('qrlanding.qr_code') }}</span> {{ __('qrlanding.below') }}!</p>
                <a href="#" class="icon icon-lg text-gray mr-3">
                    <img style="width:300px" src="{{ asset('impactfront') }}/img/qrdemo.jpg" />

                </a>

            </div>
            <div class="col-12 text-center">
                <!-- Button Modal -->
                <a href="{{ route('newrestaurant.register') }}" class="btn btn-secondary animate-up-2"><span class="mr-2"><i class="fas fa-hand-pointer"></i></span>{{ __('qrlanding.demo_button') }}</a>
            </div>
        </div>
    </div>
</section>
