<template>
    <section class="ls s-pt-80 s-pb-70 s-py-lg-120 s-py-xl-160">
        <div class="container">
            <div class="row">
                <main class="col-lg-12">

                    <article>
                        <header class="entry-header mb-30">
                            <h1 class="entry-title">My account</h1>
<!--                            <span class="edit-link">-->
<!--                                <a class="post-edit-link" href="#">Edit-->
<!--                                    <span class="screen-reader-text"> "My account"</span>-->
<!--                                </a>-->
<!--                            </span>-->
                        </header><!-- .entry-header -->

                        <div class="entry-content">
                            <div class="woocommerce">
                                <nav class="woocommerce-MyAccount-navigation hero-bg p-60">
                                    <ul>
                                        <li :class="{'is-active': selectedTab === 'account'}">
                                            <a href="#" @click="selectTab('account')">Account</a>
                                        </li>
                                        <li :class="{'is-active': selectedTab === 'sims'}">
                                            <a href="#" @click="selectTab('sims')">SIMs</a>
                                        </li>
                                        <li :class="{'is-active': selectedTab === 'packages'}">
                                            <a href="#" @click="selectTab('packages')">Internet Packages</a>
                                        </li>
                                        <li :class="{'is-active': selectedTab === 'orders'}">
                                            <a href="#" @click="selectTab('orders')">Orders</a>
                                        </li>
                                        <li>
                                            <a href="#" @click="logout">Logout</a>
                                        </li>
                                    </ul>
                                </nav>

                                <template
                                    v-if="selectedTab === 'account'"
                                >
                                    <profile-account
                                        :user="user"
                                    />
                                </template>

                                <template
                                    v-if="selectedTab === 'sims'"
                                >
                                    <profile-sims
                                        :user="user"
                                    />
                                </template>

                                <template
                                    v-if="selectedTab === 'packages'"
                                >
                                    <profile-internet-packages
                                        :user="user"
                                    />
                                </template>

                                <template
                                    v-if="selectedTab === 'orders'"
                                >
                                    <profile-orders
                                        :user="user"
                                    />
                                </template>
                            </div>
                        </div><!-- .entry-content -->
                    </article>

                </main>
            </div>
        </div>
    </section>
</template>

<script>
    import ProfileAccount from "./modules/Account";
    import ProfileInternetPackages from "./modules/InternetPackages";
    import ProfileSims from "./modules/Sims";
    import ProfileOrders from "./modules/Orders";

    export default {
        name: "ProfileIndex",

        props: ['user'],

        components: {
            ProfileAccount,
            ProfileInternetPackages,
            ProfileSims,
            ProfileOrders,
        },

        data() {
            return {
                selectedTab: 'account',
            }
        },

        methods: {
            selectTab(tab) {
                this.selectedTab = tab;
            },

            logout() {
                axios.post('/logout')
                    .then(() => {
                        window.location.href = '/';
                    });
            }
        }
    }
</script>

<style lang="scss">

</style>
