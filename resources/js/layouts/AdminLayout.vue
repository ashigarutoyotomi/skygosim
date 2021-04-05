<template>
    <main class="min-vh-100 bg-light">
        <navbar
            :user="user"
        ></navbar>

        <div class="container-xxl py-4">
            <div class="row">
                <div class="col-3">
                    <sidebar></sidebar>
                </div>

                <div class="col-9">
                    <slot></slot>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
    import Navbar from "../components/admin/navbar";
    import Sidebar from "../components/admin/sidebar";

    export default {
        name: "AdminLayout",

        components: {
            Navbar,
            Sidebar,
        },

        props: {
            user: {
                type: Object,
                default: () => {}
            }
        }
    }
</script>

<style lang="scss">

</style>
