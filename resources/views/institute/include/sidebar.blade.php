<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li>
                    <a href="{{ route('institute.dashboard') }}" class="{{ Request::is('institute/dashboard')? 'active' : '' }}">
                        <i class="lnr lnr-home"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('institute/categories') }}" class="{{ Request::is('institute/categories') || Request::is('institute/categories/*')? 'active' : '' }}">
                        <i class="lnr lnr-list"></i> <span>Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('institute/concepts') }}" class="{{ Request::is('institute/concepts') || Request::is('institute/concepts/*')? 'active' : '' }}">
                        <i class="lnr lnr-dice"></i> <span>Concepts</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('institute/sub-concepts') }}" class="{{ Request::is('institute/sub-concepts') || Request::is('institute/sub-concepts/*')? 'active' : '' }}">
                        <i class="lnr lnr-indent-increase"></i> <span>Sub Concepts</span>
                    </a> 
                </li>
                <li>
                    <a href="{{ url('institute/types') }}" class="{{ Request::is('institute/types') || Request::is('institute/types/*')? 'active' : '' }}">
                        <i class="lnr lnr-menu"></i> <span>Types</span>
                    </a>
                </li>  
                <li>
                    <a href="{{ url('institute/upload-worksheets') }}" class="{{ Request::is('institute/upload-worksheets') || Request::is('institute/upload-worksheets/*')? 'active' : '' }}">
                        <i class="lnr lnr-upload"></i><span>Upload Worksheet</span>
                    </a>
                </li>               
                <li>
                    <a href="{{ url('institute/worksheets') }}" class="{{ Request::is('institute/worksheets') || Request::is('institute/worksheets/*') || Request::is('institute/layouts/*') ? 'active' : '' }}">
                        <i class="lnr lnr-file-add"></i><span>Generate Worksheet</span>
                    </a>
                </li>                
                <li>
                    <a href="{{ url('institute/edit-worksheets') }}" class="{{ Request::is('institute/edit-worksheets') || Request::is('institute/edit-worksheets/*')? 'active' : '' }}">
                        <i class="lnr lnr-file-add"></i><span>Edit Worksheet</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('institute/class') }}" class="{{ Request::is('institute/class') || Request::is('institute/class/*')? 'active' : '' }}">
                        <i class="lnr lnr-chart-bars"></i><span>Class</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('institute/teachers') }}" class="{{ Request::is('institute/teachers') || Request::is('institute/teachers/*')? 'active' : '' }}">
                        <i class="lnr lnr-users"></i><span>Teachers</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('institute/students') }}" class="{{ Request::is('institute/students') || Request::is('institute/students/*')? 'active' : '' }}">
                        <i class="lnr lnr-users"></i><span>Students</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>