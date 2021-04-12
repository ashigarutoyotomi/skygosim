<template>
    <div id="home">
        <header-slider />

        <section class="ls s-pt-75 s-pb-80 s-pb-lg-100 about-section text-center text-lg-left">
            <div class="d-none d-lg-block divider-10"></div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-6 order-2 order-lg-1">
                        <div class="d-none d-lg-block divider-20"></div>
                        <div class="item-content">
                            <h3>eSIM Instant Connections</h3>

                            <p>
                                A contactless solution to a physical SIM card, you can now install SkyGo’s eSIM on your device to access seamless worldwide data coverage.
                                <br>
                                You'll never be confused by a plethora of SIM cards again when you can manage your data and plans directly on your own device.
                            </p>

                            <div class="d-none d-lg-block divider-20"></div>

                            <a
                                href="/e-sim/order"
                                class="btn btn-maincolor2"
                            >
                                <span>E-SIM</span>
                            </a>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 order-1 order-lg-2">
                        <div class="">
                            <img src="/images/cellular-connectivity.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="ls s-pt-40 s-pb-50 s-pt-lg-120 s-pb-lg-90 s-pt-xl-160 s-pb-xl-130 c-mb-30 service-page2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h3 class="text-center">Mobile Data Around the world</h3>
                        <h4>Worldwide Data Plans</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="icon-box rounded text-center hero-bg">
                            <a href="service-single.html">
                                <img src="/images/icon-4.png" alt="">
                            </a>
                            <h5>
                                One world. One SIM. One operator.
                            </h5>
                            <p>
                                With SkyGo Global SIM, you can travel without roaming fees or changing SIM cards. This is What the future of mobile looks like. There is no contract required, just purchase the package plan you need and you are ready to go.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="icon-box rounded text-center hero-bg">
                            <a href="service-single.html">
                                <img src="/images/icon-1.png" alt="">
                            </a>
                            <h5>
                                The Future is Digital
                            </h5>
                            <p>
                                No more long contracts, no more expensive roaming fees.
                                150+ countries included. Install the digital SkyGo e-SIM for only $1 to get started.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="icon-box rounded text-center hero-bg">
                            <a href="service-single.html">
                                <img src="/images/icon-2.png" alt="">
                            </a>
                            <h5>
                                No packaging or waste
                            </h5>
                            <p>
                                eSIM aren't just easier -- they're greener too! Everything is electronic, so you can travel light and leave no trace.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ls s-pt-75 s-pb-80 s-pb-lg-100 about-section text-center text-lg-left">
            <div class="d-none d-lg-block divider-10"></div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-6 order-2 order-lg-1">
                        <div class="">
                            <img src="/images/mobile-apps.svg" alt="">
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 order-1 order-lg-2">
                        <div class="d-none d-lg-block divider-20"></div>
                        <div class="item-content">
                            <h3>No tools required</h3>

                            <p>
                                No tools required, no physical SIM to manage
                                When you're traveling, the last thing you need to worry about is where you left your SIM card.
                                <br>
                                Keep your carrier SIM in place, leave your tools at home, and roam freely with your Dual SIM device.
                            </p>

                            <div class="d-none d-lg-block divider-20"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</template>

<script>
    import HeaderSlider from "../../components/HeaderSlider";
    import InternetPackages from "../../components/InternetPackages";

    export default {
        name: "HomeIndex",

        components: {
            HeaderSlider,
            InternetPackages
        },

        props: {
            internetPackages: {
                type: Object,
                default() {
                    return null;
                }
            }
        },
    }
</script>

<style lang="scss">
    #home {
        .how-add-sim {
            background-image: linear-gradient(to top, #fcc5e4 0%, #fda34b 15%, #ff7882 35%, #c8699e 52%, #7046aa 71%, #0c1db8 87%, #020f75 100%);
        }

        .how-e-sim {
            background-image: linear-gradient(to top, #3f51b1 0%, #5a55ae 13%, #7b5fac 25%, #8f6aae 38%, #a86aa4 50%, #cc6b8e 62%, #f18271 75%, #f3a469 87%, #f7c978 100%);
        }
    }
</style>
