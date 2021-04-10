<template>
    <div id="users_show">
        <template v-if="loading">
            <div class="row">
                <div class="spinner-border mx-auto" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>
        </template>

        <template v-if="!loading">
            <section class="bg-white shadow-sm rounded-3 py-4 px-4 mb-4">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <dl class="row">
                                <h5 class=""><u>Info</u></h5>

                                <dt class="col-sm-3">
                                    Order ID
                                </dt>
                                <dd class="col-sm-9">
                                    {{ data.key }}
                                </dd>

                                <dt class="col-sm-3">
                                    Status
                                </dt>
                                <dd class="col-sm-9">
                                    {{ data.status }}
                                </dd>

                                <template v-if="data.address">
                                    <h5 class="mt-4"><u>Order Address</u></h5>

                                    <dt class="col-sm-3">
                                        Street
                                    </dt>
                                    <dd class="col-sm-9">
                                        {{ data.address.street }}
                                    </dd>

                                    <dt class="col-sm-3">
                                        City
                                    </dt>
                                    <dd class="col-sm-9">
                                        {{ data.address.city }}
                                    </dd>

                                    <dt class="col-sm-3">
                                        State
                                    </dt>
                                    <dd class="col-sm-9">
                                        {{ data.address.state }}
                                    </dd>

                                    <dt class="col-sm-3">
                                        ZIP code
                                    </dt>
                                    <dd class="col-sm-9">
                                        {{ data.address.zip_code }}
                                    </dd>
                                </template>
                            </dl>
                        </div>
                    </div>
                </div>
            </section>

            <sim-orders-index
                :user-id="userId"
            />
        </template>
    </div>
</template>

<script>
    export default {
        name: "ShowPhysicalSim",

        components: {

        },

        props: {
            simOrderId: {
                type: String,
                default: () => null,
            }
        },

        data () {
            return {
                data: null,
                loading: false,
            }
        },

        created() {
            this.loadData();
        },

        methods: {
            loadData() {
                this.loading = true;

                axios.get('/sim-orders/' + this.simOrderId + '/show')
                    .then(({data}) => {
                        this.data = data;
                        this.loading = false;
                    });
            }
        }
    }
</script>

<style lang="scss">

</style>
