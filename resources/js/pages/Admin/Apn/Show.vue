<template>
    <div id="pages-apn-show">
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
                                <h6 class="">
                                    <u><small>Info</small></u>
                                </h6>

                                <dt class="col-sm-3">
                                    Country
                                </dt>
                                <dd class="col-sm-9">
                                    {{ data.country.name }}
                                </dd>

                                <dt class="col-sm-3">
                                    Operator
                                </dt>
                                <dd class="col-sm-9">
                                    {{ data.operator }}
                                </dd>

                                <dt class="col-sm-3">
                                    APNs
                                </dt>
                                <dd class="col-sm-9">
                                    {{ data.apn }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </section>
        </template>
    </div>
</template>

<script>
    export default {
        name: "PagesApnShow",

        props: {
            apnId: {
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
            this.$root.$on('pages-apn.load', this.loadData);
        },

        beforeDestroy() {
            this.$root.$off('pages-apn.load', this.loadData);
        },

        methods: {
            loadData() {
                this.loading = true;

                axios.get('/pages/apns/' + this.apnId + '/show')
                    .then(({data}) => {
                        this.data = data;
                        this.loading = false;
                    });
            },
        }
    }
</script>

<style scoped>

</style>
