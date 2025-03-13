<section class="ftco-section ftco-services ftco-no-pt" id="services">
    <div class="container">
        <div class="row">

            {{-- Fruit Prices --}}
            <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                <div class="services">
                    <div class="p-4">
                        <div class="media-body">
                            <h3 class="heading mb-3">{{ __('messages.fruit_prices') }}</h3>
                            <p>{{ __('messages.fruit_description') }}</p>
                        </div>
                    </div>
                    <div class="img" style="background-image: url(images/fruits_bg.jpg);">
                        <a href="{{ route('fruits.index') }}"
                            class="btn-custom d-flex align-items-center justify-content-center"><span
                                class="fa fa-chevron-right"></span></a>
                    </div>
                </div>
            </div>

            {{-- Vegetable Prices --}}
            <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                <div class="services">
                    <div class="p-4">
                        <div class="media-body">
                            <h3 class="heading mb-3">{{ __('messages.vegetable_prices') }}</h3>
                            <p>{{ __('messages.vegetable_description') }}</p>
                        </div>
                    </div>
                    <div class="img" style="background-image: url(images/services-1.jpg);">
                        <a href="{{ route('vegetables.index') }}"
                            class="btn-custom d-flex align-items-center justify-content-center"><span
                                class="fa fa-chevron-right"></span></a>
                    </div>
                </div>
            </div>

            {{-- Economic Centers --}}
            <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                <div class="services">
                    <div class="p-4">
                        <div class="media-body">
                            <h3 class="heading mb-3">{{ __('messages.economic_centers') }}</h3>
                            <p>{{ __('messages.economic_description') }}</p>
                        </div>
                    </div>
                    <div class="img" style="background-image: url(images/ecenter.jpg);">
                        <a href="#"
                            class="btn-custom d-flex align-items-center justify-content-center"><span
                                class="fa fa-chevron-right"></span></a>
                    </div>
                </div>
            </div>

            {{-- Crop Advices --}}
            <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                <div class="services">
                    <div class="p-4">
                        <div class="media-body">
                            <h3 class="heading mb-3">{{ __('messages.crop_advices') }}</h3>
                            <p>{{ __('messages.crop_description') }}</p>
                        </div>
                    </div>
                    <div class="img" style="background-image: url(images/services-3.jpg);">
                        <a href="#"
                            class="btn-custom d-flex align-items-center justify-content-center"><span
                                class="fa fa-chevron-right"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
