@extends('layouts.app')

@section('content')
    <header-comp
        title="FAQ"
    ></header-comp>

    <section class="ls s-py-80 s-py-lg-80 s-py-xl-80">
        <div class="container">
            <div class="row py-50">
                <div class="col-lg-8 offset-lg-2">
                    <h1 class="text-center">Product Introduction</h1>
                    <p class="text-center big">
                        SkyGo Global data SIM is a reusable SIM card.
                        You don’t need to switch local SIM card or carry other MiFi devices,
                        only need to subscribe different combinations of data packages and can
                        access internet in over 100 destinations.
                    </p>
                    <p class="text-center big">
                        Before your next trip or when you need to use mobile data abroad,
                        you just subscribe data package from the SkyGo Global Data SIM APP
                        or website in the same card, and enjoy the data service.
                    </p>
                </div>
            </div>
            <div class="row py-50">
                <div class="col-lg-8 offset-lg-2">
                    <h3 class="text-center">How to activate package</h3>
                    <p class="text-center big">
                        1. Insert SIM card into mobile after arrival <br>
                        2. Switch on Mobile Data and Data Roaming <br>
                        3. Enjoy the service <br>
                    </p>
                </div>
            </div>
            <div class="row py-50">
                <div class="col-lg-8 offset-lg-2">
                    <h3 class="text-center">How to top up data package packages</h3>
                    <p class="text-center big">
                        1. Bind SIM card <br>
                        2. Subscribe to Data Package <br>
                        3. Make Payment <br>
                    </p>
                </div>
            </div>

            <div id="accordion01" class="py-50" role="tablist">
                <div class="card">
                    <div class="card-header" role="tab" id="collapse01_header">
                        <h5>
                            <a data-toggle="collapse" href="#collapse01" aria-expanded="true" aria-controls="collapse01">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                What is Global Data SIM?
                            </a>
                        </h5>
                    </div>

                    <div id="collapse01" class="collapse show" role="tabpanel" aria-labelledby="collapse01_header" data-parent="#accordion01">
                        <div class="card-body">
                            <p>
                                SkyGo Global Data SIM is a global internet product launched by Global Travel Telecom (GTT).
                                There are 2 card types for Global Data SIM, includes physical SIM and eSIM.
                                Physical SIM is a 3-in-1 SIM card that supports nano, micro and normal formats.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" role="tab" id="collapse02_header">
                        <h5>
                            <a class="collapsed" data-toggle="collapse" href="#collapse02" aria-expanded="false" aria-controls="collapse02">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                Does SkyGo Global Data SIM support voice call and SMS ?
                            </a>
                        </h5>
                    </div>
                    <div id="collapse02" class="collapse" role="tabpanel" aria-labelledby="collapse02_header" data-parent="#accordion01" style="">
                        <div class="card-body">
                            <p>
                                SkyGo Global Data SIM supports data service only. It does not support voice call and SMS.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" role="tab" id="collapse03_header">
                        <h5>
                            <a class="collapsed" data-toggle="collapse" href="#collapse03" aria-expanded="false" aria-controls="collapse03">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                What is the coverage of the SkyGo Global Data SIM?
                            </a>
                        </h5>
                    </div>
                    <div id="collapse03" class="collapse" role="tabpanel" aria-labelledby="collapse03_header" data-parent="#accordion01">
                        <div class="card-body">
                            <p>
                                SkyGo Global Data SIM can access applications like Google, Facebook etc.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" role="tab" id="collapse04_header">
                        <h5>
                            <a class="collapsed" data-toggle="collapse" href="#collapse04" aria-expanded="false" aria-controls="collapse04">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                Does SkyGo Global Data SIM support application like Google Maps?
                            </a>
                        </h5>
                    </div>
                    <div id="collapse04" class="collapse" role="tabpanel" aria-labelledby="collapse04_header" data-parent="#accordion01">
                        <div class="card-body">
                            <p>
                                SkyGo Global Data SIM can access applications like Google, Facebook etc.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" role="tab" id="collapse05_header">
                        <h5>
                            <a class="collapsed" data-toggle="collapse" href="#collapse05" aria-expanded="false" aria-controls="collapse05">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                What type of devices does SkyGo Global Data SIM support?
                            </a>
                        </h5>
                    </div>
                    <div id="collapse05" class="collapse" role="tabpanel" aria-labelledby="collapse05_header" data-parent="#accordion01">
                        <div class="card-body">
                            <p>
                                SkyGo Global Data SIM is applicable to devices which support OTA standard,
                                including majority mobile phones (except those old models phones),
                                Apple iPAD which supports cellular, and some MiFi devices
                                (requires individual testing. Models with positive result includes Huawei
                                MiFi E5885, E5577Bs-937).
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" role="tab" id="collapse06_header">
                        <h5>
                            <a class="collapsed" data-toggle="collapse" href="#collapse06" aria-expanded="false" aria-controls="collapse06">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                How do I access internet after I arrived to my destination ?
                            </a>
                        </h5>
                    </div>
                    <div id="collapse06" class="collapse" role="tabpanel" aria-labelledby="collapse06_header" data-parent="#accordion01">
                        <div class="card-body">
                            <p>
                                After arrived destination, please insert SIM in mobile phone and wait
                                for a few minutes, the network will be selected automatically.
                                Normally you don’t have to do manual setup, but please manual select
                                the operator if you can’t access internet.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" role="tab" id="collapse07_header">
                        <h5>
                            <a class="collapsed" data-toggle="collapse" href="#collapse07" aria-expanded="false" aria-controls="collapse07">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                Do I need to manually active the SIM?
                            </a>
                        </h5>
                    </div>
                    <div id="collapse07" class="collapse" role="tabpanel" aria-labelledby="collapse07_header" data-parent="#accordion01">
                        <div class="card-body">
                            <p>
                                The default activation mode is auto. That means when you arrived destination, the data package can be activated after you insert the SIM in phone. However, since there are Multi regional data packages, in order to facilitate customers who purchased these packages, we provide the manual activation mode option for customers. (For example, a customer in Hong Kong purchased Multi regional package and wants to use outside Hong Kong, the data package will be activated when customer inserts the SIM in phone under auto mode.) If the customer choose manual activation mode, customer has to access official website to manual activate data package after arrived the destination.By default, Global Data SIM does not need to manual activate, you just need to switch on the roaming function and the data package will be activated automatically.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" role="tab" id="collapse08_header">
                        <h5>
                            <a class="collapsed" data-toggle="collapse" href="#collapse08" aria-expanded="false" aria-controls="collapse08">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                How to calculate the data usage time after activation?
                            </a>
                        </h5>
                    </div>
                    <div id="collapse08" class="collapse" role="tabpanel" aria-labelledby="collapse08_header" data-parent="#accordion01">
                        <div class="card-body">
                            <p>
                                Package will be counting continuously once activated. Every 24 hours will be counted as 1 day. If the customer arrived Hong Kong and use data starting from 1 January 2019 07:38, and the Hong Kong 1 day data package is activated. The customer can access internet in Hong Kong until 2 January 2019 07:37.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" role="tab" id="collapse09_header">
                        <h5>
                            <a class="collapsed" data-toggle="collapse" href="#collapse09" aria-expanded="false" aria-controls="collapse09">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                Is there any daily speed limitation after data package activated?
                            </a>
                        </h5>
                    </div>
                    <div id="collapse09" class="collapse" role="tabpanel" aria-labelledby="collapse09_header" data-parent="#accordion01">
                        <div class="card-body">
                            <p>
                                There are 2 types of SkyGo Global Data SIM product, limited speed unlimited data product and fixed data product. For limited speed unlimited data product, there is 500MB daily high speed data usage, thereafter unlimited restricted speed data usage with speed 768kbps (384kbps for upstream and downstream). After the speed is restricted, high speed data will be reset at 00:00 on the next day (Europe destinations reset at 08:00 Beijing time, while other destinations rest at 00:00 Beijing time). Customer can resume high speed internet access.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" role="tab" id="collapse10_header">
                        <h5>
                            <a class="collapsed" data-toggle="collapse" href="#collapse10" aria-expanded="false" aria-controls="collapse10">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                How about if I am going from 1 destination to another within 24 hours after activated?
                            </a>
                        </h5>
                    </div>
                    <div id="collapse10" class="collapse" role="tabpanel" aria-labelledby="collapse10_header" data-parent="#accordion01">
                        <div class="card-body">
                            <p>
                                If the destination is within the package coverage, the data package will be continued automatically if you going from 1 destination to another within 24 hours. If the destination is not covered by the data package, you will not be able to access internet.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" role="tab" id="collapse11_header">
                        <h5>
                            <a class="collapsed" data-toggle="collapse" href="#collapse11" aria-expanded="false" aria-controls="collapse11">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                Why it shows 2G network after I inserted the SIM card in phone?
                            </a>
                        </h5>
                    </div>
                    <div id="collapse11" class="collapse" role="tabpanel" aria-labelledby="collapse11_header" data-parent="#accordion01">
                        <div class="card-body">
                            <p>
                                Please check whether the SIM is inserted in 3/4G network slot in phone.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" role="tab" id="collapse12_header">
                        <h5>
                            <a class="collapsed" data-toggle="collapse" href="#collapse12" aria-expanded="false" aria-controls="collapse12">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                What happens if I go to the destination that Global Data SIM does not support?
                            </a>
                        </h5>
                    </div>
                    <div id="collapse12" class="collapse" role="tabpanel" aria-labelledby="collapse12_header" data-parent="#accordion01">
                        <div class="card-body">
                            <p>
                                If you go to the destination that SkyGo Global Data SIM does not support, you can’t access internet.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" role="tab" id="collapse13_header">
                        <h5>
                            <a class="collapsed" data-toggle="collapse" href="#collapse13" aria-expanded="false" aria-controls="collapse13">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                Does it support personal hotspot?
                            </a>
                        </h5>
                    </div>
                    <div id="collapse13" class="collapse" role="tabpanel" aria-labelledby="collapse13_header" data-parent="#accordion01">
                        <div class="card-body">
                            <p>
                                SkyGo Global Data SIM supports personal hotspot sharing to other phone. However, in hotspot mode, the network speed may be lower than normal, and the daily high speed data will be consumed faster.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" role="tab" id="collapse14_header">
                        <h5>
                            <a class="collapsed" data-toggle="collapse" href="#collapse14" aria-expanded="false" aria-controls="collapse14">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                Why does my phone say “forbidden network” ?
                            </a>
                        </h5>
                    </div>
                    <div id="collapse14" class="collapse" role="tabpanel" aria-labelledby="collapse14_header" data-parent="#accordion01">
                        <div class="card-body">
                            <p>
                                Forbidden network is the network which doesn’t allow your sim card to register. If you have this problem after manually selecting network, please retry selecting network.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" role="tab" id="collapse15_header">
                        <h5>
                            <a class="collapsed" data-toggle="collapse" href="#collapse15" aria-expanded="false" aria-controls="collapse15">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                How to check data usage?
                            </a>
                        </h5>
                    </div>
                    <div id="collapse15" class="collapse" role="tabpanel" aria-labelledby="collapse15_header" data-parent="#accordion01">
                        <div class="card-body">
                            <p>
                                Please contact our CS team to check your data usage. Online self-check currently is not supported.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" role="tab" id="collapse16_header">
                        <h5>
                            <a class="collapsed" data-toggle="collapse" href="#collapse16" aria-expanded="false" aria-controls="collapse16">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                Can I use SIM Toolkit Application ?
                            </a>
                        </h5>
                    </div>
                    <div id="collapse16" class="collapse" role="tabpanel" aria-labelledby="collapse16_header" data-parent="#accordion01">
                        <div class="card-body">
                            <p>
                                SIM Toolkit Application is used to trouble shooting and updating V-IMSI manually when the V-IMSI isn’t updated automatically. But the toolkit would affect other functions on phone. Please consult our customer service before using it.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" role="tab" id="collapse17_header">
                        <h5>
                            <a class="collapsed" data-toggle="collapse" href="#collapse17" aria-expanded="false" aria-controls="collapse17">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                How about if I am going from 1 destination to another within 24 hours after activated?
                            </a>
                        </h5>
                    </div>
                    <div id="collapse17" class="collapse" role="tabpanel" aria-labelledby="collapse17_header" data-parent="#accordion01">
                        <div class="card-body">
                            <p>
                                If the destination is within the package coverage, the data package will be continued automatically if you going from 1 destination to another within 24 hours. If the destination is not covered by the data package, you will not be able to access internet.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" role="tab" id="collapse18_header">
                        <h5>
                            <a class="collapsed" data-toggle="collapse" href="#collapse18" aria-expanded="false" aria-controls="collapse18">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                How to manual set up APN?
                            </a>
                        </h5>
                    </div>
                    <div id="collapse18" class="collapse" role="tabpanel" aria-labelledby="collapse18_header" data-parent="#accordion01">
                        <div class="card-body">
                            <h5>iPhone</h5>
                            <ul>
                                <li>1. Go to [Settings]>[Mobile Data]</li>
                                <li>2. Open [Mobile Data Options]</li>
                                <li>3. Open [Mobile Data Network] and input APN (Please refer to the network operator list</li>
                                <li>4. Switch on [Data Roaming]</li>
                            </ul>
                            <h5>Android</h5>
                            <ul>
                                <li>1. Go to [Settings]>[Mobile Network]</li>
                                <li>2. Go to [APNs] > [New APN] and input name & APN (Please refer to the network operator list</li>
                                <li>3. Switch on [Data Roaming] > Click [Save]</li>
                            </ul>
                            <p>(Display name and steps may be different depending on the phone model and OS system version)</p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" role="tab" id="collapse19_header">
                        <h5>
                            <a class="collapsed" data-toggle="collapse" href="#collapse19" aria-expanded="false" aria-controls="collapse19">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                Why I only can access WeChat, cannot access other applications or internet?
                            </a>
                        </h5>
                    </div>
                    <div id="collapse19" class="collapse" role="tabpanel" aria-labelledby="collapse19_header" data-parent="#accordion01">
                        <div class="card-body">
                            <ul>
                                <li>Check whether the “Proxy” in the APN setting is blank</li>
                                <li>If there is VPN software in phone, it will affect internet access</li>
                                <li>Check whether the phone has set the permission to access internet for other application</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" role="tab" id="collapse20_header">
                        <h5>
                            <a class="collapsed" data-toggle="collapse" href="#collapse20" aria-expanded="false" aria-controls="collapse20">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                Why does my phone say ‘no SIM’ or ‘invalid SIM’ after inserting SIM card?
                            </a>
                        </h5>
                    </div>
                    <div id="collapse20" class="collapse" role="tabpanel" aria-labelledby="collapse20_header" data-parent="#accordion01">
                        <div class="card-body">
                            <p>
                                Global Data SIM is a 3-in-1 sim card, which can be used as standard, micro and nano sim. Please be gently when removing the sim card from the pack. Please follow below steps if your sim card cannot be detected by phone:
                            </p>
                            <ul>
                                <li>Restart your phone after inserting sim card;</li>
                                <li>Insert the sim card to another phone to retry;</li>
                                <li>If the problem still persists, please contact our Customer Service team.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" role="tab" id="collapse21_header">
                        <h5>
                            <a class="collapsed" data-toggle="collapse" href="#collapse21" aria-expanded="false" aria-controls="collapse21">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                Why does my phone say ‘no Service’?
                            </a>
                        </h5>
                    </div>
                    <div id="collapse21" class="collapse" role="tabpanel" aria-labelledby="collapse21_header" data-parent="#accordion01">
                        <div class="card-body">
                            <p>
                                Please follow below steps if your phone says ‘no Service’ after sim card is successfully detected:
                            </p>
                            <ul>
                                <li>Select Carrier manually in Network Selection Settings on phone;</li>
                                <li>If there is no carrier showed on network list, please insert the same sim cart to another phone to retry;</li>
                                <li>If the problem still persists, please contact our Customer Service team.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" role="tab" id="collapse22_header">
                        <h5>
                            <a class="collapsed" data-toggle="collapse" href="#collapse22" aria-expanded="false" aria-controls="collapse22">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                Why my data package cannot be activated?
                            </a>
                        </h5>
                    </div>
                    <div id="collapse22" class="collapse" role="tabpanel" aria-labelledby="collapse22_header" data-parent="#accordion01">
                        <div class="card-body">
                            <p>
                                The data package can be successfully activated if your phone performs a location update after inserting sim card. Hera some factors that may result in activation failure:
                            </p>
                            <ul>
                                <li> Your phone fails to perform a location update to the network operator due to sim card damage or no service;</li>
                                <li>Some built-in-phone global roaming service (e.g. Skytone on Huawei phone, Global Internet on Xiaomi phone, i-Roaming on VIVO phone) may prohibit your phone performing location update.</li>
                                <li>You have turn off ‘Automatic Activation’ when purchasing package;</li>
                                <li>You have set sim card mode as ‘Manual Mode’ in SIM card toolkit.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" role="tab" id="collapse23_header">
                        <h5>
                            <a class="collapsed" data-toggle="collapse" href="#collapse23" aria-expanded="false" aria-controls="collapse23">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                Why I cannot connect to the network after activating data package?
                            </a>
                        </h5>
                    </div>
                    <div id="collapse23" class="collapse" role="tabpanel" aria-labelledby="collapse23_header" data-parent="#accordion01">
                        <div class="card-body">
                            <p>
                                Please follow below steps:
                            </p>
                            <ul>
                                <li>Ensure your data roaming and cellular data is enable in network settings;</li>
                                <li>Ensure your APN settings are correct. For APN settings, please refer to our operator list.</li>
                                <li>If the problem still persists, please contact our Customer Service team.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" role="tab" id="collapse24_header">
                        <h5>
                            <a class="collapsed" data-toggle="collapse" href="#collapse24" aria-expanded="false" aria-controls="collapse24">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                Why is my mobile network so slow?
                            </a>
                        </h5>
                    </div>
                    <div id="collapse24" class="collapse" role="tabpanel" aria-labelledby="collapse24_header" data-parent="#accordion01">
                        <div class="card-body">
                            <p>
                                Many factors can result in slow mobile network. We suggest you to provide a detailed description of mobile network when checking with our CS team, such as network speed testing result, the screenshot of loading failure, etc. Here are some frequent factors and solutions of slow network:
                            </p>
                            <ul>
                                <li>There is no 4G network covered in your area. Please check the Operator List for 4G coverage.</li>
                                <li>4G service is disabled on phone. Please check mobile data settings and provide screenshot to our CS team.</li>
                                <li>Your data usage has exceeded daily High Speed Data Usage threshold. The data speed would be restricted.</li>
                                <li>The cellular network signal is weak at your location, especially in crowds, such as railway stations, stadium, Pedestrian Street, etc.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" role="tab" id="collapse25_header">
                        <h5>
                            <a class="collapsed" data-toggle="collapse" href="#collapse25" aria-expanded="false" aria-controls="collapse25">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                Why I cannot share hotspot with eSIM?
                            </a>
                        </h5>
                    </div>
                    <div id="collapse25" class="collapse" role="tabpanel" aria-labelledby="collapse25_header" data-parent="#accordion01">
                        <div class="card-body">
                            <p>
                                Due to different handset version, if you face hotspot sharing issue with your eSIM, please follow below steps:
                            </p>
                            <ul>
                                <li>Ensure your phone is not a contract or locked phone</li>
                                <li>Switch off the VPN</li>
                                <li>Switch on the data roaming</li>
                                <li>Set the eSIM as primary</li>
                                <li>Ensure the iOS latest version is installed (iOS13.6)</li>
                                <li>Use a physical SIM to connect to Internet, then switch on the personal hotspot function, then switch to connect Internet using eSIM. Please retry several times and restart handset.</li>
                                <li>If the problem still persists, please contact our Customer Service team.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="divider-15 d-none d-xl-block"></div>
    </section>
@endsection
