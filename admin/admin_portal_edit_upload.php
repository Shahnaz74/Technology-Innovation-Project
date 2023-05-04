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
                <header id="form-header" class="row mx-0 mb-4 sticky-top">
                    <div class="col-lg d-flex">
                        <h1 class="h3 primary-red">Edit Upload</h1>
                    </div>
                    <div class="col-lg-auto">
                        <button type="button" class="btn btn-outline-primary me-2"><i
                                class="bi bi-archive-fill pe-2 "></i>Move to
                            Archive</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle-fill pe-2"></i>Save &
                            Publish</button>
                    </div>
                </header>

                <!-- Page content -->
                <div class="row mx-0">

                    <!-- Uploader details -->
                    <div class="card uploaderDetailsCard mb-4">
                        <div class=" card-body">
                            <h5 class="card-title primary-red serif">Uploader Details</h5>
                            <p class="card-text">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">Name</th>
                                        <td>Uploader Name</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email</th>
                                        <td>uploaderemail@gmail.com
                                            <button type="button" class="btn primary-red">
                                                <i class="bi bi-envelope-fill"></i>
                                                Send email
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </p>
                        </div>
                    </div>

                    <form class="needs-validation" novalidate>

                        <!-- File name -->
                        <div class="mb-4">
                            <label for="fileName" class="form-label">File name <span
                                    class="mandatoryField">*</span></label>
                            <input type="text" class="form-control" id="fileName" placeholder=""
                                value="Rover Regent Motors Advertred 2" required>
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
                        <div class="fileUpload container mb-4 px-0">
                            <label for="documentType" class="form-label">File upload <span
                                    class="mandatoryField">*</span></label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="" aria-label=""
                                    aria-describedby="basic-addon2">
                                <button class="input-group-text deleteFileUpload" id="basic-addon2">
                                    <i class="bi bi-trash3-fill pe-2"></i>
                                    Delete file
                                </button>
                            </div>

                            <!-- Uploaad file preview -->
                            <div class="col-lg-4">
                                <img src="../img/uploadFileDummy.png" class="img-thumbnail" alt="...">
                            </div>
                        </div>

                        <!-- File keyword -->
                        <div class="col-md-4 mb-4">
                            <label class="mb-2" for="fileKeyword">Topic subject</label>
                            <p>
                                <select id="fileKeyword" name="fileKeyword" class="selectpicker" multiple
                                    multiselect-search="true">
                                    <option>Keyword 1</option>
                                    <option>Keyword 2</option>
                                    <option>Keyword 3</option>
                                    <option>Keyword 4</option>
                                    <option>Keyword 5</option>
                                    <option>Keyword 6</option>
                                    <option>Keyword 7</option>
                                    <option>Keyword 8</option>
                                    <option>Keyword 9</option>
                                    <option>Keyword 10</option>
                                </select>
                            </p>


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
                                <input type="text" class="form-control" id="fileIdentifier" placeholder="DD/MM/YYYY">
                            </div>
                        </div>

                        <div class="row mb-4">

                            <!-- File publish date -->
                            <div class="col-lg-6">
                                <label for="publishedDate" class="form-label">Published date <span
                                        class="mandatoryField">*</span></label>
                                <input type="text" class="form-control" id="publishedDate" placeholder="">
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