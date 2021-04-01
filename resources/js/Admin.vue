<template>
    <main>
        <router-view
            :user="user"
        ></router-view>
    </main>
</template>

<script>
    export default {
        name: "Admin",

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
