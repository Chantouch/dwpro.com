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
        <a href="#" class="waves-effect waves-light {!! Request::is('admin/modules*') ? 'active' : '' !!}">
            <i class="ti-home"></i> <span>Modules</span>
        </a>
        <ul class="list-unstyled">
            <li class="{!! Request::is('admin/modules/business-types*')? 'active' : '' !!}">
                <a href="{!! route('admin.modules.business-types.index') !!}">Business Types</a>
            </li>
            <li class="{!! Request::is('admin/modules/city-provinces*')? 'active' : '' !!}">
                <a href="{!! route('admin.modules.city-provinces') !!}">Cities/Provinces</a>
            </li>
            <li class="{!! Request::is('admin/modules/departments*')? 'active' : '' !!}">
                <a href="{!! route('admin.modules.departments') !!}">Departments</a>
            </li>
            <li class="{!! Request::is('admin/modules/functions*')? 'active' : '' !!}">
                <a href="{!! route('admin.modules.functions') !!}">Functions</a>
            </li>
            <li class="{!! Request::is('admin/modules/industries*')? 'active' : '' !!}">
                <a href="{!! route('admin.modules.industries') !!}">Industries</a>
            </li>
            <li class="{!! Request::is('admin/modules/qualifications*')? 'active' : '' !!}">
                <a href="{!! route('admin.modules.qualifications') !!}">Qualifications</a>
            </li>
            <li class="{!! Request::is('admin/modules/levels*')? 'active' : '' !!}">
                <a href="{!! route('admin.modules.levels') !!}">Levels</a>
            </li>
            <li class="{!! Request::is('admin/modules/languages*')? 'active' : '' !!}">
                <a href="{!! route('admin.modules.languages') !!}">Languages</a>
            </li>
            <li class="{!! Request::is('admin/modules/positions*')? 'active' : '' !!}">
                <a href="{!! route('admin.modules.positions') !!}">Positions</a>
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
                <a href="#">InActive</a>
            </li>
        </ul>
    </li>

    <li class="has_sub">
        <a href="#" class="waves-effect waves-light"><i class="ti-home"></i>
            <span>Candidate</span>
        </a>
        <ul class="list-unstyled">
            <li>
                <a href="#">All</a>
            </li>
            <li>
                <a href="#">Approved</a>
            </li>
            <li>
                <a href="#">UnApproved</a>
            </li>
        </ul>
    </li>
</ul>