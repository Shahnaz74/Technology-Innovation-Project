<?php
$current_url = $_SERVER['REQUEST_URI'];
// echo $CurPageURL;
$new = explode('/',$current_url);
// echo "<pre>";
// print_r($new);
$new_url = $new[3];
// echo "The URL of current page: ". $CurPageURL;
?>
<nav id="sidebar">
            <div class="container text-center pb-4">
                <img class="img-fluid px-4 pb-2" src="../img/rcca-logo.png" alt="">
                <p class="primary-red serif">Admin Portal</p>
            </div>
            <ul class="list-group">
                <li class="list-group-item list-group-item-action sidebar-list-group-item <?php echo $new_url == 'dashboard.php' ? 'active' :''; ?>"> 
                    <a href="dashboard.php">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <i class="bi bi-file-earmark-text-fill me-2"></i>
                            <span>Dashboard</span>
                        </div>
                    </a>
                </li>
                <li class="list-group-item list-group-item-action sidebar-list-group-item <?php echo $new_url == 'admin_portal_uploads.php' ? 'active' :''; ?>">
                    <a href="admin_portal_uploads.php">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <i class="bi bi-cloud-arrow-up-fill me-2"></i>
                            <span>Uploads</span>
                        </div>
                    </a>
                </li>
                <li class="list-group-item list-group-item-action sidebar-list-group-item <?php echo $new_url == 'admin_portal_templates.php' ? 'active' :''; ?>">
                    <a href="admin_portal_templates.php">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <i class="bi bi-grid-1x2-fill me-2"></i>
                            <span>Templates</span>
                        </div>
                    </a>
                </li>
            </ul>
        </nav>