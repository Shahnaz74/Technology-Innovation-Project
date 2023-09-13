<?php include 'head.php'; ?>

<!-- Toast message -->
<div class="toast-container position-absolute bottom-0 end-0 p-3">
    <div class=" toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
        <div class="toast-header">
            <i class="bi bi-check-circle-fill primary-green-darker pe-2"></i>
            <strong class="primary-green-darker me-auto">Record Added Successfully</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Regent Motors Advertisment has been to the digital archive.
        </div>
    </div>
</div>

<body id="page-top">
    <div class="wrapper">

        <!-- Sidebar  -->
    <?php include 'sidebar.php'; ?>

        <!-- Page Content  -->
        <div id="content">

            <!-- Topnav -->
            <?php include 'admin_header.php' ?>

            <div class="container-fluid">

                <!-- Page header -->
                <div class="row mx-0 mb-4">
                    <div class="col-lg d-flex px-0">
                        <h1 class="h3 primary-red mb-0">Records</h1>
                        <form class="form-inline ms-4">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Search for..."
                                    aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                                        class="bi bi-search pe-2"></i>Search</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-auto">
                        <a href="admin_portal_submit_record.php">
                            <button type="button" class="btn btn-primary"><i class="bi bi-plus-lg pe-2"></i></i>Add New
                                Record</button></a>
                    </div>
                </div>

                <!-- Page content -->
                <div class="row mx-0">

                    <!-- Tab menu -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="published-tab" data-bs-toggle="tab"
                                data-bs-target="#published-tab-pane" type="button" role="tab"
                                aria-controls="published-tab-pane" aria-selected="true">Published</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="archived-tab" data-bs-toggle="tab"
                                data-bs-target="#archived-tab-pane" type="button" role="tab"
                                aria-controls="archived-tab-pane" aria-selected="false">Archived</button>
                        </li>
                    </ul>

                    <!-- Tab content -->
                    <div class="tab-content px-0" id="myTabContent">

                        <!-- Published content -->
                        <div class="tab-pane fade show active" id="published-tab-pane" role="tabpanel"
                            aria-labelledby="published-tab" tabindex="0">
                            <table class="table table-striped table-hover">
                                <!-- Table header -->
                                <!-- <thead>
                                    <tr>
                                        <th scope="col">File name</th>
                                        <th scope="col">Views</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead> -->
                                <!-- Record listing content -->
                                <tbody>
                                    <tr class="align-middle">
                                        <th scope="row" width="60%">
                                            <p class="recordFileName mb-0">Rover Regent Motors Advertred 2</p>
                                            <p class="recordCategory mb-0"><img src="../img/recordCat_advertisment.svg"
                                                    alt="Custom SVG" class="pe-1">Advertisement</p>
                                        </th>
                                        <td><span>10</span> Views</td>
                                        <td>
                                            <button type="button" class="btn neutral-outlin-btn me-lg-2"><a
                                                    href="admin_portal_edit_record.php">
                                                    <i class="bi bi-pencil-fill pe-2"></i>Edit
                                                </a></button>
                                            <button type="button" class="btn neutral-outlin-btn"><i
                                                    class="bi bi-trash3-fill pe-2"></i>Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Archive content -->
                        <div class="tab-pane fade" id="archived-tab-pane" role="tabpanel" aria-labelledby="archived-tab"
                            tabindex="0">
                            Tab 2 content
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'script.php' ?>
</body>


</html>