<template>
    <modal
        :name="modalId"
        height="auto"
        :shiftY="0.1"
    >
        <div class="container py-3 px-4">
            <div class="row mb-4">
                <div class="col-12">
                    <h6>Select your sim</h6>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12">
                    <template v-for="sim in sims">
                        <input-radio
                            :label="sim.sim.iccid"
                            :value="sim.sim.id"
                            v-model="selectedSimId"
                        />
                    </template>

                    <div
                        v-if="errors.sim_id"
                        class="error-message"
                    >
                        {{ errors.sim_id[0] }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-9"></div>
                <div class="col-3">
                    <button
                        class="btn btn-maincolor2"
                        @click="addToCart"
                    >
                        <span>Add to card</span>
                    </button>
                </div>
            </div>
        </div>
    </modal>
</template>

<script>
    import InputRadio from "../../../components/forms/input-radio";

    export default {
        name: "SelectSimModal",
        components: {InputRadio},
        data() {
            return {
                modalId: 'SelectSimModal',
                sims: [],
                selectedSimId: null,
                user_id: null,
                internet_package_id: null,
                price: null,
                errors: {},
            }
        },

        created() {
            this.$root.$on('modal::show::SelectSimModal', this.showModal);
        },

        beforeDestroy() {
            this.$root.$off('modal::show::SelectSimModal', this.showModal);
        },

        methods: {
            showModal(data){
                this.internet_package_id = data.internet_package_id;
                this.user_id = data.user_id;
                this.sims = data.sims;
                this.price = data.price;
                this.$modal.show(this.modalId);
            },

            closeModal() {
                this.errors = {};
                this.$modal.hide(this.modalId);
            },

            addToCart() {
                let formData = new FormData();
                formData.append('user_id', this.user_id);
                formData.append('sim_id', this.selectedSimId);
                formData.append('internet_package_id', this.internet_package_id);
                formData.append('price', this.price);

                axios.post('/packages/add-to-cart', formData)
                    .then(({data}) => {
                        this.$root.$emit('user-cart-counts.update');
                        this.closeModal();
                    })
                    .catch(e => {
                        if (e.response ) {
                            if (e.response.status === 422) {
                                this.errors = e.response.data.errors;
                            } else {
                                this.errors = e.response.data;
                            }
                        }
                    });
            }
        }
    }
</script>

<style lang="scss">
    #SelectSimModal {
        z-index: 2000;
    }

    .vm--container {
        z-index: 2001;

        .btn {
            height: 40px;
            width: 100%;
        }

        .error-message {
            color: red;
            font-size: .8rem;
            font-style: italic;
        }
    }
</style>
