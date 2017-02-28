<template>

    <div id="wrapper">

        <app-header></app-header>

        <app-menu></app-menu>

        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">
                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="page-title">Blank Page</h4>
                            <ol class="breadcrumb">
                                <li>
                                    <a href="#">Ubold</a>
                                </li>
                                <li>
                                    <a href="#">Pages</a>
                                </li>
                                <li class="active">
                                    Blank Page
                                </li>
                            </ol>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <div class="row">
                                        <router-view></router-view>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- container -->

            </div> <!-- content -->

            <footer class="footer">
                2015 © Ubold.
            </footer>
        </div>

    </div>
</template>

<script>
    import Header from './components/Header.vue';
    import Menu from './components/Menu.vue';
    export default {
        components: {
            appHeader: Header,
            appMenu: Menu,
        }
    }
</script>
