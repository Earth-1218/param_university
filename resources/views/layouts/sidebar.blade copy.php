 <!-- Sidebar -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4" >
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link text-decoration-none ">
        {{-- <img src="{{ asset('vendor/adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-square"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
          
                <li class="nav-item {{ Request::is('lessons/*') ? 'active' : '' }}">
                    <a href="{{ route('lessons.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-square"></i>
                        <p>Lessons</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('lectures/*') ? 'active' : '' }}">
                    <a href="{{ route('lectures.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-square"></i>
                        <p>Lectures</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('exams/*') ? 'active' : '' }}">
                    <a href="{{ route('exams.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-square"></i>
                        <p>Exams</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('events/*') ? 'active' : '' }}">
                    <a href="{{ route('events.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-square"></i>
                        <p>Events</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('management-staff/*') ? 'active' : '' }}">
                    <a href="{{ route('management-staff.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-square"></i>
                        <p>Management Staff</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('faculties/*') ? 'active' : '' }}">
                    <a href="{{ route('faculties.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-square"></i>
                        <p>Faculties</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('hostels/*') ? 'active' : '' }}">
                    <a href="{{ route('hostels.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-square"></i>
                        <p>Hostels</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('incomes/*') ? 'active' : '' }}">
                    <a href="{{ route('incomes.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-square"></i>
                        <p>Incomes</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('expenses/*') ? 'active' : '' }}">
                    <a href="{{ route('expenses.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-square"></i>
                        <p>Expenses</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('donations/*') ? 'active' : '' }}">
                    <a href="{{ route('donations.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-square"></i>
                        <p>Donations</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('courses/*') ? 'active' : '' }}">
                    <a href="{{ route('courses.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-square"></i>
                        <p>Courses</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('categories/*') ? 'active' : '' }}">
                    <a href="{{ route('categories.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-square"></i>
                        <p>Categories</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleButton = document.querySelector('[data-widget="pushmenu"]');
        const body = document.body;

        if (toggleButton) {
            toggleButton.addEventListener('click', (e) => {
                e.preventDefault();
                body.classList.toggle('sidebar-collapse');
                body.classList.toggle('sidebar-expanded');
            });
        }
    });
</script>
@endpush