<template>
    <section class="ls s-py-80 s-py-lg-120 s-py-xl-160 c-gutter-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 animate" data-animation="scaleAppear">
                    <h5 class="text-center text-md-left special-heading">
                        join us today<br>
                        <span class="text-uppercase">Add Your Sim Card</span>
                    </h5>

                    <div class="divider-50 d-none d-xl-block"></div>

                    <form
                        class="c-mb-10 c-mb-md-20 c-gutter-20 text-center text-md-left"
                        @submit.prevent="submit"
                    >
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group has-placeholder">
                                    <label for="iccid">ICCID</label>
                                    <input
                                        type="text"
                                        aria-required="true"
                                        size="30"
                                        name="iccid"
                                        id="iccid"
                                        class="form-control"
                                        :class="{'is-invalid' : errors.iccid}"
                                        placeholder="ICCID"
                                        v-model="form.iccid"
                                    >

                                    <span
                                        v-if="errors.iccid"
                                        class="invalid-feedback d-block"
                                    >
                                            {{ errors.iccid[0] }}
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group has-placeholder">
                                    <label for="code">Code</label>
                                    <input
                                        type="text"
                                        aria-required="true"
                                        size="30"
                                        name="code"
                                        id="code"
                                        class="form-control"
                                        :class="{'is-invalid' : errors.code}"
                                        placeholder="Code"
                                        v-model="form.code"
                                    >

                                    <span
                                        v-if="errors.code"
                                        class="invalid-feedback d-block"
                                    >
                                            {{ errors.code[0] }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 text-center text-md-left mt-30">

                                <div class="form-group">
                                    <button
                                        v-if="loading"
                                        type="button"
                                        class="btn btn-maincolor"
                                        disabled
                                    >
                                        <span>Loading...</span>
                                    </button>

                                    <button
                                        v-if="!loading"
                                        type="submit"
                                        class="btn btn-maincolor"
                                    >
                                        <span>Add Sim</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <template v-if="errors.message">
                        <div class="divider-50 d-none d-xl-block"></div>

                        <span class="text-danger">
                            {{ errors.message }}
                        </span>
                    </template>
                </div>

                <div class="col-lg-8 animate" data-animation="scaleAppear">
                    <img src="/images/how-to-add-sim.png" alt="">
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "AddSimIndex",

        data() {
            return {
                form: {
                    iccid: '',
                    code: '',
                },
                errors: {},
                loading: false,
            }
        },

        methods: {
            submit() {
                this.loading = true;

                axios.post('/add-sim', this.form)
                    .then(res => {
                        this.loading = false;
                        window.location.href = '/packages'
                    })
                    .catch(e => {
                        this.loading = false;

                        if (e.response.status === 403) {
                            window.location.href = '/register'
                        }

                        if (e.response.status === 422) {
                            this.errors = e.response.data.errors;
                        } else {
                            this.errors = e.response.data;
                        }
                    });
            }
        }
    }
</script>

<style lang="scss">

</style>
