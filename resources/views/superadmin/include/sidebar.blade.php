<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li>
                    <a href="{{ route('superadmin.dashboard') }}" class="{{ Request::is('superadmin/dashboard')? 'active' : '' }}">
                        <i class="lnr lnr-home"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('superadmin/categories') }}" class="{{ Request::is('superadmin/categories') || Request::is('superadmin/categories/*')? 'active' : '' }}">
                        <i class="lnr lnr-list"></i> <span>Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('superadmin/concepts') }}" class="{{ Request::is('superadmin/concepts') || Request::is('superadmin/concepts/*')? 'active' : '' }}">
                        <i class="lnr lnr-dice"></i> <span>Concepts</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('superadmin/sub-concepts') }}" class="{{ Request::is('superadmin/sub-concepts') || Request::is('superadmin/sub-concepts/*')? 'active' : '' }}">
                        <i class="lnr lnr-indent-increase"></i> <span>Sub Concepts</span>
                    </a> 
                </li>
                <li>
                    <a href="{{ url('superadmin/types') }}" class="{{ Request::is('superadmin/types') || Request::is('superadmin/types/*')? 'active' : '' }}">
                        <i class="lnr lnr-menu"></i> <span>Types</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('superadmin/upload-worksheets') }}" class="{{ Request::is('superadmin/upload-worksheets') || Request::is('superadmin/upload-worksheets/*')? 'active' : '' }}">
                        <i class="lnr lnr-upload"></i><span>Upload Worksheet</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('superadmin/worksheets') }}" class="{{ Request::is('superadmin/worksheets') || Request::is('superadmin/worksheets/*') || Request::is('superadmin/layouts/*') ? 'active' : '' }}">
                        <i class="lnr lnr-file-add"></i><span>Generate Worksheet</span>
                    </a>
                </li>                
                <li>
                    <a href="{{ url('superadmin/edit-worksheets') }}" class="{{ Request::is('superadmin/edit-worksheets') || Request::is('superadmin/edit-worksheets/*')? 'active' : '' }}">
                        <i class="lnr lnr-file-add"></i><span>Edit Worksheet</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('superadmin/admins') }}" class="{{ Request::is('superadmin/admins') || Request::is('superadmin/admins/*')? 'active' : '' }}">
                        <i class="lnr lnr-users"></i><span>Admins (Clients)</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>