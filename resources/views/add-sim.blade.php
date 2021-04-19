@extends('layouts.app')

@section('content')
    <header-comp
        title="Add Sim Card"
    ></header-comp>

    <add-sim-index></add-sim-index>

    <section class="ls s-pt-75 s-pb-80 s-pb-lg-100 about-section text-center text-lg-left">
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
                        <h4>Don't have SKYGO SIM yet?</h4>
                        <h6 class="fw-500 font-italic">
                            ORDER NOW, do you want a physical SIM? or an eSIM?
                        </h6>

                        <div class="d-none d-lg-block divider-20"></div>

                        <a
                            href="/checkout/physical-sim"
                            class="btn btn-maincolor"
                        >
                            <span>Physical SIM</span>
                        </a>
                        <a
                            href="/checkout/e-sim"
                            class="btn btn-maincolor2"
                        >
                            <span>E-SIM</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
