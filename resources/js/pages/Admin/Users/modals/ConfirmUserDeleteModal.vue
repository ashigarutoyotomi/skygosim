<template>
    <modal
        :name="modalId"
        height="auto"
        :shiftY="0.1"
    >
        <div class="container p-4">
            <div class="row mb-4">
                <div class="col-11">
                    <h5 class="modal-title">Confirm delete</h5>
                </div>
                <div class="col-1">
                    <button type="button" class="btn-close" @click="closeModal()"></button>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="d-flex">
                        <template v-if="!loading">
                            <button
                                type="button"
                                class="btn btn-light btn-sm"
                                @click="closeModal()"
                            >
                                Cancel
                            </button>
                            <button
                                type="button"
                                class="btn btn-success btn-sm ml-4"
                                @click="confirm"
                            >
                                Confirm
                            </button>
                        </template>
                        <template v-if="loading">
                            <button
                                type="button"
                                class="btn btn-success btn-sm"
                                disabled
                            >
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Confirming...
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </modal>
</template>

<script>
    export default {
        name: "ConfirmUserDeleteModal",

        data() {
            return {
                modalId: 'ConfirmUserDeleteModal',
                loading: false,
                userId: null,
            }
        },

        created() {
            this.$root.$on('modal::show::' + this.modalId, this.showModal);
        },

        beforeDestroy() {
            this.$root.$off('modal::show::' + this.modalId, this.showModal);
        },

        methods: {
            showModal(data) {
                this.userId = data.userId;
                this.$modal.show(this.modalId);
            },

            closeModal() {
                this.$modal.hide(this.modalId);
            },

            confirm() {
                this.loading = true;

                axios.delete(`/users/${this.userId}/delete`)
                    .then(res => {
                        this.loading = false;

                        this.$toast.open({
                            message: 'User successfully deleted',
                            type: 'success',
                            position: 'bottom-left'
                        });

                        this.closeModal();
                        this.$router.push('/users');
                        this.$root.$emit('users.load');
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
                    })
            },
        }
    }
</script>

<style lang="scss">
    .vm--container {
        .btn {
            height: auto !important;
            width: auto !important;
        }

        .ml-4 {
            margin-left: 1rem;
        }
    }
</style>
