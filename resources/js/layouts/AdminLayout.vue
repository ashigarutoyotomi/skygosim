<template>
    <main class="min-vh-100 bg-light">
        <template v-if="loading">

        </template>

        <template v-if="!loading">
            <navbar
                :user="user"
            ></navbar>

            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-3 col-xxl-2">
                        <sidebar></sidebar>
                    </div>

                    <div class="col-9">
                        <slot></slot>
                    </div>
                </div>
            </div>
        </template>
    </main>
</template>

<script>
    import Navbar from "../components/admin/navbar";
    import Sidebar from "../components/admin/sidebar";
    import { mapGetters } from 'vuex'

    export default {
        name: "AdminLayout",

        components: {
            Navbar,
            Sidebar,
        },

        data() {
            return {
                loading: false,
            }
        },

        computed: {
            ...mapGetters({
                user: 'getUser'
            }),
        },

        created() {
            this.loadMe();
        },

        methods: {
            loadMe() {
                this.loading = true;

                this.$store.dispatch('loadMe')
                    .then(() => {
                        this.loading = false;
                    });
            }
        }
    }
</script>

<style lang="scss">

</style>
