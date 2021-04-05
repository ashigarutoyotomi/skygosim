<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container-xxl d-flex justify-content-between">
            <div>
                <router-link class="navbar-brand" to="/">
                    SkyGo
                </router-link>
            </div>

            <div>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a
                            id="navbarDropdown"
                            class="nav-link dropdown-toggle"
                            href="#"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            {{ user.first_name }} {{ user.last_name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/logout">
                               Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        name: "navbar",

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
