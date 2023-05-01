<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal - Edit Upload</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,400;0,700;1,400;1,700&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/releases/v6.4.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/custom-css.css">

    <!-- Bootstrap JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>

    <script src="../js/multiselect-dropdown.js"></script>
    <!-- Custom JS -->
    <script defer src="../js/custom-js.js"></script>
</head>

<body id="page-top">
    <div class="wrapper">

        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="container text-center pb-4">
                <img class="img-fluid px-4 pb-2" src="../img/rcca-logo.png" alt="">
                <p class="primary-red serif">Admin Portal</p>
            </div>
            <ul class="list-group">

                <li class="list-group-item list-group-item-action sidebar-list-group-item active">
                    <a href="./admin_portal_records.html">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <i class="bi bi-file-earmark-text-fill me-2"></i>
                            <span>Records</span>
                        </div>
                    </a>
                </li>
                <li class="list-group-item list-group-item-action sidebar-list-group-item">
                    <a href="./admin_portal_uploads.html">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <i class="bi bi-cloud-arrow-up-fill me-2"></i>
                            <span>Uploads</span>
                        </div>
                    </a>
                </li>
                <li class="list-group-item list-group-item-action sidebar-list-group-item">
                    <a href="./admin_portal_templates.html">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <i class="bi bi-grid-1x2-fill me-2"></i>
                            <span>Templates</span>
                        </div>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <!-- Topnav -->
            <nav class="navbar navbar-expand-lg border-bottom mb-5">
                <div class="container-fluid">

                    <!-- Sidebar toggle -->
                    <button type="button" id="sidebarCollapse" class="btn primary-neutal-800">
                        <i class="bi bi-list"></i>
                        <span>Toggle Menu</span>
                    </button>

                    <nav class="navbar navbar-expand">

                        <!-- Navbar-->
                        <ul class="navbar-nav ml-auto">

                            <!-- Top Navbar items - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <span class="primary-neutal-800 mr-2">Admin Name</span>
                                    <img class="img-profile rounded-circle" src="../img/undraw_profile.svg"
                                        style="width: 32px; height: 32px;">
                                </a>

                                <!-- Top Navbar items Dropdown -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw primary-neutal-800 mr-2"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </nav>

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

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
</body>


</html>