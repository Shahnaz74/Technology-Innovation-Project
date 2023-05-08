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

    <?php include 'script.php' ?>
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