<?php include 'head.php'; ?>

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
                <header id="form-header" class="row mx-0 mb-4 sticky-top">
                    <div class="col-lg d-flex">
                        <h1 class="h3 primary-red">New Record</h1>
                    </div>
                    <div class="col-lg-auto">
                        <button type="button" class="btn btn-outline-primary me-2"><i
                                class=" bi bi-archive-fill pe-2 "></i>Save to
                            Archive</button>
                        <button type=" submit" class="btn btn-primary"><i
                                class="bi bi-check-circle-fill pe-2"></i>Publish</button>
                    </div>
                </header>

                <!-- Page content -->
                <div class="row mx-0">
                    <form class="needs-validation" novalidate>

                        <!-- File name -->
                        <div class="mb-4">
                            <label for="fileName" class="form-label">File name <span
                                    class="mandatoryField">*</span></label>
                            <input type="text" class="form-control" id="fileName" placeholder="" required>
                            <div class="invalid-feedback">
                                File name is required
                            </div>
                        </div>

                        <!-- Document type -->
                        <div class="col-md-3 mb-4">
                            <label for="documentType" class="form-label">Document type</label>
                            <select class="form-select" id="documentType" required>
                                <option selected disabled value="">Choose...</option>
                                <option>Advertisement Journal</option>
                                <option>Advertisement Newspaper</option>
                                <option>Article Journal</option>
                                <option>Article Newspaper
                                </option>
                                <option>Book Historical
                                </option>
                                <option>Book Technical</option>
                                <option>Photograph Commercial
                                </option>
                                <option>Photograph Personal
                                </option>
                                <option>Sales Brochure
                                </option>
                                <option>Sales Record
                                </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select document type.
                            </div>
                        </div>

                        <!-- File upload -->
                        <div class="container mb-4 px-0">

                        </div>

                        <div class="row">

                            <!-- File publisher -->
                            <div class="col-lg-6 mb-4">
                                <label for="filePublisher" class="form-label">Publisher</label>
                                <input type="text" class="form-control" id="filePublisher" placeholder="">
                            </div>

                            <!-- File identifier -->
                            <div class="col-lg-6 mb-4">
                                <label for="fileIdentifier" class="form-label">Identifier <span
                                        class="mandatoryField">*</span></label>
                                <input type="text" class="form-control" id="fileIdentifier" placeholder="">
                            </div>
                        </div>

                        <div class="row mb-4">

                            <!-- File publish date -->
                            <div class="col-lg-6">
                                <label for="publishedDate" class="form-label">Published date <span
                                        class="mandatoryField">*</span></label>
                                <input type="text" class="form-control" id="publishedDate" placeholder="DD/MM/YYYY">
                            </div>
                        </div>

                        <!-- File description -->
                        <div class="mb-4">
                            <label for="fileDescription">Description</label>
                            <textarea class="form-control" rows="10" id="fileDescription"></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include 'script.php' ?>
</body>


</html>