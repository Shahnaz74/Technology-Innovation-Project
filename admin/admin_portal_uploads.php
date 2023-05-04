<?php include 'head.php'; ?>

<body id="page-top">
    <div class="wrapper">

        <!-- Sidebar  -->
        <?php include 'sidebar.php'; ?>

        <!-- Page Content  -->
        <div id="content">

            <!-- Topnav -->
            <?php include 'header.php' ?>

            <div class="container-fluid">

                <!-- Page header -->
                <div class="row mx-0 mb-4">
                    <div class="col-lg d-flex px-0">
                        <h1 class="h3 primary-red mb-0">Uploads</h1>
                    </div>
                </div>

                <!-- Page content -->
                <div class="row mx-0">

                    <!-- Tab menu -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="published-tab" data-bs-toggle="tab"
                                data-bs-target="#published-tab-pane" type="button" role="tab"
                                aria-controls="published-tab-pane" aria-selected="true">New</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="archived-tab" data-bs-toggle="tab"
                                data-bs-target="#archived-tab-pane" type="button" role="tab"
                                aria-controls="archived-tab-pane" aria-selected="false">Archived</button>
                        </li>
                    </ul>

                    <!-- Tab content -->
                    <div class="tab-content px-0" id="myTabContent">

                        <!-- New upload -->
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
                                        <!-- File name & document type -->
                                        <th scope="row" width="40%">
                                            <p class="recordFileName mb-0">Upload file name</p>
                                            <p class="recordCategory mb-0"><img src="../img/recordCat_advertisment.svg"
                                                    alt="Custom SVG" class="pe-1">Advertisement</p>
                                        </th>

                                        <!-- Upload date -->
                                        <td>Uploaded at <span>DD/MM/YYYY</span></td>

                                        <!-- Uploader details -->
                                        <td scope="row">
                                            <p class="mb-0">Uploader name</p>
                                            <p class="mb-0">uploaderemail@gmail.com</p>
                                        </td>

                                        <!-- Action button -->
                                        <td>
                                            <button type="button" class="btn neutral-outlin-btn me-lg-2"><a
                                                    href="./admin_portal_edit_upload.html">
                                                    <i class="bi bi-pencil-fill pe-2"></i>Edit
                                                </a></button>
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