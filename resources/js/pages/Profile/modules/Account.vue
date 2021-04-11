<template>
    <div class="woocommerce-MyAccount-content">
        <p>
            {{user.first_name}} {{user.last_name}}
        </p>

        <template v-if="user.address">
            <p>State: {{ user.address.state }}</p>
            <p>City: {{ user.address.city }}</p>
            <p>Street: {{ user.address.street }}</p>
            <p>ZIP code: {{ user.address.zip_code }}</p>
        </template>
    </div>
</template>

<script>
    export default {
        name: "ProfileAccount",

        props: ['user'],
    }
</script>

<style scoped>

</style>
