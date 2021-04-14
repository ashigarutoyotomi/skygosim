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
                <a
                    class="nav-link"
                    :class="{'active': isActiveRoute(['purchases_internet_packages', 'purchases_internet_package_show'])}"
                    data-bs-toggle="collapse"
                    href="#collapsePurchases"
                    role="button"
                    aria-expanded="false"
                    aria-controls="collapsePurchases"
                >
                    Purchases
                    <i class="bi bi-chevron-down"></i>
                </a>

                <ul class="collapse pl-4" id="collapsePurchases">
                    <li class="nav-item">
                        <router-link
                            class="nav-link"
                            :class="{'active': isActiveRoute(['purchases_internet_packages'])}"
                            to="/purchases/internet-packages"
                        >Internet packages</router-link>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a
                    class="nav-link"
                    :class="{'active': isActiveRoute(['sim_orders_physical', 'sim_orders_e_sim'])}"
                    data-bs-toggle="collapse"
                    href="#collapseOrders"
                    role="button"
                    aria-expanded="false"
                    aria-controls="collapseOrders"
                >
                    Orders
                    <i class="bi bi-chevron-down"></i>
                </a>

                <ul class="collapse pl-4" id="collapseOrders">
                    <li class="nav-item">
                        <router-link
                            class="nav-link"
                            :class="{'active': isActiveRoute(['sim_orders_physical'])}"
                            to="/sim-orders/physical"
                        >Physical SIM</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link
                            class="nav-link"
                            :class="{'active': isActiveRoute(['sim_orders_e_sim'])}"
                            to="/sim-orders/e-sim"
                        >E-SIM</router-link>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <router-link
                    class="nav-link"
                    :class="{'active': isActiveRoute(['dealers', 'dealer_show', 'dealer_create', 'dealers_edit'])}"
                    to="/dealers"
                >Dealers</router-link>
            </li>

            <li class="nav-item">
                <router-link
                    class="nav-link"
                    :class="{'active': isActiveRoute(['users', 'users_show', 'users_create', 'users_edit'])}"
                    to="/users"
                >Users</router-link>
            </li>

            <li class="nav-item">
                <a
                    class="nav-link"
                    :class="{'active': isActiveRoute([
                            'internet_packages',
                            'inventory_sims_physical',
                            'inventory_e_sims',
                        ])}"
                    data-bs-toggle="collapse"
                    href="#collapseInventory"
                    role="button"
                    aria-expanded="false"
                    aria-controls="collapseInventory"
                >
                    Inventory
                    <i class="bi bi-chevron-down"></i>
                </a>

                <ul class="collapse pl-4" id="collapseInventory">
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
                            :class="{'active': isActiveRoute(['inventory_sims_physical'])}"
                            to="/inventory/sims/physical"
                        >Physical SIMs</router-link>
                    </li>

                    <li class="nav-item">
                        <router-link
                            class="nav-link"
                            :class="{'active': isActiveRoute(['inventory_e_sims'])}"
                            to="/inventory/sims/e-sims"
                        >E-SIMs</router-link>
                    </li>
                </ul>
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

        ul {
            list-style: none;
        }
    }
</style>
