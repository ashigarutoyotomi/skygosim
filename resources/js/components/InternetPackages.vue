<template>
    <section
        id="internet-packages"
        class="ls s-pt-50 s-pb-50 s-pt-lg-120 s-pb-lg-90 s-pt-xl-160 s-pb-xl-130 c-gutter-30 c-mb-30 service-page"
    >
        <div class="container">

            <div class="row">
                <div class="col-lg-8 offset-lg-2" id="price">
                    <h5 class="special-heading text-center">Choose</h5>
                    <h1 class="text-center">Package</h1>
                    <p class="text-center big">Get ready for more potential, more opportunity and more of everything you expect from internet provider</p>
                </div>
            </div>

            <template
                v-if="internetPackages && !selectedCountry.length"
            >
                <div class="row">
                    <template
                        v-for="(internetPackage, area) in internetPackages"
                    >
                        <div class="col-lg-3 col-sm-6">
                            <div class="vertical-item rounded rounded-image-top hero-bg content-padding padding-small text-center h-full">
                                <div class="item-media">
                                    <img :src="`/images/regions/${getImgNameByArea(internetPackage[0].area_eng)}.jpg`" alt="">
                                    <div class="media-links">
                                        <a
                                            class="abs-link"
                                            href="#internet-packages"
                                            @click="chooseCountry(internetPackage)"
                                        ></a>
                                    </div>
                                </div>
                                <div class="item-content">
                                    <h5 class="service-title">
                                        <a
                                            href="#internet-packages"
                                            @click="chooseCountry(internetPackage)"
                                        >
                                            {{ area }}
                                        </a>
                                    </h5>

                                    <p>
                                        {{ internetPackages[area].length }} <br> Packages
                                    </p>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </template>

            <template v-if="internetPackages && sortedPackages.length">
                <div class="row mb-4">
                    <div class="col">
                        <button
                            type="button"
                            class="btn btn-white"
                            @click="backToAreas"
                        >
                            <span>Back</span>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <template v-for="internetPackage in sortedPackages">
                        <div class="col-lg-4 col-sm-6">
                            <div class="pricing-plan hero-bg rounded">
                                <div :class="`plan-name text-uppercase bg-maincolor${getRandomInt(1, 3)}`">
                                    <h3>
                                        {{ internetPackage.area_eng }}
                                    </h3>
                                </div>
                                <div class="plan-features">
                                    <ul class="list-bordered">
                                        <li>
                                            {{ internetPackage.destination_eng }}
                                        </li>
                                        <li>
                                            {{ internetPackage.data_eng }}
                                        </li>
                                        <li>
                                            {{ internetPackage.days }} Days
                                        </li>
                                    </ul>
                                </div>
                                <div class="price-wrap d-flex">
                                    <span class="plan-sign small-text">usd</span>
                                    <span class="plan-price color-main3">
                                        {{ internetPackage.gtt_price_usd }}
                                    </span>
                                </div>
                                <div class="plan-button">
                                    <button
                                        :class="`btn btn-maincolor${getRandomInt(1, 3)}`"
                                        @click="purchase(internetPackage)"
                                    >
                                        <span>Purchase</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </template>

        </div>
    </section>
</template>

<script>
    export default {
        name: "InternetPackages",

        props: {
            internetPackages: {
                type: Object,
                default() {
                    return null;
                }
            }
        },

        data() {
            return {
                selectedCountry: []
            }
        },

        computed: {
            sortedPackages() {
                if (this.selectedCountry.length) {
                    return _.orderBy(this.selectedCountry, 'days', 'asc');
                }

                return [];
            }
        },

        methods: {
            getRandomInt(min, max) {
                min = Math.ceil(min);
                max = Math.floor(max);

                let randNumber = Math.floor(Math.random() * ((max + 1) - min)) + min;

                if (randNumber === min) return '';

                return randNumber;
            },

            getImgNameByArea(area) {
                return area.replace(/\s/g, '').toLowerCase()
            },

            chooseCountry(country) {
                this.selectedCountry = _.orderBy(country, 'gtt_price_usd');
            },

            purchase(internetPackage) {
                let checkoutData = {
                    'area': internetPackage.area_eng,
                    'title': internetPackage.data_eng,
                    'des': internetPackage.destination_eng,
                    'days': internetPackage.days,
                    'price': internetPackage.gtt_price_usd,
                    'package_id': internetPackage.package_id
                };

                localStorage.setItem('checkout', JSON.stringify(checkoutData));

                window.location.href = '/checkout'
            },

            backToAreas() {
                this.selectedCountry = [];
            }
        }
    }
</script>

<style lang="scss">
    #internet-packages {
        .h-full {
            height: 100%;
        }

        .item-media {
            img {
                object-fit: cover;
                height: 190px;
            }
        }

        .item-content {
            padding: 20px 10px;

            h5 {
                font-size: 18px;
            }

            .service-title {
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 3; /* number of lines to show */
                -webkit-box-orient: vertical;
            }
        }
    }
</style>
