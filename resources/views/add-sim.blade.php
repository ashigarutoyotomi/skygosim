@extends('layouts.app')

@section('content')
    <header-comp
        title="Add Sim Card"
    ></header-comp>

    <section class="ls s-py-80 s-py-lg-120 s-py-xl-160 c-gutter-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 animate" data-animation="scaleAppear">
                    <h5 class="text-center text-md-left special-heading">
                        join us today<br>
                        <span class="text-uppercase">Add Your Sim Card</span>
                    </h5>

                    <div class="divider-50 d-none d-xl-block"></div>

                    <form class="contact-form c-mb-10 c-mb-md-20 c-gutter-20 text-center text-md-left">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group has-placeholder">
                                    <label for="iccid">ICCID</label>
                                    <input
                                        type="text"
                                        aria-required="true"
                                        size="30"
                                        name="iccid"
                                        id="iccid"
                                        class="form-control"
                                        placeholder="ICCID"
                                    >
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <div class="form-group has-placeholder">
                                    <label for="code">Code</label>
                                    <input
                                        type="text"
                                        aria-required="true"
                                        size="30"
                                        name="code"
                                        id="code"
                                        class="form-control"
                                        placeholder="Code"
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">I agree that my submitted data is being collected and stored.</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 text-center text-md-left mt-30">

                                <div class="form-group">
                                    <button
                                        type="submit"
                                        id="contact_form_submit"
                                        name="contact_submit"
                                        class="btn btn-maincolor"
                                    >
                                        <span>Add Sim</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="col-lg-8 animate" data-animation="scaleAppear">
                    <img src="/images/how-to-add-sim.png" alt="">
                </div>

            </div>
        </div>
    </section>

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
                        <h3>No SIM? No ICCID?</h3>
                        <h6 class="fw-500 font-italic">
                            Choose between a physical SIM and e-sim
                        </h6>

                        <div class="d-none d-lg-block divider-20"></div>

                        <a
                            href="/checkout/physical-sim"
                            class="btn btn-maincolor"
                        >
                            <span>Phisical SIM</span>
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
