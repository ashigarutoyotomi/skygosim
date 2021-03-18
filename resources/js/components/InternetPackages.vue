<template>
    <section class="internet-packages s-py-80 s-py-lg-120 s-py-xl-160 ls ms">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2" id="price">
                    <h5 class="special-heading text-center">Choose</h5>
                    <h1 class="text-center">Package</h1>
                    <p class="text-center big">Get ready for more potential, more opportunity and more of everything you expect from internet provider</p>
                </div>
            </div>
            <div class="divider-45 d-none d-lg-block"></div>

            <template v-if="internetPackages && !selectedCountry.length">
                <div class="row c-gutter-60">
                    <template v-for="(internetPackage, key) in internetPackages">
                        <div class="col-lg-3 col-md-4" @click="chooseCountry(internetPackage)">
                            <div class="pricing-plan bordered">
                                <div
                                    :class="`plan-name bg-maincolor${getRandomInt(1, 3)}`"
                                >
                                    <h3>
                                        {{ key }}
                                    </h3>
                                </div>
                                <div class="price-wrap color-darkgrey">
                                    <span class="plan-price">{{ internetPackage.length }}</span>
                                </div>
                                <div class="plan-description small-text color-darkgrey">
                                    Packages
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </template>

            <template v-if="internetPackages && selectedCountry.length">
                <div class="row c-gutter-60">
                    <template v-for="internetPackage in selectedCountry">
                        <div class="col-lg-4 col-12">
                            <div class="pricing-plan hero-bg rounded">
                                <div :class="`plan-name text-uppercase bg-maincolor${getRandomInt(1, 3)}`">
                                    <h3>
                                        {{ internetPackage.area_eng }}
                                    </h3>
                                </div>
                                <div class="plan-features">
                                    <ul class="list-bordered">
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
                                        {{ internetPackage.price_usd }}
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

        methods: {

            getRandomInt(min, max) {
                min = Math.ceil(min);
                max = Math.floor(max);

                let randNumber = Math.floor(Math.random() * ((max + 1) - min)) + min;

                if (randNumber === min) return '';

                return randNumber;
            },

            chooseCountry(country) {
                this.selectedCountry = country;
            },

            purchase(internetPackage) {
                let checkoutData = {
                    'area': internetPackage.area_eng,
                    'title': internetPackage.data_eng,
                    'des': internetPackage.destination_eng,
                    'days': internetPackage.days,
                    'price': internetPackage.price_usd,
                };

                localStorage.setItem('checkout', JSON.stringify(checkoutData));

                window.location.href = '/checkout'
            }
        }
    }
</script>

<style lang="scss">
    .internet-packages {
        .pricing-plan {
            cursor: pointer;
            margin-bottom: 50px;
        }
    }
</style>
