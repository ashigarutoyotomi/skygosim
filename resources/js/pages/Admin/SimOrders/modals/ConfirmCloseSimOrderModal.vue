<template>
    <modal
        :name="modalId"
        height="auto"
        :shiftY="0.1"
    >
        <div class="container p-4">
            <div class="row mb-4">
                <div class="col-11">
                    <h5 class="modal-title">Confirm close this order</h5>
                </div>
                <div class="col-1">
                    <button type="button" class="btn-close" @click="closeModal()"></button>
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
                            Confirm
                        </button>
                    </template>
                    <template v-if="loading">
                        <button
                            type="button"
                            class="btn btn-success"
                            disabled
                        >
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Confirming...
                        </button>
                    </template>
                </div>
            </div>
        </div>
    </modal>
</template>

<script>
export default {
    name: "ConfirmCloseSimOrderModal",

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
            loading: false,
        }
    },

    created() {
        this.$root.$on('modal::show::' + this.modalId, this.showModal);
    },

    beforeDestroy() {
        this.$root.$off('modal::show::' + this.modalId, this.showModal);
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

            axios.put(`/sim-orders/${this.orderId}/finish`)
                .then(res => {
                    this.loading = false;

                    this.$toast.open({
                        message: 'Order successfully closed',
                        type: 'success',
                        position: 'bottom-left'
                    });

                    this.$root.$emit('sim.load');
                    this.closeModal();
                })
                .catch(e => {
                    this.loading = false;

                    if (e.response ) {
                        this.$toast.open({
                            message: e.response.data.message,
                            type: 'error',
                            position: 'bottom-left'
                        });
                    }
                })
        },
    }
}
</script>

<style lang="scss">
    .vm--modal {
        overflow: visible !important;
    }
</style>
