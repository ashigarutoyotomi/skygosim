<template>
    <div class="login">
        <section class="ls s-pt-80 s-pb-70 s-pt-lg-120 s-pb-lg-110 s-pt-xl-160 s-pb-xl-150">
            <div class="container">
                <div class="row">
                    <main class="col-lg-12">
                        <article>
                            <div class="entry-content">
                                <div class="woocommerce">
                                    <form
                                        class="woocomerce-form woocommerce-form-login login"
                                        method="post"
                                    >
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label for="email">
                                                Email address
                                                <span class="required">*</span>
                                            </label>
                                            <input
                                                type="email"
                                                class="form-control text-center woocommerce-Input woocommerce-Input--text input-text"
                                                name="email"
                                                id="email"
                                                v-model="form.email"
                                                placeholder="Email address"
                                            >
                                        </p>

                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label
                                                for="password"
                                            >
                                                Password
                                                <span class="required">*</span>
                                            </label>
                                            <input
                                                class="form-control text-center woocommerce-Input woocommerce-Input--text input-text"
                                                type="password"
                                                name="password"
                                                id="password"
                                                v-model="form.password"
                                                placeholder="Password"
                                            >
                                        </p>

                                        <div class="divider-60 d-none d-lg-block"></div>

                                        <p class="form-row text-center">
                                            <button type="submit" class="woocommerce-Button btn btn-maincolor" name="login">
                                                <span>Login</span>
                                            </button>
                                            <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
                                                <input
                                                    class="woocommerce-form__input woocommerce-form__input-checkbox"
                                                    name="rememberme"
                                                    type="checkbox"
                                                    id="rememberme"
                                                    value="forever"
                                                    v-model="form.rememberme"
                                                >
                                                <span>Remember me</span>
                                            </label>
                                        </p>

                                        <p class="woocommerce-LostPassword lost_password text-center">
                                            <a href="#">
                                                Forgot Your Password?
                                            </a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </article>
                    </main>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        name: "Login",

        data () {
            return {
                form: {
                    email: '',
                    password: '',
                    rememberme: '',
                }
            }
        },

        methods: {
            login() {
                axios.post('/login', this.form)
                    .then(res => {
                        console.log(res);
                    })
                    .catch(e => {
                        console.log(e);
                    });
            }
        }
    }
</script>

<style lang="scss">

</style>
