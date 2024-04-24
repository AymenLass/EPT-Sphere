<aside class="main-sidebar elevation-2 sidebar-primary bg-white">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link navbar-primary">
        <img src="{{ asset('images/logos/icon.png') }}" alt="EPTSphere" class="brand-image">
        <span class="brand-text font-weight-ligh text-white">EPTSphere</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- SidebarSearch Form -->
        <div class="form-inline mt-2">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2 pb-5">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-header">core</li>

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link @if ($menu == 'Dashboard') active @endif">
                        <i class="nav-icon fas fa-chart-area"></i>
                        <p> Dashboard </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('notice.index') }}"
                        class="nav-link @if ($menu == 'Notice') active @endif">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p> Notices </p>
                    </a>
                </li>

                <li class="nav-item @if ($menu == 'Routine') menu-open @endif">
                    <a href="#" class="nav-link @if ($menu == 'Routine') active @endif">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p> Routines <i class="fas fa-angle-left right"></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('routines_xi.index') }}"
                                class="nav-link @if ($submenu == 'Routine_xi') active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>FirstY</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('routines_xii.index') }}"
                                class="nav-link @if ($submenu == 'Routine_xii') active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>SecondY</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item @if ($menu == 'Students') menu-open @endif">
                    <a href="#" class="nav-link @if ($menu == 'Students') active @endif">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p> Students <i class="fas fa-angle-left right"></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('students.index') }}"
                                class="nav-link @if ($submenu == 'Students') active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>All students</p>
                            </a>
                        </li>
                        {{-- #Ta9sim students --}}
                        <li class="nav-item">
                            <a href="{{ route('students_xi.index') }}"
                                class="nav-link @if ($submenu == 'FirstY') active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>FirstY</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('students_xii.index') }}"
                                class="nav-link @if ($submenu == 'XII') active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>SecondY</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hsc_examinee.index') }}"
                                class="nav-link @if ($submenu == 'HSC_Examinee') active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>ThirdY</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('students_old.index') }}"
                                class="nav-link @if ($submenu == 'Old_Student') active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Old students</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item @if ($menu == 'HSC_exam') menu-open @endif">
                    <a href="#" class="nav-link @if ($menu == 'HSC_exam') active @endif">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p> EPT Exam <i class="fas fa-angle-left right"></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('hsc.index') }}"
                                class="nav-link @if ($submenu == 'Current_year') active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Current year</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hsc.previous') }}"
                                class="nav-link @if ($submenu == 'Previous_records') active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Previous records</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item @if ($menu == 'Teachers') menu-open @endif">
                    <a href="#" class="nav-link @if ($menu == 'Teachers') active @endif">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p> Teachers <i class="fas fa-angle-left right"></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('teachers.index') }}"
                                class="nav-link @if ($submenu == 'All_Teachers') active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>All teachers</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ route('students_xi.index') }}"
                                class="nav-link @if ($submenu == 'Students_xi') active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Administrators</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('admin.teachers-science') }}"
                                class="nav-link @if ($submenu == 'Science') active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Science</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.teachers-Technologie') }}"
                                class="nav-link @if ($submenu == 'Technologie') active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Technologie</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.teachers-business') }}"
                                class="nav-link @if ($submenu == 'Business') active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Business</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- <li class="nav-item @if ($menu == 'Admission') menu-open @endif">
                    <a href="#" class="nav-link @if ($menu == 'Admission') active @endif">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p> Admission <i class="fas fa-angle-left right"></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admission.index') }}"
                                class="nav-link @if ($submenu == 'Manage_admission') active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Manage admission</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('security_code.index') }}"
                                class="nav-link @if ($submenu == 'Security_code') active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Security code</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- library --}}
                <li class="nav-item @if ($menu == 'Library_Dashboard') menu-open @endif">
                    <a href="#" class="nav-link @if ($menu == 'Library_Dashboard') active @endif">
                        <i class="nav-icon fas fa-book"></i>
                        <p> Library <i class="fas fa-angle-left right"></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard_lib') }}" class="nav-link @if ($submenu == '') active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item @if ($submenu == 'software' || $submenu == 'programming' || $submenu == 'database'|| $submenu == 'electronics'|| $submenu == 'networking') menu-open @endif">
                            <a href="#" class="nav-link @if ($submenu == 'software' || $submenu == 'programming' || $submenu == 'database'|| $submenu == 'electronics'|| $submenu == 'networking') active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p> Book List <i class="fas fa-angle-left right"></i> </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.book-list.programming') }}" class="nav-link @if ($submenu == 'programming') active @endif">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Programming</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.book-list.networking') }}" class="nav-link @if ($submenu == 'networking') active @endif">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Networking</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.book-list.database') }}" class="nav-link @if ($submenu == 'database') active @endif">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Database</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.book-list.electronics') }}" class="nav-link @if ($submenu == 'electronics') active @endif">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Electronics</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.book-list.software-development') }}" class="nav-link @if ($submenu == 'software') active @endif">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Software Development</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item @if ($submenu == 'add_new_shelf' || $submenu == 'update_shelf' || $submenu == 'remove_shelf') menu-open @endif">
                            <a href="#" class="nav-link @if ($submenu == 'add_new_shelf' || $submenu == 'update_shelf' || $submenu == 'remove_shelf') active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p> Shelf Management <i class="fas fa-angle-left right"></i> </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.add-shelf') }}" class="nav-link @if ($submenu == 'add_new_shelf') active @endif">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Add New Shelf</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.update-shelf') }}" class="nav-link @if ($submenu == 'update_shelf') active @endif">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Update Shelf</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.remove-shelf') }}" class="nav-link @if ($submenu == 'remove_shelf') active @endif">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Remove Shelf</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item @if ($submenu == 'remove_book' || $submenu == 'add_book' || $submenu == 'update_book') menu-open @endif">
                            <a href="#" class="nav-link @if ($submenu == 'remove_book' || $submenu == 'add_book' || $submenu == 'update_book') active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p> Book Management <i class="fas fa-angle-left right"></i> </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.remove-book') }}" class="nav-link @if ($submenu == 'remove_book') active @endif">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Remove Book</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.add-book') }}" class="nav-link @if ($submenu == 'add_book') active @endif">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Add Book</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.update-book') }}" class="nav-link @if ($submenu == 'update_book') active @endif">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Update Book</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.shelf-list') }}" class="nav-link @if ($submenu == "shelf_list") active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Shelf List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.student-request') }}" class="nav-link @if ($submenu == "student_requests") active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Student Request</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.book-order') }}" class="nav-link @if ($submenu == "book_order") active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Book Order</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.add_order') }}" class="nav-link @if ($submenu == "add_order") active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Add Order</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.book-received') }}" class="nav-link @if ($submenu == "book_received") active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Book Received</p>
                            </a>
                        </li>
                    </ul>
                </li>



                {{-- <li class="nav-header">others</li>

                <li class="nav-item @if ($menu == 'Download') menu-open @endif">
                    <a href="#" class="nav-link @if ($menu == 'Download') active @endif">
                        <i class="nav-icon fas fa-cloud-download-alt"></i>
                        <p> Download <i class="fas fa-angle-left right"></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.download.testimonial') }}"
                                class="nav-link @if ($submenu == 'Testimonial') active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Testimonial</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.download.tc') }}"
                                class="nav-link @if ($submenu == 'Transfer_Certificate') active @endif">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Transfer Certificate</p>
                            </a>

                        </li>
                    </ul>
                </li> --}}


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
