<template>
    <admin-layout
        :user="user"
    >

        <router-view></router-view>

    </admin-layout>
</template>

<script>
    import AdminLayout from "./layouts/AdminLayout";

    export default {
        name: "Admin",

        components: {
            AdminLayout,
        },

        props: {
            user: {
                type: Object,
                default: () => {}
            }
        },
    }
</script>

<style lang="scss">

</style>
