<section id="product" class="section section-lg">
    <div class="container">
        <div class="row justify-content-center mb-5 mb-md-7">
            <div class="col-12 col-md-8 text-center">
                <h2 class="h1 font-weight-bolder mb-4">{{ __('qrlanding.product_title') }}</h2>
                <p class="lead">{{ __('qrlanding.product_description')}} <br /><strong>{{ __('qrlanding.product_subtitle')}}.</strong></p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 mb-5">
                <div class="card shadow-soft border-light">
                    <div class="card-header p-0">
                        <img src="{{ asset('impactfront') }}/img/menubuilder.jpg" class="card-img-top rounded-top" alt="image">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title mt-3">{{ __('qrlanding.product1_title') }}</h3>
                        <p class="card-text">{{ __('qrlanding.product1_subtitle') }}</p>
                        <ul class="list-group d-flex justify-content-center mb-4">
                            <li class="list-group-item d-flex pl-0 pb-1">
                                <span class="mr-2"><i class="fas fa-check-circle text-success"></i></span>
                            <div>{{ __('qrlanding.product1_feature1')}}</div>
                            </li>
                            <li class="list-group-item d-flex pl-0 pb-1">
                                <span class="mr-2"><i class="fas fa-check-circle text-success"></i></span>
                                <div>{{ __('qrlanding.product1_feature2')}}</div>
                            </li>
                            <li class="list-group-item d-flex pl-0 pb-1">
                                <span class="mr-2"><i class="fas fa-check-circle text-success"></i></span>
                                <div>{{ __('qrlanding.product1_feature3')}}</div>
                            </li>
                        </ul>
                        <a href="{{ route('newrestaurant.register') }}" class="btn btn-primary">{{ __('qrlanding.product1_button')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-5">
                <div class="card shadow-soft border-light">
                    <div class="card-header p-0">
                        <img src="{{ asset('impactfront') }}/img/qr_image_builder.jpg" class="card-img-top rounded-top" alt="image">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title mt-3">{{ __('qrlanding.product2_title') }}</h3>
                        <p class="card-text">{{ __('qrlanding.product2_subtitle') }}</p>
                        <ul class="list-group d-flex justify-content-center mb-4">
                            <li class="list-group-item d-flex pl-0 pb-1">
                                <span class="mr-2"><i class="fas fa-check-circle text-success"></i></span>
                                <div>{{ __('qrlanding.product2_feature1')}}</div>
                            </li>
                            <li class="list-group-item d-flex pl-0 pb-1">
                                <span class="mr-2"><i class="fas fa-check-circle text-success"></i></span>
                                <div>{{ __('qrlanding.product2_feature2')}}</div>
                            </li>
                            <li class="list-group-item d-flex pl-0 pb-1">
                                <span class="mr-2"><i class="fas fa-check-circle text-success"></i></span>
                                <div>{{ __('qrlanding.product2_feature3')}}</div>
                            </li>
                        </ul>
                        <a href="{{ route('newrestaurant.register') }}" class="btn btn-primary">{{ __('qrlanding.product2_button')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-5">
                <div class="card shadow-soft border-light">
                    <div class="card-header p-0">
                        <img src="{{ asset('impactfront') }}/img/mobile_pwa.jpg" class="card-img-top rounded-top" alt="image">
                    </div>
                    <div class="card-body">
                    <h3 class="card-title mt-3">{{ __('qrlanding.product3_title')}}</h3>
                    <p class="card-text">{{ __('qrlanding.product3_subtitle')}}</p>
                        <ul class="list-group d-flex justify-content-center mb-4">
                            <li class="list-group-item d-flex pl-0 pb-1">
                                <span class="mr-2"><i class="fas fa-check-circle text-success"></i></span>
                            <div>{{ __('qrlanding.product3_feature1')}}</div>
                            </li>
                            <li class="list-group-item d-flex pl-0 pb-1">
                                <span class="mr-2"><i class="fas fa-check-circle text-success"></i></span>
                                <div>{{ __('qrlanding.product3_feature2')}}</div>
                            </li>
                            <li class="list-group-item d-flex pl-0 pb-1">
                                <span class="mr-2"><i class="fas fa-check-circle text-success"></i></span>
                                <div>{{ __('qrlanding.product3_feature3')}}</div>
                            </li>
                        </ul>
                        <a href="{{ route('newrestaurant.register') }}" class="btn btn-primary">{{ __('qrlanding.product3_button')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
