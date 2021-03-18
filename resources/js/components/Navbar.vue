<template>
    <div class="header_absolute header_layout_1">
        <!-- header with two Bootstrap columns - left for logo and right for navigation and includes (search, social icons, additional links and buttons etc -->
        <header class="page_header ls justify-nav-end">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-4 col-md-5 col-11">
                        <a href="/" class="logo">
                            <span class="logo-text py-20"><strong>Sky</strong>Go</span>
                        </a>
                    </div>
                    <div class="col-xl-9 col-lg-8 col-md-7 col-1">
                        <div class="nav-wrap">

                            <!-- main nav start -->
                            <nav class="top-nav">
                                <ul class="nav sf-menu">
                                    <li class="active">
                                        <a href="/">Home</a>
                                    </li>

                                    <li>
                                        <a href="/internet">Internet</a>
                                    </li>

                                    <li>
                                        <a href="#">|</a>
                                    </li>

                                    <li>
                                        <a href="/login">Log In</a>
                                    </li>

                                    <li>
                                        <a href="/register">Register</a>
                                    </li>
                                </ul>
                            </nav>
                            <!-- eof main nav -->

                            <!--hidding includes on small devices. They are duplicated in topline-->
                            <ul class="top-includes d-none d-xl-block search-icon">
                                <li>
                                    <!--modal search-->
                                    <span>
                                        <a class="search_modal_button">
                                            <i class="fa fa-search"></i>
                                        </a>
                                    </span>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>
</template>

<script>
    export default {
        name: "Navbar"
    }
</script>

<style scoped>

</style>
