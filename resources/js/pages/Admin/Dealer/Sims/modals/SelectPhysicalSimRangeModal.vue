<template>
    <modal
        :name="modalId"
        height="auto"
        :shiftY="0.1"
    >
        <div class="container p-4">
            <div class="row mb-4">
                <div class="col-11">
                    <h5 class="modal-title">Select physical SIMs range for dealer</h5>
                </div>
                <div class="col-1">
                    <button type="button" class="btn-close" @click="closeModal()"></button>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12 mb-2">
                    <label for="from_iccid" class="form-label">From ICCID</label>
                    <input
                        class="form-control form-control-sm"
                        :class="{'is-invalid': errors.from_iccid}"
                        type="text"
                        id="from_iccid"
                        v-model="form.from_iccid"
                    >
                    <div
                        v-if="errors.from_iccid"
                        class="invalid-feedback"
                    >
                        {{ errors.from_iccid[0] }}
                    </div>
                </div>

                <div class="col-12">
                    <label for="to_iccid" class="form-label">To ICCID</label>
                    <input
                        class="form-control form-control-sm"
                        :class="{'is-invalid': errors.to_iccid}"
                        type="text"
                        id="to_iccid"
                        v-model="form.to_iccid"
                    >
                    <div
                        v-if="errors.to_iccid"
                        class="invalid-feedback"
                    >
                        {{ errors.to_iccid[0] }}
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
        name: "SelectPhysicalSimRangeModal",

        data() {
            return {
                modalId: 'SelectPhysicalSimRangeModal',
                form: {
                    dealer_id: null,
                    from_iccid: null,
                    to_iccid: null
                },
                loading: false,
                errors: {}
            }
        },

        created() {
            this.$root.$on('modal::show::' + this.modalId, this.showModal);
        },

        beforeDestroy() {
            this.$root.$off('modal::show::' + this.modalId, this.showModal);
        },

        methods: {
            showModal(data){
                if (data) {
                    this.form.dealer_id = data.dealer_id;
                }

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

                axios.post(`/dealers/set-physical-sims`, formData)
                    .then(({data}) => {
                        this.loading = false;

                        this.$root.$emit('dealer-physical-sims.load');

                        this.$toast.open({
                            message: 'Physical SIMs selected',
                            type: 'success',
                            position: 'bottom-left'
                        });

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
            }
        }
    }
</script>

<style scoped>

</style>
