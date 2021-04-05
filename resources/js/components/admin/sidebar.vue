<template>
    <nav id="sidebar" class="navbar navbar-light bg-white shadow-sm rounded-3 py-4 px-4">
        <ul class="navbar-nav flex-column">
            <li class="nav-item">
                <router-link
                    class="nav-link"
                    :class="{'active': isActiveRoute(['home'])}"
                    to="/"
                >Home</router-link>
            </li>
            <li class="nav-item">
                <router-link
                    class="nav-link"
                    :class="{'active': isActiveRoute(['internet_packages'])}"
                    to="/internet-packages"
                >Internet Packages</router-link>
            </li>
            <li class="nav-item">
                <router-link
                    class="nav-link"
                    :class="{'active': isActiveRoute(['sim_cards'])}"
                    to="/sim-cards"
                >Sim Cards</router-link>
            </li>
            <li class="nav-item">
                <router-link
                    class="nav-link"
                    :class="{'active': isActiveRoute(['sim_orders'])}"
                    to="/sim-orders"
                >Sim Orders</router-link>
            </li>
            <li class="nav-item">
                <router-link
                    class="nav-link"
                    :class="{'active': isActiveRoute(['users', 'users_show', 'users_create'])}"
                    to="/users"
                >Users</router-link>
            </li>
            <li class="nav-item">
                <router-link
                    class="nav-link"
                    :class="{'active': isActiveRoute(['settings'])}"
                    to="/settings"
                >Settings</router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        name: "AdminSidebar",

        computed: {

        },

        methods: {
            isActiveRoute(routeNames) {
                return routeNames.includes(this.$route.name);
            }
        },
    }
</script>

<style lang="scss">
    #sidebar {
        .nav-link {
            font-size: .9rem;

            &.active {
                color: #0d6efd;
            }
        }
    }
</style>
