<template>
    <div id="internet-packages-index">
        <select-sim-modal/>

        <header-comp>
            <div class="container-fluid">
                <div class="row">
                    <div class="divider-60"></div>

                    <div class="col-md-12 text-center">
                        <h5 class="">Choose</h5>
                        <h1>Package</h1>
                        <p class="">
                            Get ready for more potential,
                            more opportunity and more of everything you expect from internet provider
                        </p>
                    </div>

                    <div class="divider-50"></div>
                </div>
            </div>

            <ol class="breadcrumb full-width">
                <li class="breadcrumb-item">
                    <router-link to="/">Home</router-link>
                </li>
                <li class="breadcrumb-item active">
                    Packages
                </li>
            </ol>
        </header-comp>

        <section
            id="internet-packages"
            class="internet-packages"
        >
            <div class="container">
                <template
                    v-if="internetPackages && !selectedCountry.length"
                >
                    <div class="row">
                        <div class="col-12">
                            <div class="internet-packages__search">
                                <input
                                    type="text"
                                    placeholder="Search by region"
                                    v-model="searchKeywords"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <template
                            v-for="(internetPackageItems, area) in filteredInternetPackages"
                        >
                            <div class="col-12">
                                <div class="internet-packages__area">
                                    <h1>{{ internetPackageItems[0].destination_eng }}</h1>
                                </div>
                            </div>

                            <template
                                v-for="internetPackage in internetPackageItems"
                            >
                                <div class="col-lg-3 col-sm-6">
                                    <div
                                        class="internet-packages__item"
                                        @click="addToCart(internetPackage)"
                                    >
                                        <div class="item-media">
                                            <img :src="`/images/regions/${getImgNameByArea(internetPackage.area_eng)}.jpg`" alt="">
                                        </div>
                                        <div class="item-content">
                                            <p>
                                                {{ internetPackage.data_eng }}
                                            </p>
                                            <p>
                                                {{ internetPackage.days }} Days
                                            </p>

                                            <h5>
                                                <a
                                                    href="#"
                                                    @click="addToCart(internetPackage)"
                                                >
                                                    USD {{ internetPackage.gtt_price }}
                                                </a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </template>
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
                searchKeywords: '',
            }
        },

        computed: {
            sortedPackages() {
                if (this.selectedCountry.length) {
                    return _.orderBy(this.selectedCountry, 'days', 'asc');
                }

                return [];
            },

            filteredInternetPackages() {
                let internetPackages = [];
                let searchKeywords = this.searchKeywords;

                for (let key in this.internetPackages) {
                    internetPackages.push(_.orderBy(this.internetPackages[key], 'days', 'asc'));
                }

                if (this.searchKeywords) {
                    internetPackages = _.filter(internetPackages, function(packages) {
                        return packages.find(packageItem => {
                            let area = packageItem.destination_eng.toLowerCase();
                            return area.includes(searchKeywords.toLowerCase());
                        });
                    });
                }

                return internetPackages;
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
                        if (data) {
                            this.user = data;
                        }
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

<style lang="scss">
    .internet-packages {
        padding: 4rem 0;

        &__search {
            margin: 0 0 1rem 0;

            input {
                box-shadow: none;
                font-size: 1rem;
                padding: .3rem 1rem;

                &::placeholder {
                    color: #ededed;
                    opacity: 1; /* Firefox */
                }

                &:-ms-input-placeholder { /* Internet Explorer 10-11 */
                    color: #ededed;
                }

                &::-ms-input-placeholder { /* Microsoft Edge */
                    color: #ededed;
                }
            }
        }

        &__area {
            border-bottom: 2px solid #fafafa;
            margin: 0 0 1rem 0;
            padding: 1rem 0 1rem 0;

            h1 {
                font-size: 1.5rem;
                color: #4c4c4c;
                margin: 0;
            }
        }

        &__item {
            background: #f7f6fb;
            border-radius: 5px;
            margin: 0 0 2rem 0;
            cursor: pointer;

            .item-media {
                img {
                    border-radius: 5px 5px 0 0;
                    transition: .2s;
                }
            }

            .item-content {
                h5 {
                    margin: 0;
                    transition: .2s;
                }

                p {
                    transition: .2s;
                }
            }

            &:hover {
                .item-media {
                    img {
                        filter: sepia(100%);
                    }
                }

                .item-content {
                    h5 a {
                        color: #5b83cd;
                    }

                    p {
                        color: #5b83cd;
                    }
                }
            }
        }
    }
</style>
