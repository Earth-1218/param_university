 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <a href="{{ url('/') }}" class="brand-link text-decoration-none ">
         <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
     </a>
     <div class="sidebar" style="overflow-y:auto; max-height:80vh; scrollbar-width: 0rem !important">
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fa fa-square"></i>
                         <p>Dashboard</p>
                     </a>
                 </li>
                 <li
                     class="nav-item has-treeview {{ Request::is('courses/*') || Request::is('subjects/*') || Request::is('lessons/*') || Request::is('categories/*') || Request::is('lectures/*') ? 'active' : '' }}">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fa fa-square"></i>
                         <p>
                             Academic
                             <i class="menu-dropdown right fa fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview" style="display: none;">
                         <li class="ml-3 nav-item {{ Request::is('courses/*') ? 'active' : '' }}">
                             <a href="{{ route('courses.index') }}" class="nav-link">
                                 <i class="nav-icon fa fa-circle"></i>
                                 <p>Courses</p>
                             </a>
                         </li>
                         <li class="ml-3 nav-item {{ Request::is('subjects/*') ? 'active' : '' }}">
                             <a href="{{ route('subjects.index') }}" class="nav-link">
                                 <i class="nav-icon fa fa-circle"></i>
                                 <p>Subjects</p>
                             </a>
                         </li>
                         <li class="ml-3 nav-item {{ Request::is('lessons/*') ? 'active' : '' }}">
                             <a href="{{ route('lessons.index') }}" class="nav-link">
                                 <i class="nav-icon fa fa-circle"></i>
                                 <p>Lessons</p>
                             </a>
                         </li>
                         <li class="ml-3 nav-item {{ Request::is('categories/*') ? 'active' : '' }}">
                             <a href="{{ route('categories.index') }}" class="nav-link">
                                 <i class="nav-icon fa fa-circle"></i>
                                 <p>Categories</p>
                             </a>
                         </li>
                         <li class="ml-3 nav-item {{ Request::is('lectures/*') ? 'active' : '' }}">
                             <a href="{{ route('lectures.index') }}" class="nav-link">
                                 <i class="nav-icon fa fa-circle"></i>
                                 <p>Lectures</p>
                             </a>
                         </li>
                         <li class="ml-3 nav-item {{ Request::is('faculties/*') ? 'active' : '' }}">
                            <a href="{{ route('faculties.index') }}" class="nav-link">
                                <i class="nav-icon fa fa-circle"></i>
                                <p>Faculties</p>
                            </a>
                        </li>
                     </ul>
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
                 <li class="nav-item {{ Request::is('settings/*') ? 'active' : '' }}">
                     <a href="{{ route('settings.index') }}" class="nav-link">
                         <i class="nav-icon fa fa-square"></i>
                         <p>Settings</p>
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

             const academicDropdown = document.querySelector('.has-treeview');
             const academicDropdownLink = academicDropdown.querySelector('.nav-link');
             const academicDropdownMenu = academicDropdown.querySelector('.nav-treeview');

             if (academicDropdownLink) {
                 academicDropdownLink.addEventListener('click', (e) => {
                     e.preventDefault();

                     // Toggle the classes on a specific child element of the link
                     const icon = academicDropdownLink.querySelector('.menu-dropdown'); // Replace '.icon-class' with the correct class
                     if (icon) {
                         icon.classList.toggle('fa-angle-left');
                         icon.classList.toggle('fa-angle-down');
                     }

                     // Toggle the dropdown menu display
                     if (academicDropdownMenu) {
                         academicDropdownMenu.style.display = academicDropdownMenu.style.display === 'none' ?
                             'block' : 'none';
                     }
                 });
             }
         });
     </script>
 @endpush
