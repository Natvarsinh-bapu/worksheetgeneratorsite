<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ Request::is('admin/dashboard')? 'active' : '' }}">
                        <i class="lnr lnr-home"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin/categories') }}" class="{{ Request::is('admin/categories') || Request::is('admin/categories/*')? 'active' : '' }}">
                        <i class="lnr lnr-list"></i> <span>Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/concepts') }}" class="{{ Request::is('admin/concepts') || Request::is('admin/concepts/*')? 'active' : '' }}">
                        <i class="lnr lnr-dice"></i> <span>Concepts</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/sub-concepts') }}" class="{{ Request::is('admin/sub-concepts') || Request::is('admin/sub-concepts/*')? 'active' : '' }}">
                        <i class="lnr lnr-indent-increase"></i> <span>Sub Concepts</span>
                    </a> 
                </li>
                <li>
                    <a href="{{ url('admin/types') }}" class="{{ Request::is('admin/types') || Request::is('admin/types/*')? 'active' : '' }}">
                        <i class="lnr lnr-menu"></i> <span>Types</span>
                    </a>
                </li>
                 <li>
                    <a href="{{ url('admin/upload-worksheets') }}" class="{{ Request::is('admin/upload-worksheets') || Request::is('admin/upload-worksheets/*')? 'active' : '' }}">
                        <i class="lnr lnr-upload"></i><span>Upload Worksheet</span>
                    </a>
                </li>               
                <li>
                    <a href="{{ url('admin/worksheets') }}" class="{{ Request::is('admin/worksheets') || Request::is('admin/worksheets/*') || Request::is('admin/layouts/*') ? 'active' : '' }}">
                        <i class="lnr lnr-file-add"></i><span>Generate Worksheet</span>
                    </a>
                </li>                
                <li>
                    <a href="{{ url('admin/edit-worksheets') }}" class="{{ Request::is('admin/edit-worksheets') || Request::is('admin/edit-worksheets/*')? 'active' : '' }}">
                        <i class="lnr lnr-file-add"></i><span>Edit Worksheet</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/institutes') }}" class="{{ Request::is('admin/institutes') || Request::is('admin/institutes/*')? 'active' : '' }}">
                        <i class="lnr lnr-apartment"></i><span>Institutes</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>