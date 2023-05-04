<?php include 'head.php'; ?>

<!-- Toast message -->
<div class="toast-container position-absolute bottom-0 end-0 p-3">
    <div class=" toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
        <div class="toast-header">
            <i class="bi bi-check-circle-fill primary-green-darker pe-2"></i>
            <strong class="primary-green-darker me-auto">New Template Created</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Document template has been added and is ready to be used.
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
            <?php include 'header.php' ?>

            <div class="container-fluid">

                <!-- Page header -->
                <div class="row mx-0 mb-4">
                    <div class="col-lg d-flex px-0">
                        <h1 class="h3 primary-red mb-0">Templates</h1>
                    </div>
                    <div class="col-lg-auto">
                        <a href="admin_portal_create_template.php">
                            <button type="button" class="btn btn-primary"><i class="bi bi-plus-lg pe-2"></i></i>Add New
                                Template</button></a>
                    </div>
                </div>

                <!-- Page content -->
                <div class="row mx-0">

                    <table class="table table-striped table-hover">
                        <tbody>
                            <tr class="align-middle">
                                <th scope="row" width="40%">
                                    <p class="recordFileName mb-0"><img src="../img/recordCat_advertisment.svg"
                                            alt="Custom SVG" class="pe-1">Advertisement Journal</p>
                                </th>
                                <td class="recordCategory">Used in <span>10</span> Records</td>
                                <td>
                                    <button type="button" class="btn neutral-outlin-btn me-lg-2"><i
                                            class="fas fa-copy pe-2"></i>Duplicate Template</button>
                                    <button type="button" class="btn neutral-outlin-btn me-lg-2"><a
                                            href="admin_portal_edit_template.php">
                                            <i class="bi bi-pencil-fill pe-2"></i>Edit
                                        </a></button>
                                    <button type="button" class="btn neutral-outlin-btn"><i
                                            class="bi bi-trash3-fill pe-2"></i>Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include 'script.php' ?>
</body>


</html>