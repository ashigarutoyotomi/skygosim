<template>
    <div id="dealers_show">
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
                                    Full name
                                </dt>
                                <dd class="col-sm-9">
                                    {{ data.first_name }} {{ data.last_name }}
                                </dd>

                                <dt class="col-sm-3">
                                    Email
                                </dt>
                                <dd class="col-sm-9">
                                    {{ data.email }}
                                </dd>

                                <dt class="col-sm-3">
                                    Role
                                </dt>
                                <dd class="col-sm-9">
                                    {{ userRoles[data.role].label }}
                                </dd>

                                <template v-if="data.address">
                                    <h5 class="mt-4"><u>Address</u></h5>

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
        </template>
    </div>
</template>

<script>
    import {USER_ROLES} from "../Users/constants";

    export default {
        name: "DealerShow",

        components: {

        },

        props: {
            userId: {
                type: String,
                default: () => null,
            }
        },

        data () {
            return {
                data: null,
                loading: false,
                userRoles: USER_ROLES,
            }
        },

        created() {
            this.loadData();
        },

        methods: {
            loadData() {
                this.loading = true;

                axios.get('/users/' + this.userId + '/show')
                    .then(({data}) => {
                        this.data = data;
                        this.loading = false;
                    });
            }
        }
    }
</script>

<style scoped>

</style>
