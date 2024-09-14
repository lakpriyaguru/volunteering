<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">

        <span class="brand-text font-weight-light">Volunteering | Admin</span>
    </a>
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/manager.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    <?php echo $_SESSION['adminName']; ?>
                </a>
            </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <!----- Tables--->
                <li class="nav-item">
                    <a href="orgManage.php" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Organizations</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="userManage.php" class="nav-link">
                        <i class="nav-icon fas fa-hands-helping"></i>
                        <p>Volunteers </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-calendar-check"></i>
                        <p>Events
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <!-- <li class="nav-item">
                            <a href="eventAdd.php" class="nav-link">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Add</p>
                            </a>
                        </li> -->

                        <li class="nav-item">
                            <a href="eventApproval.php" class="nav-link">
                                <i class="fas fa-check-double nav-icon"></i>
                                <p>Pending Approval</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="eventManage.php" class="nav-link">
                                <i class="fas fa-edit nav-icon"></i>
                                <p>Manage</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!--Profile--->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Account Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="profile.php" class="nav-link">
                                <i class="far fa-user nav-icon"></i>
                                <p>Profile</p>
                            </a>
                        </li>

                        <!-- <li class="nav-item">
                            <a href="change-password.php" class="nav-link">
                                <i class="fas fa-key nav-icon"></i>
                                <p>Change Password</p>
                            </a>
                        </li> -->

                        <li class="nav-item">
                            <a href="logout.php" class="nav-link">
                                <i class="fas fa-sign-out-alt nav-icon"></i>
                                <p>Logout</p>
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>