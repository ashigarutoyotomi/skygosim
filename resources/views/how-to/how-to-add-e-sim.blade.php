@extends('layouts.app')

@section('content')
    <header-comp
        title="How to add e-sim"
    ></header-comp>

    <section class="ls s-pt-50 s-pb-50 s-pt-lg-60 s-pb-lg-90 s-pt-xl-80 s-pb-xl-60 c-gutter-30 c-mb-30 service-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h1 class="text-center">eSIM Service</h1>
                    <p class="text-center big">
                        An eSIM is a digital SIM that allows you to activate SkyGo Global
                        Data SIM network without having to use a physical SIM.
                        Purchase now to experience our eSIM service!
                    </p>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-12 col-lg-6 order-2 order-lg-1">
                    <div class="about-image">
                        <img src="/images/how-to-1.gif" alt="">
                    </div>
                </div>

                <div class="col-12 col-lg-6 order-1 order-lg-2">
                    <div class="d-none d-lg-block divider-20"></div>
                    <div class="item-content">
                        <h3>How to purchase eSIM service</h3>
                        <p class="big">
                            1. Choose the desired package in Store
                        </p>
                        <p class="big">
                            2. Check out with additional Global Data SIM and eSIM
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ls s-py-70 s-py-lg-80 s-py-xl-90">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4>Compatible Devices</h4>
                    <ul class="list1">
                        <li>
                            iPhones purchased from countries outside China
                        </li>
                        <li>
                            iPhone XR, iPhone XS, iPhone XS Max, iPhone 11, iPhone Pro, iPhone 11 Pro Max, iPhone SE2020
                        </li>
                        <li>
                            iPhones purchased in Hong Kong/Macao SAR - iPhone SE2020, iPhone XS
                        </li>
                        <li>
                            Samsung Fold LTE model
                        </li>
                        <li>
                            Samsung Galaxy Z Flip
                        </li>
                        <li>
                            Google Pixel 3 and 3XL ( Limited support )
                        </li>
                        <li>
                            Google Pixel 4
                        </li>
                        <li>
                            Huawei P40 (purchased outside mainland China)
                        </li>
                        <li>
                            Huawei P40 Pro (purchased outside mainland China)
                        </li>
                    </ul>

                    <p>
                        iPhones purchased from mainland China do not support eSIM.
                    </p>

                    <a class="text-primary" href="/packages">
                        Purchase eSIM package now
                    </a>

                    {{--                    <h4>Disclaimer</h4>--}}
                    {{--                    <p>Nam ligula metus, hendrerit tempor orci posuere, lobortis euismod tortor. Quisque porttitor, orci at ultricies gravida, dolor leo ornare tellus, sit amet semper lorem nunc pretium nulla. Aenean placerat finibus est, nec ultricies tellus lacinia quis. Nam nisi purus, pulvinar eu suscipit eu, pellentesque eu tortor. Sed quis dignissim eros. Cras a nisl pharetra, vehicula lorem vitae, gravida nunc. Nulla placerat maximus.</p>--}}
                    {{--                    <ul class="list1">--}}
                    {{--                        <li>--}}
                    {{--                            Duis nec magna dignissim nisi finibus mollis.--}}
                    {{--                        </li>--}}
                    {{--                        <li>--}}
                    {{--                            Donec tristique sagittis accumsan. Mauris eleifend blandit porttitor.--}}
                    {{--                        </li>--}}
                    {{--                        <li>--}}
                    {{--                            Vivamus ac euismod diam, dignissim venenatis est.--}}
                    {{--                        </li>--}}
                    {{--                        <li>--}}
                    {{--                            Cras dictum, mi a tincidunt suscipit, turpis ex pulvinar mi, sit amet.--}}
                    {{--                        </li>--}}
                    {{--                    </ul>--}}
                    {{--                    <h4>Our Privacy Policy</h4>--}}
                    {{--                    <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque pulvinar tellus quis porttitor fringilla. Etiam in libero vel justo eleifend viverra. Nulla tincidunt nisl sed diam egestas fermentum. Donec egestas enim nec finibus semper. Donec sed massa ut enim facilisis porta vel nec urna. Duis fringilla sagittis tortor vitae pulvinar. Curabitur in rhoncus tortor. Ut tempor sapien at nibh porta, sit amet interdum turpis suscipit. Nulla eget sem condimentum nunc tincidunt congue eget in metus. Vivamus efficitur dapibus lorem in cursus. Suspendisse pulvinar et est vel blandit. Quisque et lacinia justo. Nam ultricies massa sed facilisis scelerisque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>--}}
                    {{--                    <h4>Liability Limitation</h4>--}}
                    {{--                    <p>Vestibulum nulla ante, dignissim eu mauris at, fringilla dictum lectus. Praesent congue porta porta. Aliquam sed varius nisi. Nullam quis mauris feugiat, cursus eros et, porttitor lorem. Pellentesque vitae arcu at arcu facilisis scelerisque. Donec blandit purus nec efficitur efficitur. Nulla et justo quis ipsum gravida maximus. Pellentesque congue sem eu arcu egestas, vel imperdiet est pharetra. </p>--}}
                    {{--                    <ul class="list1">--}}
                    {{--                        <li>--}}
                    {{--                            Suspendisse imperdiet ligula orci, vitae suscipit.--}}
                    {{--                        </li>--}}
                    {{--                        <li>--}}
                    {{--                            Pellentesque sagittis faucibus mi. Duis placerat.--}}
                    {{--                        </li>--}}
                    {{--                    </ul>--}}
                    {{--                    <p>Pellentesque ut semper elit. Curabitur ut neque sed tellus porttitor tristique non vitae erat. Sed maximus ullamcorper fringilla. Duis eget sem eu augue hendrerit consequat et at nibh. Proin non dolor arcu. In at leo vel arcu varius ultricies. Suspendisse leo nunc, maximus et pellentesque vel, porttitor id est. Cras luctus risus malesuada risus elementum, sit amet pellentesque lectus aliquet.</p>--}}
                </div>
            </div>

            <div class="row py-50">
                <div class="col-12">
                    <h3>Download eSIM profile to handset</h3>
                    <p class="big">
                        After purchasing eSIM service, you will receive an email with QR code.
                        Please use handset which supports eSIM and follow the instruction to
                        download the eSIM profile. Please note each eSIM can only download in one
                        handset for maximum 10 times.
                    </p>
                    <div class="d-none d-lg-block divider-50"></div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="item-content">
                        <h3>IOS</h3>
                        <ul class="list1">
                            <li>
                                In “Settings”, select “Mobile Data”
                            </li>
                            <li>
                                Select “Add Data Plan”
                            </li>
                            <li>
                                Scan QR code
                            </li>
                            <li>
                                After downloaded the eSIM profile, the SIM can be activated after some basic settings
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="d-flex">
                        <img class="w-50" src="/images/how-to-ios-1.png" alt="">
                        <img class="w-50" src="/images/how-to-ios-2.png" alt="">
                    </div>
                    <div class="d-flex">
                        <img class="w-50" src="/images/how-to-ios-3.png" alt="">
                        <img class="w-50" src="/images/how-to-ios-4.png" alt="">
                    </div>
                </div>

                <div class="d-none d-lg-block divider-50"></div>

                <div class="col-12 col-lg-6">
                    <div class="d-flex">
                        <img class="w-50" src="/images/how-to-android-1.png" alt="">
                        <img class="w-50" src="/images/how-to-android-2.png" alt="">
                    </div>
                    <div class="d-flex">
                        <img class="w-50" src="/images/how-to-android-3.png" alt="">
                        <img class="w-50" src="/images/how-to-android-4.png" alt="">
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="item-content">
                        <h3>Android</h3>

                        <ul class="list1">
                            <li>
                                In “Settings”, select “Network and Internet”
                            </li>
                            <li>
                                Select “Mobile network”
                            </li>
                            <li>
                                Select “Download a SIM instead?”
                            </li>
                            <li>
                                Scan QR code to download eSIM profile
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="d-none d-lg-block divider-50"></div>

                <div class="col-12">
                    <p>
                        (Display name and steps may be different, depending on the phone model and OS system version.)
                    </p>
                    <p>
                        Due to eSIM is a new technology, certain handsets may face problems with hotspot sharing using eSIM. If you have difficulties on hotspot sharing, please refer to FAQ. If the problem persists, please contact our Customer Service team.
                    </p>
                    <a href="/packages" class="text-primary">
                        Purchase eSIM package now
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
