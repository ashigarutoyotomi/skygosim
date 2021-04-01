<template>
    <admin-layout
        :user="$attrs.user"
    >
        <div class="bg-white shadow-sm rounded-lg py-4 px-4">
            <h5>Dashboard</h5>
        </div>
    </admin-layout>
</template>

<script>
    import AdminLayout from "../../../layouts/AdminLayout";

    export default {
        name: "DashboardIndex",

        components: {
            AdminLayout
        }
    }
</script>

<style scoped>

</style>
