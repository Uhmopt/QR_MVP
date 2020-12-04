<section id="pricing" class="section-header bg-primary text-white">
    <div class="container">

        <div class="row justify-content-center mb-6">
            <div class="col-12 col-md-10 text-center">
                <h1 class="display-2 mb-3">{{ __('qrlanding.pricing_title') }}</h1>
            <p class="lead px-5">{{__('qrlanding.pricing_subtitle')}}</p>
            </div>
        </div>
        <div class="row text-gray">
            @foreach ($plans as $plan)
                @include('qrsaas.partials.plan',['plan'=>$plan,'col'=>$col])
            @endforeach
        </div>

    </div>

</section>
