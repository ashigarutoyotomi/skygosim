<template>
    <admin-layout>

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
    .index {
        &__actions-list {
            list-style: none;
            display: flex;
            justify-content: flex-end;

            li {
                margin: 0 0 0 .5rem;
            }
        }
    }
</style>
