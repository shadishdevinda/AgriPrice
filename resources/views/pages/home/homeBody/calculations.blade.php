<section class="ftco-section ftco-counter img" id="section-counter"
        style="background-image: url(images/bg_2.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 d-flex counter-wrap ftco-animate">
                    <div class="block-18 mb-xl-0 mb-2 d-flex align-items-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="flaticon-agriculture-1"></span>
                        </div>
                        <div class="text pl-3">
                            <strong class="number" data-number="{{ $vegetableCount }}">0</strong>
                            <span>{{ __('messages.vegetables') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex counter-wrap ftco-animate">
                    <div class="block-18 mb-xl-0 mb-2 d-flex align-items-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="flaticon-agriculture"></span>
                        </div>
                        <div class="text pl-3">
                            <strong class="number" data-number="{{ $fruitCount }}">0</strong>
                            <span>{{ __('messages.fruits') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex counter-wrap ftco-animate">
                    <div class="block-18 mb-xl-0 mb-2 d-flex align-items-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="flaticon-agriculture-2"></span>
                        </div>
                        <div class="text pl-3">
                            <strong class="number" data-number="{{ $economicCenterCount }}">0</strong>
                            <span>{{ __('messages.economic_centers') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex counter-wrap ftco-animate">
                    <div class="block-18 mb-xl-0 mb-2 d-flex align-items-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="flaticon-approve"></span>
                        </div>
                        <div class="text pl-3">
                            <strong class="number" data-number="{{ $cropAdviceCount }}">0</strong>
                            <span>{{ __('messages.crop_advices') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
