<?php $page = Route::currentRouteName(); ?>
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('dashboard.categories.index') }}" <?php if($page=="dashboard.categories.index") { ?> class="nav-link active"
                        <?php   } else {  ?> class="nav-link" <?php } ?>>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Show Categories</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.categories.create') }}" <?php if($page=="dashboard.categories.create") { ?> class="nav-link active"
                        <?php   }  else {  ?> class="nav-link" <?php } ?>>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Create Category</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Simple Link
                    <span class="right badge badge-danger">New</span>
                </p>
            </a>
        </li>
    </ul>
</nav>
