@extends('layouts.app')

@section('content')
    <header-comp
        title="How to"
    ></header-comp>

    <section class="order-sim ls s-pt-75 s-pb-80 s-pb-lg-100 about-section text-center text-lg-left">
        <div class="d-none d-lg-block divider-10"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6 order-2 order-lg-1">
                    <div class="about-image">
                        <img src="/images/about-image.png" alt="">
                    </div>
                </div>

                <div class="col-12 col-lg-6 order-1 order-lg-2">
                    <div class="d-none d-lg-block divider-20"></div>
                    <div class="item-content">
                        <h3>One world. One SIM. One operator.</h3>
                        <h4>With SkyGo Global SIM, you can travel without roaming fees or changing SIM cards.</h4>
                        <p>What the future of mobile looks like. There is no contract required, just purchase the package plan you need and you are ready to go.</p>
                        <h4>Don't have SKYGO SIM yet?</h4>
                        <h6 class="fw-500 font-italic">
                            ORDER NOW, do you want a physical SIM? or an eSIM?
                        </h6>

                        <div class="d-none d-lg-block divider-20"></div>

                        <a
                            href="/physical-sim/order"
                            class="btn btn-maincolor"
                        >
                            <span>Physical SIM</span>
                        </a>
                        <a
                            href="/e-sim/order"
                            class="btn btn-maincolor2"
                        >
                            <span>E-SIM</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="how-add-sim gradientBg1 ds s-pt-80 s-pb-20 s-pt-lg-130 s-pb-lg-70 s-pt-xl-160 s-pb-xl-100 c-gutter-60 c-mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h3 class="text-center">Already have a SIM? <br> Do you know your ICCID?</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6 col-md-6 animate" data-animation="fadeInUp">
                    <div class="icon-box text-center">
                        <div class="image-styled">
                            <img alt="" src="/images/icon-1.png">
                        </div>
                        <h5>
                            Add SIM
                        </h5>
                    </div>
                </div><!-- .col-* -->
                <div class="col-xl-6 col-md-6 animate" data-animation="fadeInUp">
                    <div class="icon-box text-center">
                        <div class="image-styled">
                            <img alt="" src="/images/icon-2.png">
                        </div>

                        <h5>
                            Select a desired region
                        </h5>
                    </div>
                </div><!-- .col-* -->
                <div class="col-xl-6 col-md-6 animate" data-animation="fadeInUp">
                    <div class="icon-box text-center">
                        <div class="image-styled">
                            <img alt="" src="/images/icon-3.png">
                        </div>

                        <h5>
                            Select a desired package
                        </h5>
                    </div>
                </div><!-- .col-* -->
                <div class="col-xl-6 col-md-6 animate" data-animation="fadeInUp">
                    <div class="icon-box text-center">
                        <div class="image-styled">
                            <img alt="" src="/images/icon-4.png">
                        </div>

                        <h5>
                            Checkout
                        </h5>
                    </div>
                </div><!-- .col-* -->
                <div class="d-none d-lg-block divider-small"></div>
            </div>
        </div>
    </section>

    <section class="how-physical-sim ls s-pt-40 s-pb-50 s-pt-lg-120 s-pb-lg-90 s-pt-xl-160 s-pb-xl-130 c-mb-30 service-page2">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h3 class="text-center">Physical SIM</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 col-12">
                    <div class="icon-box rounded text-center hero-bg">
                        <img src="/images/icon-4.png" alt="">
                        <h5>
                            Purchase physical SIM
                        </h5>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="icon-box rounded text-center hero-bg">
                        <img src="/images/icon-1.png" alt="">
                        <h5>
                            Cost of physical SIM  $2
                        </h5>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="icon-box rounded text-center hero-bg">
                        <img src="/images/icon-2.png" alt="">
                        <h5>
                            Cost of shipping  $5
                        </h5>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="icon-box rounded text-center hero-bg">
                        <img src="/images/icon-3.png" alt="">
                        <h5>
                            Enter your shipping details
                        </h5>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="icon-box rounded text-center hero-bg">
                        <img src="/images/icon-1.png" alt="">
                        <h5>
                            Checkout
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="how-e-sim gradientBg2 ds s-pt-80 s-pb-20 s-pt-lg-130 s-pb-lg-70 s-pt-xl-160 s-pb-xl-100 c-gutter-60 c-mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2" id="price">
                    <h3 class="text-center">E-SIM</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-4 col-md-6 animate" data-animation="fadeInUp">
                    <div class="icon-box text-center">
                        <div class="image-styled">
                            <img alt="" src="/images/icon-1.png">
                        </div>
                        <h5>
                            Purchase e-sim
                        </h5>
                    </div>
                </div><!-- .col-* -->
                <div class="col-xl-4 col-md-6 animate" data-animation="fadeInUp">
                    <div class="icon-box text-center">
                        <div class="image-styled">
                            <img alt="" src="/images/icon-2.png">
                        </div>

                        <h5>
                            We will send a QR code to your e-mail
                        </h5>
                    </div>
                </div><!-- .col-* -->
                <div class="col-xl-4 col-md-6 animate" data-animation="fadeInUp">
                    <div class="icon-box text-center">
                        <div class="image-styled">
                            <img alt="" src="/images/icon-3.png">
                        </div>

                        <h5>
                            On your phone  “Add new cellular plan”
                        </h5>
                    </div>
                </div><!-- .col-* -->
                <div class="col-xl-4 col-md-6 animate" data-animation="fadeInUp">
                    <div class="icon-box text-center">
                        <div class="image-styled">
                            <img alt="" src="/images/icon-4.png">
                        </div>

                        <h5>
                            Scan the QR code
                        </h5>
                    </div>
                </div><!-- .col-* -->
                <div class="col-xl-4 col-md-6 animate" data-animation="fadeInUp">
                    <div class="icon-box text-center">
                        <div class="image-styled">
                            <img alt="" src="/images/icon-5.png">
                        </div>
                        <h5>
                            Check your ICCID
                        </h5>
                    </div>
                </div><!-- .col-* -->
                <div class="col-xl-4 col-md-6 animate" data-animation="fadeInUp">
                    <div class="icon-box text-center">
                        <div class="image-styled">
                            <img alt="" src="/images/icon-5.png">
                        </div>
                        <h5>
                            Come back to our website
                            <a href="/">link</a>
                            enter your ICCID
                        </h5>
                    </div>
                </div><!-- .col-* -->
                <div class="col-xl-12 col-md-6 animate" data-animation="fadeInUp">
                    <div class="icon-box text-center">
                        <div class="image-styled">
                            <img alt="" src="/images/icon-5.png">
                        </div>
                        <h5>
                            Continue shopping packages
                        </h5>
                    </div>
                </div><!-- .col-* -->
                <div class="d-none d-lg-block divider-small"></div>
            </div>
        </div>
    </section>
@endsection
