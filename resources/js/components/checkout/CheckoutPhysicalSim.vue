<template>
    <section class="ls s-pt-80 s-pb-50 s-pt-lg-120 s-pb-lg-100 s-pt-xl-160 s-pb-xl-130">
        <div class="container">
            <div class="row">
                <main class="col-lg-12">
                    <form
                        name="checkout"
                        class="checkout woocommerce-checkout"
                        @submit.prevent="processPayment"
                    >
                        <div class="col2-set" id="customer_details">
                            <div class="col-1">
                                <div class="woocommerce-billing-fields">
                                    <h3>Billing details</h3>

                                    <p class="form-row form-row-first validate-required">
                                        <label for="first_name" class="">
                                            First name
                                            <abbr class="required" title="required">*</abbr>
                                        </label>
                                        <input
                                            type="text"
                                            class="input-text form-control"
                                            :class="{'is-invalid' : errors.first_name}"
                                            name="first_name"
                                            id="first_name"
                                            placeholder="First name"
                                            v-model="form.first_name"
                                        >

                                        <span
                                            v-if="errors.first_name"
                                            class="invalid-feedback d-block"
                                        >
                                            {{ errors.first_name[0] }}
                                        </span>
                                    </p>

                                    <p class="form-row form-row-last validate-required">
                                        <label for="last_name" class="">
                                            Last name
                                            <abbr class="required" title="required">*</abbr>
                                        </label>
                                        <input
                                            type="text"
                                            class="input-text form-control"
                                            :class="{'is-invalid' : errors.last_name}"
                                            name="last_name"
                                            id="last_name"
                                            placeholder="Last name"
                                            v-model="form.last_name"
                                        >

                                        <span
                                            v-if="errors.last_name"
                                            class="invalid-feedback d-block"
                                        >
                                            {{ errors.last_name[0] }}
                                        </span>
                                    </p>

                                    <p class="form-row form-row-wide validate-required validate-email">
                                        <label for="billing_email" class="">
                                            Email address
                                            <abbr class="required" title="required">*</abbr>
                                        </label>
                                        <input
                                            type="email"
                                            class="input-text form-control"
                                            :class="{'is-invalid' : errors.email_address}"
                                            name="billing_email"
                                            id="billing_email"
                                            placeholder="Email address "
                                            v-model="form.email_address"
                                        >

                                        <span
                                            v-if="errors.email_address"
                                            class="invalid-feedback d-block"
                                        >
                                            {{ errors.email_address[0] }}
                                        </span>
                                    </p>

                                    <p class="form-row form-row-wide address-field validate-required">
                                        <label for="billing_address_1" class="">
                                            Street address
                                            <abbr class="required" title="required">*</abbr>
                                        </label>
                                        <input
                                            type="text"
                                            class="input-text form-control"
                                            :class="{'is-invalid' : errors.street_address}"
                                            name="billing_address_1"
                                            id="billing_address_1"
                                            placeholder="Street address"
                                            v-model="form.street_address"
                                        >

                                        <span
                                            v-if="errors.street_address"
                                            class="invalid-feedback d-block"
                                        >
                                            {{ errors.street_address[0] }}
                                        </span>
                                    </p>
                                    <p class="form-row form-row-wide address-field validate-required">
                                        <label for="billing_city" class="">
                                            City
                                            <abbr class="required" title="required">*</abbr>
                                        </label>
                                        <input
                                            type="text"
                                            class="input-text form-control"
                                            :class="{'is-invalid' : errors.city}"
                                            name="billing_city"
                                            id="billing_city"
                                            placeholder="City"
                                            v-model="form.city"
                                        >

                                        <span
                                            v-if="errors.city"
                                            class="invalid-feedback d-block"
                                        >
                                            {{ errors.city[0] }}
                                        </span>
                                    </p>
                                    <p class="form-row form-row-wide address-field validate-state validate-required">
                                        <label for="billing_state" class="">
                                            State
                                            <abbr class="required" title="required">*</abbr>
                                        </label>
                                        <input
                                            type="text"
                                            class="input-text form-control"
                                            :class="{'is-invalid' : errors.state}"
                                            value=""
                                            placeholder="State"
                                            name="billing_state"
                                            id="billing_state"
                                            v-model="form.state"
                                        >

                                        <span
                                            v-if="errors.state"
                                            class="invalid-feedback d-block"
                                        >
                                            {{ errors.state[0] }}
                                        </span>
                                    </p>
                                    <p class="form-row form-row-wide address-field validate-postcode validate-required">
                                        <label for="billing_postcode" class="">
                                            Postcode / ZIP Code
                                            <abbr class="required" title="required">*</abbr>
                                        </label>
                                        <input
                                            type="text"
                                            class="input-text form-control"
                                            :class="{'is-invalid' : errors.zip_code}"
                                            name="billing_postcode"
                                            id="billing_postcode"
                                            placeholder="Postcode / ZIP Code"
                                            v-model="form.zip_code"
                                        >

                                        <span
                                            v-if="errors.zip_code"
                                            class="invalid-feedback d-block"
                                        >
                                            {{ errors.zip_code[0] }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <div class="col-sm-12 mt-20">
                                <div class="form-group has-placeholder">
                                    <label>Card Information</label>
                                    <div id="card-element"></div>
                                </div>

                                <div
                                    v-if="stripeCardError.message"
                                    class="invalid-feedback d-block"
                                >
                                    {{ stripeCardError.message }}
                                </div>
                            </div>
                        </div>


                        <h3 id="order_review_heading">Your order</h3>

                        <div id="order_review" class="woocommerce-checkout-review-order">
                            <table class="shop_table woocommerce-checkout-review-order-table">
                                <thead>
                                <tr>
                                    <th class="product-name">Title</th>
                                    <th class="product-total">#</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="cart_item">
                                    <td class="product-name">
                                        Physical SIM
                                    </td>
                                    <td class="product-total">
                                        <span class="woocommerce-Price-amount amount">
                                            <span class="woocommerce-Price-currencySymbol">$</span>{{orderPrice}}
                                        </span>
                                    </td>
                                </tr>
                                <tr class="cart_item">
                                    <td class="product-name">
                                        Shipping
                                    </td>
                                    <td class="product-total">
                                        <span class="woocommerce-Price-amount amount">
                                            <span class="woocommerce-Price-currencySymbol">$</span>{{shippingPrice}}
                                        </span>
                                    </td>
                                </tr>
                                <tr class="cart_item">
                                    <td class="product-name">
                                        Total
                                    </td>
                                    <td class="product-total">
                                        <span class="woocommerce-Price-amount amount">
                                            <span class="woocommerce-Price-currencySymbol">$</span>{{orderPrice + shippingPrice}}
                                        </span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <div id="payment" class="woocommerce-checkout-payment">
                                <div class="form-row place-order">
                                    <button
                                        v-if="!loading"
                                        type="submit"
                                        class="btn btn-outline-maincolor small-button"
                                        name="woocommerce_checkout_place_order"
                                    >
                                        <span>Pay Now</span>
                                    </button>

                                    <button
                                        v-if="loading"
                                        type="button"
                                        class="btn btn-maincolor"
                                        disabled
                                    >
                                        <span>Loading...</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </main>
            </div>
        </div>
        <div class="divider-10 d-none d-xl-block"></div>
    </section>
</template>

<script>
    import {loadStripe} from "@stripe/stripe-js";

    export default {
        name: "CheckoutPhysicalSim",

        props: {
            user: {
                type: Object,
                default() {
                    return null;
                }
            },
            orderPrice: {
                type: Number,
                default() {
                    return 0;
                }
            },
            shippingPrice: {
                type: Number,
                default() {
                    return 0;
                }
            }
        },

        data() {
            return {
                stripe: {},
                cardElement: {},
                stripeKey: process.env.MIX_STRIPE_KEY,
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
                },
                loading: false,
                errors: {},
                stripeCardError: {},
            }
        },

        created() {
            this.setUserData();
        },

        mounted() {
            this.initStripe()
        },

        methods: {
            async processPayment() {
                this.loading = true;

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
                    this.stripeCardError = error;
                    this.loading = false;
                } else {
                    this.form.payment_method_id = paymentMethod.id;
                    this.form.amount = this.orderPrice + this.shippingPrice;

                    axios.post('/physical-sim/checkout', this.form)
                        .then(response => {
                            if (response) {
                                this.loading = false;
                                window.location.href = '/checkout/result'
                            }
                        })
                        .catch(e => {
                            this.loading = false;

                            if (e.response.status === 422) {
                                this.errors = e.response.data.errors;
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
            },

            setUserData()
            {
                if (this.user) {
                    this.form.first_name = this.user.first_name
                    this.form.last_name = this.user.last_name
                    this.form.email_address = this.user.email

                    if (this.user.address) {
                        this.form.street_address = this.user.address.street
                        this.form.city = this.user.address.city
                        this.form.state = this.user.address.state
                        this.form.zip_code = this.user.address.zip_code
                    }
                }
            }
        }
    }
</script>

<style lang="scss">

</style>
