<template>
    <modal
        :name="modalId"
        height="auto"
        :shiftY="0.1"
    >
        <div class="container p-4">
            <div class="row mb-4">
                <div class="col-11">
                    <h5 class="modal-title">Choose physical SIM</h5>
                </div>
                <div class="col-1">
                    <button type="button" class="btn-close" @click="closeModal()"></button>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <label for="iccid" class="form-label">ICCID</label>
                            <v-select
                                id="iccid"
                                :class="{'is-invalid': errors.iccid}"
                                :options="sims"
                                label="iccid"
                                :reduce="sim => sim.iccid"
                                v-model="form.iccid"
                            ></v-select>

                            <div
                                v-if="errors.iccid"
                                class="invalid-feedback"
                            >
                                {{ errors.iccid[0] }}
                            </div>
                        </div>

                        <!--                        <div class="col-12">-->
                        <!--                            <button-->
                        <!--                                type="button"-->
                        <!--                                class="btn btn-info btn-sm"-->
                        <!--                            >-->
                        <!--                                Select available ICCID-->
                        <!--                            </button>-->
                        <!--                        </div>-->
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-4">
                    <template v-if="!loading">
                        <button
                            type="button"
                            class="btn btn-light"
                            @click="closeModal()"
                        >
                            Cancel
                        </button>
                        <button
                            type="button"
                            class="btn btn-success"
                            @click="save"
                        >
                            Save
                        </button>
                    </template>
                    <template v-if="loading">
                        <button
                            type="button"
                            class="btn btn-success"
                            disabled
                        >
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Saving...
                        </button>
                    </template>
                </div>
            </div>
        </div>
    </modal>
</template>

<script>
    export default {
        name: "ChoosePhysicalSimModal",

        props: {
            modalId: {
                type: String,
                required: true
            },

            orderId: {
                type: Number,
                required: true
            },
        },

        data() {
            return {
                form: {
                    iccid: null
                },

                sims: [],

                loading: false,
                errors: {}
            }
        },

        created() {
            this.$root.$on('modal::show::ChoosePhysicalSimModal', this.showModal);
            this.loadAvailableSims();
        },

        beforeDestroy() {
            this.$root.$off('modal::show::ChoosePhysicalSimModal', this.showModal);
        },

        methods: {
            showModal(){
                this.$modal.show(this.modalId);
            },

            closeModal() {
                this.$modal.hide(this.modalId);
            },

            save() {
                this.loading = true;

                const formData = new FormData();
                for ( let key in this.form ) {
                    formData.append(key, this.form[key]);
                }

                axios.post(`/sim-orders/${this.orderId}/add-physical-sim`, formData)
                    .then(() => {
                        this.$toast.open({
                            message: 'SIM added successfully',
                            type: 'success',
                            position: 'bottom-left'
                        });

                        this.loading = false;
                        this.$root.$emit('sim.load');
                        this.closeModal();
                    })
                    .catch(e => {
                        this.loading = false;

                        if (e.response ) {
                            if (e.response.status === 422) {
                                this.errors = e.response.data.errors;
                            } else {
                                this.$toast.open({
                                    message: e.response.data.message,
                                    type: 'error',
                                    position: 'bottom-left'
                                });
                            }
                        }
                    });
            },

            loadAvailableSims() {
                axios.get('/sims/physical/available')
                    .then(res => {
                        this.sims = res.data;
                    });
            }
        }
    }
</script>

<style lang="scss">
    .vm--modal {
        overflow: visible !important;
    }
</style>
