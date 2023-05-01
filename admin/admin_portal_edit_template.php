<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal - Edit Template</title>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>

    <!-- File keyword selector JS -->
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

                <li class="list-group-item list-group-item-action sidebar-list-group-item">
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
                <li class="list-group-item list-group-item-action sidebar-list-group-item active">
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
                        <h1 class="h3 primary-red">Edit Template</h1>
                    </div>
                    <div class="col-lg-auto">
                        <button type="button" class="btn btn-outline-primary me-2"><i
                                class="bi bi-trash3-fill pe-2"></i>Delete Template</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle-fill pe-2"></i>Save &
                            Publish</button>
                    </div>
                </header>

                <!-- Page content -->
                <div class="row mx-0">
                    <form class="needs-validation" novalidate>

                        <!-- Template name -->
                        <div class="mb-4">
                            <label for="templateName" class="form-label">Template name <span
                                    class="mandatoryField">*</span></label>
                            <input type="text" class="form-control" id="templateName" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                File name is required
                            </div>
                        </div>

                        <!-- Template icon -->
                        <div class="row mb-4">
                            <p>Template icon</p>

                            <div class="col">
                                <div class="btn-group templateIconSelect" role="group"
                                    aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check active selectedTemplateIcon" name="btnradio"
                                        id="btnradio1" autocomplete="off" checked>
                                    <label class="btn btn-outline-primary" for="btnradio1">
                                        <img src="../img/recordCat_advertisment2.svg" alt="">
                                    </label>
                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2"
                                        autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btnradio2">
                                        <img src="../img/recordCat_article.svg" alt="">
                                    </label>
                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3"
                                        autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btnradio3">
                                        <img src="../img/recordCat_book.svg" alt="">
                                    </label>
                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio4"
                                        autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btnradio4">
                                        <img src="../img/recordCat_photos.svg" alt="">
                                    </label>
                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio5"
                                        autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btnradio5">
                                        <img src="../img/recordCat_sales_brochure.svg" alt="">
                                    </label>
                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio6"
                                        autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btnradio6">
                                        <img src="../img/recordCat_sales_records.svg" alt="">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="templateFields">

                            <!-- Template field header -->
                            <div class="row align-items-center mx-0 px-0">
                                <div class="col-lg d-flex px-0">
                                    <p>Template fields</p>
                                </div>
                                <div class="col-lg-auto px-0">
                                    <button type="button" class="btn btn-outline-primary mb-4" id="addRow"
                                        class="add"><i class="bi bi-plus-lg pe-2"></i>
                                        Add data
                                        field
                                    </button>
                                </div>
                            </div>

                            <!-- Template field table -->
                            <div class="table-responsive">
                                <table id="templateFieldTable" class="table table-hover" data-toggle="table"
                                    data-mobile-responsive="true">
                                    <tbody class="connected-sortable droppable-area1">
                                        <tr class="draggable-item">

                                            <!-- Drag icon & row number -->
                                            <td class="fixed-col"><i class="bi bi-arrows-move pe-2"></i>Row number</td>
                                            <!-- <td><span class="js-sort-number">1</span>
                                            </td> -->

                                            <!-- Data field selection -->
                                            <td><select class="form-select" aria-label="Default select example">
                                                    <option selected>Select data field</option>
                                                    <option value="1">Data field 1</option>
                                                    <option value="2">Data field 2</option>
                                                    <option value="3">Data field 3</option>
                                                </select></td>

                                            <!-- Mandatory field -->
                                            <td><input class="form-check-input mt-0 me-2" type="checkbox" value=""
                                                    id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Mandatory field
                                                </label>
                                            </td>

                                            <!-- Delete row -->
                                            <td>
                                                <button type="button" class="btn btn-secondary disabled"><i
                                                        class="bi bi-trash3-fill pe-2"></i>Delete field</button>
                                            </td>
                                        </tr>

                                        <tr class="draggable-item">

                                            <!-- Drag icon & row number -->
                                            <td class="fixed-col"><i class="bi bi-arrows-move pe-2"></i>Row number</td>
                                            <!-- <td><span class="js-sort-number">1</span>
                                            </td> -->

                                            <!-- Data field selection -->
                                            <td><select class="form-select" aria-label="Default select example">
                                                    <option selected>Select data field</option>
                                                    <option value="1">Data field 1</option>
                                                    <option value="2">Data field 2</option>
                                                    <option value="3">Data field 3</option>
                                                </select></td>

                                            <!-- Mandatory field -->
                                            <td><input class="form-check-input mt-0 me-2" type="checkbox" value=""
                                                    id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Mandatory field
                                                </label>
                                            </td>

                                            <!-- Delete row -->
                                            <td>
                                                <button type="button" class="btn btn-secondary disabled"><i
                                                        class="bi bi-trash3-fill pe-2"></i>Delete field</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
    <script src="../js/jquery.sortable.js"></script>
    <script>
        $(function () {
            $('.table-sortable tbody').sortable({
                handle: 'span'
            });
        });
    </script>
</body>


</html>