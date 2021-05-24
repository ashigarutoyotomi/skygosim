<template>
    <div id="internet-packages-index">
        <select-sim-modal/>

        <header-comp
            title="Packages"
        />

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
                                        {{ internetPackage.gtt_price }}
                                    </span>
                                    </div>

                                    <div class="plan-button">
                                        <button
                                            :class="`btn btn-maincolor${getRandomInt(1, 3)}`"
                                            @click="addToCart(internetPackage)"
                                        >
                                            <span>Add to card</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>

            </div>
        </section>
    </div>
</template>

<script>
    import SelectSimModal from "./modals/SelectSimModal";
    export default {
        name: "InternetPackagesIndex",
        components: {SelectSimModal},
        data() {
            return {
                selectedCountry: [],
                internetPackages: {},
                user: {},
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

        created() {
            this.loadMe();
            this.loadPackages();
        },

        methods: {
            loadPackages() {
                axios.get('/packages/getAllPackages')
                    .then(({data}) => {
                        this.internetPackages = data;
                    });
            },

            loadMe() {
                axios.get('/me')
                    .then(({data}) => {
                        this.user = data;
                    });
            },

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
                this.selectedCountry = _.orderBy(country, 'gtt_price');
            },

            addToCart(internetPackage) {
                if (this.user.id && this.user.sims.length) {
                    this.$root.$emit('modal::show::SelectSimModal', {
                        user_id: this.user.id,
                        internet_package_id: internetPackage.id,
                        sims: this.user.sims,
                        price: internetPackage.gtt_price
                    });
                } else if (this.user.id && !this.user.sims.length) {
                    window.location.href = '/add-sim'
                } else {
                    window.location.href = '/login'
                }
            },

            backToAreas() {
                this.selectedCountry = [];
            }
        }
    }
</script>

<style scoped>

</style>
