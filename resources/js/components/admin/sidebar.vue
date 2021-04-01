<template>
    <nav class="navbar navbar-light bg-white shadow-sm rounded-lg py-4 px-4">
        <ul class="navbar-nav flex-column">
            <li class="nav-item">
                <router-link
                    class="nav-link active"
                    to="/"
                >Home</router-link>
            </li>
            <li class="nav-item">
                <router-link
                    class="nav-link"
                    to="/internet-packages"
                >Internet Packages</router-link>
            </li>
            <li class="nav-item">
                <router-link
                    class="nav-link"
                    to="/sim-cards"
                >Sim Cards</router-link>
            </li>
            <li class="nav-item">
                <router-link
                    class="nav-link"
                    to="/users"
                >Users</router-link>
            </li>
            <li class="nav-item">
                <router-link
                    class="nav-link"
                    to="/settings"
                >Settings</router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        name: "AdminSidebar"
    }
</script>

<style scoped>

</style>
