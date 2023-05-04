<?php include 'head.php'; ?>

<body id="page-top">
    <div class="wrapper">

        <!-- Sidebar  -->
        <?php include 'sidebar.php'; ?>

        <!-- Page Content  -->
        <div id="content">
            <?php
                if(isset($_POST['submit'])){
                    echo "<pre>";
                    print_r($_POST);
                }
            ?>
            <!-- Topnav -->
            <?php include 'header.php' ?>
            <div class="container-fluid">
            <form class="needs-validation" method="POST" novalidate>
                <!-- Page header -->
                <header id="form-header" class="row mx-0 mb-4 sticky-top">
                    <div class="col-lg d-flex">
                        <h1 class="h3 primary-red">Add Template</h1>
                    </div>
                    <div class="col-lg-auto">
                        <button type="button" class="btn btn-outline-primary me-2"><i
                                class="bi bi-trash3-fill pe-2"></i>Delete Template</button>
                        <button type="submit" name="submit" class="btn btn-primary"><i class="bi bi-check-circle-fill pe-2"></i>Save &
                            Publish</button>
                    </div>
                </header>

                <!-- Page content -->
                <div class="row mx-0">
                   

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
                        <!-- <div class="row mb-4">
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
                        </div> -->

                        <div class="templateFields">

                            <!-- Template field header -->
                            <div class="row align-items-center mx-0 px-0">
                                <div class="col-lg d-flex px-0">
                                    <p>Template fields</p>
                                </div>
                                <div class="col-lg-auto px-0">
                                    <button type="button" class="btn btn-outline-primary mb-4" id="addRow1"
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
                                            <td class="fixed-col"><i class="bi bi-arrows-move pe-2"></i>1</td>
                                            <!-- <td><span class="js-sort-number">1</span>
                                            </td> -->

                                              <!-- Data field selection -->
                                              <td><select class="form-select" name="type" aria-label="Default select example">
                                                    <option value="" selected>Select Field Type</option>
                                                    <option value="text">text</option>
                                                    <option value="email">email</option>
                                                    <option value="date">date</option>
                                                </select></td>

                                            <td><input type="text" class="form-control" name="title" placeholder="Enter Field Title"></td>

                                            <td><input type="hidden" class="form-control" name="name[]" value="field1" readonly></td>

                                            <!-- Mandatory field -->
                                            <td><input class="form-check-input mt-0 me-2" name="is_required" type="checkbox" value="1"
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
                                            <td class="fixed-col"><i class="bi bi-arrows-move pe-2"></i>2</td>
                                            <!-- <td><span class="js-sort-number">1</span>
                                            </td> -->

                                        <!-- Data field selection -->
                                        <td><select class="form-select" name="type" aria-label="Default select example">
                                                    <option selected>Select Field Type</option>
                                                    <option value="text">text</option>
                                                    <option value="email">email</option>
                                                    <option value="date">date</option>
                                                </select></td>
                                            
                                           <td><input type="text" name="title" class="form-control" placeholder="Enter Field Title"></td>

                                            <td><input type="hidden" class="form-control" name="name[]" value="field2" readonly></td>

                                            

                                            <!-- Mandatory field -->
                                            <td><input class="form-check-input mt-0 me-2" name="is_required" type="checkbox" value="1"
                                                    id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Mandatory field
                                                </label>
                                            </td>
                                            <input type="hidden" id="row_count" value="2">
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
                    
                    </div>
                </form>
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
    <script>
        $("#addRow1").click(function () {
    //Add row
    row = "";
    var row_count = $('#row_count').val();
    row_count++;
    var field_count = 'field'+row_count;
    
    row +=
      // '<tr><td><input type="text" class="form-control"></td><td ><input type="date" class="form-control"></td><td><input type="date" class="form-control"></td><td><input type="number" class="form-control"></td>';
      '<tr class="draggable-item"><td class="fixed-col"><i class="bi bi-arrows-move pe-2"></i>'+row_count+'</td><td><select class="form-select" name="type" aria-label="Default select example"><option selected>Select Field Type</option><option value="text">text</option><option value="email">email</option><option value="date">date</option></select></td><td><input type="text" class="form-control" name="title" placeholder="Enter Field Title"></td><td><input type="hidden" class="form-control" name="name[]" value="'+field_count+'" readonly></td><!-- Mandatory field --><td><input class="form-check-input mt-0 me-2" name="is_required" type="checkbox" value="1" id="flexCheckDefault"><label class="form-check-label" for="flexCheckDefault">Mandatory field</label></td>';
    row +=
      // '<td><button class="btn btn-outline-danger delete_row">remove</button></td></tr>';
      '<td><button type="button" class="btn neutral-outlin-btn deleteRow"><i class="bi bi-trash3-fill pe-2"></i>Delete field</button></td></tr>';
    $("tbody").append(row);
    $('#row_count').val(row_count);
  });
    </script>
</body>


</html>