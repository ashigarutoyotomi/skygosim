<template>
    <div id="navbar" class="header_absolute header_layout_1">
        <header class="page_header ls justify-nav-end">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-4 col-md-5 col-11">
                        <a href="/" class="logo">
                            <img class="py-20" src="/images/skygo_logo.png" alt="">
                        </a>
                    </div>
                    <div class="col-xl-10 col-lg-8 col-md-7 col-1">
                        <div class="nav-wrap">

                            <!-- main nav start -->
                            <nav class="top-nav">
                                <ul class="nav sf-menu">
                                    <li class="">
                                        <a href="/">Home</a>
                                    </li>

                                    <li class="">
                                        <a href="/add-sim">Add Sim</a>
                                    </li>

                                    <li class="">
                                        <a href="/packages">Packages</a>
                                    </li>

                                    <li class="">
                                        <a href="/apn">APN</a>
                                    </li>

                                    <li class="">
                                        <a href="#">How To</a>
                                        <ul>
                                            <li class="">
                                                <a href="/how-to">How to</a>
                                            </li>

                                            <li class="">
                                                <a href="/how-to-add-e-sim">How to add E-SIM</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="">
                                        <a href="/faq">FAQ</a>
                                    </li>

                                    <li>
                                        <a href="#">|</a>
                                    </li>

                                    <template
                                        v-if="!user"
                                    >
                                        <li class="">
                                            <a href="/login">Log In</a>
                                        </li>

                                        <li class="">
                                            <a href="/register">Register</a>
                                        </li>
                                    </template>

                                    <template
                                        v-if="user"
                                    >
                                        <li>
                                            <a href="#">{{ user.first_name }} {{ user.last_name }}</a>
                                            <ul>
                                                <li>
                                                    <a href="/profile">
                                                        Profile
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" @click="logout">
                                                        Logout
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="/cart">
                                                <i class="color-main2 fa fa-shopping-cart" aria-hidden="true"></i>
                                                <span class="cart-badge">
                                                    {{ cartCounts }}
                                                </span>
                                            </a>
                                        </li>
                                    </template>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <span class="toggle_menu"><span></span></span>
        </header>
    </div>
</template>

<script>
    export default {
        name: "Navbar",

        props: {
            user: {
                type: Object,
                default: () => null,
            }
        },

        data() {
            return {
                cartCounts: 0,
            }
        },

        created() {
            this.$root.$on('user-cart-counts.update', this.loadUserCartCounts);
            this.loadUserCartCounts();
        },

        beforeDestroy() {
            this.$root.$off('user-cart-counts.update', this.loadUserCartCounts);
        },

        methods: {
            logout() {
                axios.post('/logout')
                    .then(() => {
                        window.location.href = '/';
                    });
            },

            loadUserCartCounts() {
                axios.get('/user-cart/counts')
                    .then(({data}) => {
                        this.cartCounts = data;
                    });
            }
        }
    }
</script>

<style lang="scss">
    #navbar {
        .cart-badge {
            border-radius: 100%;
            padding: 3px 3px;
            color: #5b83cd;
            margin-left: -10px;
        }
    }

    .header_absolute.header_layout_1 .ls.affix-top .sf-menu > li > a {
        color: #000;
    }

    .page_header_wrapper {
        background: #fff !important;
    }
</style>
