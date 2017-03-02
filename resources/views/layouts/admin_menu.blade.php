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
                <a href="{!! route('admin.modules.business-types.index') !!}">Business Types</a>
            </li>
            <li>
                <a href="{!! route('admin.modules.city-provinces') !!}">Cities/Provinces</a>
            </li>
            <li>
                <a href="{!! route('admin.modules.departments') !!}">Departments</a>
            </li>
            <li>
                <a href="{!! route('admin.modules.functions') !!}">Functions</a>
            </li>
            <li>
                <a href="{!! route('admin.modules.industries') !!}">Industries</a>
            </li>
            <li>
                <a href="{!! route('admin.modules.qualifications') !!}">Qualifications</a>
            </li>
            <li>
                <a href="{!! route('admin.modules.levels') !!}">Levels</a>
            </li>
            <li>
                <a href="{!! route('admin.modules.languages') !!}">Languages</a>
            </li>
            <li>
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
                <a href="#">UnActive</a>
            </li>
        </ul>
    </li>
</ul>