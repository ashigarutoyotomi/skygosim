<template>
    <section class="ls s-pb-20 s-pb-md-60 s-pb-lg s-pb-xl-160 s-pt-75 c-mb-60 c-mb-md-0">
        <div class="container pb-4">
            <div class="row">
                <main class="col-lg-12">
                    <article id="post-1707" class="post-1707 page type-page status-publish hentry">
                        <header class="entry-header mb-30">
                            <h1 class="entry-title">
                                {{ checkoutData.title }}
                            </h1>
                        </header>
                        <!-- .entry-header -->
                        <div class="entry-content">
                            <div class="woocommerce">
                                <div class="woocommerce-order">
                                    <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">
                                        <li class="woocommerce-order-overview__date date">
                                            Area: <strong>{{ checkoutData.area }}</strong>
                                        </li>

                                        <li class="woocommerce-order-overview__date date">
                                            Days: <strong>{{ checkoutData.days }}</strong>
                                        </li>

                                        <li class="woocommerce-order-overview__total total">
                                            Price:
                                            <strong>
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">$</span>
                                                    {{ Math.ceil(checkoutData.price) }}
                                                </span>
                                            </strong>
                                        </li>

                                        <li class="woocommerce-order-overview__payment-method method">
                                            Payment method: <strong>VISA</strong>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- .entry-content -->
                    </article>

                </main>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-12 animate" data-animation="scaleAppear">
                    <form class="c-gutter-10" @submit.prevent="processPayment">
                        <div class="row c-mb-8">
                            <div class="col-sm-4">
                                <div class="form-group has-placeholder">
                                    <label>
                                        First Name
                                    </label>
                                    <input
                                        type="text"
                                        aria-required="true"
                                        size="30"
                                        class="form-control"
                                        placeholder="First Name"
                                        v-model="form.first_name"
                                    >
                                </div>
                                <div class="form-group has-placeholder">
                                    <label>
                                        Street Address
                                    </label>
                                    <input
                                        type="text"
                                        aria-required="true"
                                        size="30"
                                        class="form-control"
                                        placeholder="Street Address"
                                        v-model="form.street_address"
                                    >
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group has-placeholder">
                                    <label>
                                        Last Name
                                    </label>
                                    <input
                                        type="text"
                                        aria-required="true"
                                        size="30"
                                        class="form-control"
                                        placeholder="Last Name"
                                        v-model="form.last_name"
                                    >
                                </div>
                                <div class="form-group has-placeholder">
                                    <label>
                                        City
                                    </label>
                                    <input
                                        type="text"
                                        aria-required="true"
                                        size="30"
                                        class="form-control"
                                        placeholder="City"
                                        v-model="form.city"
                                    >
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group has-placeholder">
                                    <label>
                                        Email Address
                                    </label>
                                    <input
                                        type="text"
                                        aria-required="true"
                                        size="30"
                                        class="form-control"
                                        placeholder="Email Address"
                                        v-model="form.email_address"
                                    >
                                </div>
                                <div class="row mt-10">
                                    <div class="col-sm-6">
                                        <div class="form-group has-placeholder">
                                            <label>
                                                State
                                            </label>
                                            <input
                                                type="text"
                                                aria-required="true"
                                                size="30"
                                                class="form-control"
                                                placeholder="State"
                                                v-model="form.state"
                                            >
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group has-placeholder">
                                            <label>
                                                Zip Code
                                            </label>
                                            <input
                                                type="text"
                                                aria-required="true"
                                                size="30"
                                                class="form-control"
                                                placeholder="Zip Code"
                                                v-model="form.zip_code"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 mt-10">
                                <div class="form-group has-placeholder">
                                    <label>Card Information</label>
                                    <div id="card-element"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-30">
                            <div class="col-sm-12">
                                <div class="form-group text-center">
                                    <button
                                        type="submit"
                                        class="btn btn-maincolor"
                                    >
                                        <span>Pay Now</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { loadStripe } from '@stripe/stripe-js';

export default {
    name: "CheckoutForm",

    data() {
        return {
            stripe: {},
            cardElement: {},
            stripeKey: process.env.MIX_STRIPE_KEY,
            checkoutData: null,
            form: {
                payment_method_id: null,
                amount: 0,
                cart: '',
                first_name: '',
                last_name: '',
                state: '',
                street_address: '',
                city: '',
                email_address: '',
                zip_code: '',
            }
        }
    },

    created() {
        this.checkoutData = JSON.parse(localStorage.getItem('checkout'));
    },

    mounted() {
        setTimeout(this.initStripe(), 3000);
    },

    methods: {
        async processPayment() {
            const {paymentMethod, error} = await this.stripe.createPaymentMethod(
                'card', this.cardElement, {
                    billing_details: {
                        name: this.form.first_name + ' ' + this.form.last_name,
                        email: this.form.email_address,
                        address: {
                            line1: this.form.street_address,
                            city: this.form.city,
                            state: this.form.state,
                            postal_code: this.form.zip_code,
                        }
                    }
                }
            );

            if (error) {
                console.log(error);
            } else {
                this.form.payment_method_id = paymentMethod.id;
                this.form.amount = Math.ceil(this.checkoutData.price);

                axios.post('/internet-packages/purchase', this.form)
                    .then(response => {
                        if (response) {
                            window.location.href = '/checkout/result'
                        }
                    });
            }
        },

        initStripe() {
            loadStripe(this.stripeKey)
                .then(response => {
                    this.stripe = response;
                    const elements = this.stripe.elements();

                    this.cardElement = elements.create('card', {
                        classes: {
                            base: 'form-control',
                        }
                    });

                    this.cardElement.mount('#card-element');
                });
        }
    }
}
</script>

<style lang="scss">
    #card-element {
        padding-top: 1.25rem;
    }
</style>
