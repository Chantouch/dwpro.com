<template>
    <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">
            <!--- Divider -->
            <div id="sidebar-menu">
                <ul>
                    <li class="text-muted menu-title">Navigation</li>
                    <li class="has_sub">
                        <a href="#" class="waves-effect waves-light"><i class="ti-home"></i>
                            <span> Dashboard </span>
                        </a>
                        <ul class="list-unstyled">
                            <li><a href="#">Dashboard</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="#" class="waves-effect waves-light"><i class="ti-home"></i>
                            <span>Modules</span>
                        </a>
                        <ul class="list-unstyled">
                            <li>
                                <router-link to="/admin/modules/business-types">Business Types</router-link>
                            </li>
                            <li>
                                <router-link to="/admin/modules/city-provinces">City/Provinces</router-link>
                            </li>
                            <li>
                                <router-link to="/admin/modules/departments">Departments</router-link>
                            </li>
                            <li>
                                <router-link to="/admin/modules/functions">Functions</router-link>
                            </li>
                            <li>
                                <router-link to="/admin/modules/industries">Industries</router-link>
                            </li>
                            <li>
                                <router-link to="/admin/modules/qualifications">Qualifications</router-link>
                            </li>
                            <li>
                                <router-link to="/admin/modules/levels">Levels</router-link>
                            </li>
                            <li>
                                <router-link to="/admin/modules/languages">Languages</router-link>
                            </li>
                            <li>
                                <router-link to="/admin/modules/positions">Positions</router-link>
                            </li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="#" class="waves-effect waves-light"><i class="ti-home"></i>
                            <span>Employees</span>
                        </a>
                        <ul class="list-unstyled">
                            <li>
                                <a href="#">All</a>
                            </li>
                            <li>
                                <a href="#">UnActive</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</template>


<style>

</style>