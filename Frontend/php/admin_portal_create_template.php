<?php include 'head.php'; ?>

<body id="page-top">
    <div class="wrapper">

        <!-- Sidebar  -->
        <?php include 'sidebar.php'; ?>

        <!-- Page Content  -->
        <div id="content">
            <?php
            if (isset($_POST['submit_template'])) {
                // print_r($_POST);
                $templatename = $_POST['templateName'];
                $select = "SELECT * FROM template where LOWER(template_name) = LOWER('" . $templatename . "')";
                // echo $select;die;
                $runQuery = mysqli_query($conn, $select);
                $rowcount = mysqli_num_rows($runQuery);
                if ($rowcount == 0) {
                    // $row = mysqli_fetch_assoc($runQuery);
                    // echo  $rowcount; print_r($row);die;
                    $sql = "INSERT INTO `template`(`template_name`) VALUES ('$templatename')";
                    $insert = mysqli_query($conn, $sql);
                    if ($insert) {
                        $_SESSION['message'] = "Templated Created Successfully";
                        header('Location:admin_portal_templates.php');
                    }
                } else {
                    $_SESSION['error'] = "Templated Already Exist.";
                }
            }


            if (isset($_POST['submit'])) {
                // echo "<pre>";
                // print_r($_POST);die;
                $template_id = $_POST['template_id'];
                $field_type = $_POST['type'];
                $field_title = $_POST['title'];
                $field_placeholder = $_POST['placeholder'];
                $field_required = $_POST['is_required'];
                $count = $_POST['row_count'];

                $res_arr_values = array();

                for ($i = 1; $i <= $count; $i++) {
                    if (empty($field_required[$i])) {
                        $field_required[$i] = 0;
                    }
                    $res_arr_values[$i] = [
                        'field_type' => $field_type[$i],
                        'field_title' => $field_title[$i],
                        'field_placeholder' => $field_placeholder[$i],
                        'field_required' => $field_required[$i],
                    ];
                }
                // print_r($res_arr_values);die;
                foreach ($res_arr_values as $val) {
                    $field_type = $val['field_type'];
                    $field_title = $val['field_title'];
                    $field_name = strtolower($val['field_title']);
                    $field_placeholder = $val['field_placeholder'];
                    $field_required = $val['field_required'];
                    $select = "SELECT * FROM fields where LOWER(name) = LOWER('" . $field_name . "') AND `template_id` = " . $template_id;

                    $runQuery = mysqli_query($conn, $select);
                    $rowcount = mysqli_num_rows($runQuery);
                    if ($rowcount == 0) {
                        $sql = "INSERT INTO `fields`(`type`, `title`, `name`,`placeholder`,`is_required`, `template_id`) VALUES ('$field_type','$field_title','$field_name','$field_placeholder','$field_required','$template_id')";
                        // echo $sql;die;
                        mysqli_query($conn, $sql);
                        $_SESSION['message'] = "Fields Added Successfully";
                        header('Location:admin_portal_fields.php?id=' . $template_id);

                    } else {
                        $select = "SELECT * FROM fields where LOWER(name) = LOWER('" . $field_name . "')";
                        $runQuery = mysqli_query($conn, $select);
                        $rowcount = mysqli_num_rows($runQuery);
                        if ($rowcount > 0) {
                            $row = mysqli_fetch_assoc($runQuery);
                            $id = $row['id'];
                            $sql = "UPDATE `fields` SET `type` = '$field_type' , `title` = '$field_title' ,`name` = '$field_name',`is_required` = '$field_required' , `template_id` = '$template_id' WHERE `id` = '$id'";
                            $runQuery = mysqli_query($conn, $sql);
                            $_SESSION['message'] = "Fields Added Successfully";
                            header('Location:admin_portal_fields.php?id=' . $template_id);

                        }
                    }
                    // print_r($res_arr_values);
                }
            }
            ?>
            <?php include 'message.php'; ?>

            <!-- Topnav -->
            <?php include 'admin_header.php' ?>
            <div class="container-fluid">
                <form class="needs-validation" method="POST">
                    <!-- Page header -->
                    <header id="form-header" class="row mx-0 mb-4 sticky-top">
                        <div class="col-lg d-flex">
                            <h1 class="h3 primary-red">Add Template</h1>
                        </div>
                    </header>
                    <!-- Page content -->
                    <div class="row mx-0">
                        <!-- Template name -->
                        <div class="mb-4">
                            <label for="templateName" class="form-label">Template name <span
                                    class="mandatoryField">*</span></label>
                            <input type="text" class="form-control" id="templateName" name="templateName"
                                placeholder="Enter Template Name" value="" required>
                            <div class="invalid-feedback">
                                File name is required
                            </div>
                        </div>
                        <div class="col-lg-auto">
                            <!-- <button type="button" class="btn btn-outline-primary me-2"><i class="bi bi-trash3-fill pe-2"></i>Delete Template</button> -->
                            <button type="submit" name="submit_template" value="Save Template"
                                class="btn btn-primary"><i class="bi bi-check-circle-fill pe-2"></i>Save
                                Template</button>
                        </div>
                    </div>

                </form>
                <?php if (isset($_GET['edit']) && $_GET['edit'] == 'add_fields') {
                    if (isset($_GET['id'])) {
                        $templateid = $_GET['id'];

                        ?>
                        <form method="POST">

                            <!-- Page header -->
                            <header id="form-header" class="row mx-0 mb-4 sticky-top mt-5">
                                <div class="col-lg d-flex">
                                    <h1 class="h3 primary-red">Add Fields</h1>
                                </div>
                            </header>

                            <div class="row mx-0">
                                <!-- Template icon -->


                                <div class="col">
                                    <div class="btn-group templateIconSelect" role="group"
                                        aria-label="Basic radio toggle button group">
                                        <select class="form-select" name="template_id" aria-label="Default select example"
                                            required>
                                            <option value="" selected>Select Template</option>
                                            <?php

                                            $select = "SELECT * FROM template";
                                            // echo $select;die;
                                            $runQuery = mysqli_query($conn, $select);
                                            $rowcount = mysqli_num_rows($runQuery);
                                            if ($rowcount > 0) {
                                                while ($row = mysqli_fetch_object($runQuery)) {
                                                    $tid = $row->template_id;
                                                    $templatename = $row->template_name;
                                                    ?>
                                                    <option value="<?php echo $tid; ?>" <?php echo $templateid == $tid ? 'selected' : '' ?>><?php echo $templatename; ?></option>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="templateFields">

                                    <!-- Template field header -->
                                    <div class="row align-items-center mx-0 px-0">
                                        <div class="col-lg d-flex px-0 mt-4">
                                            <label for="templatefileds" class="form-label">Template fields<span
                                                    class="mandatoryField">*</span></label>
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
                                                    <td><select class="form-select" name="type[1]"
                                                            aria-label="Default select example" required>
                                                            <option value="" selected>Select Field Type</option>
                                                            <option value="text">text</option>
                                                            <option value="email">email</option>
                                                            <option value="date">date</option>
                                                            <option value="textarea">textarea</option>
                                                        </select></td>

                                                    <!-- Data field selection -->
                                                    <td>
                                                        <select class="form-select" name="title[1]"
                                                            aria-label="Default select example" required>
                                                            <option value="" selected>Select Field Title</option>
                                                            <option value="Contributor">Contributor</option>
                                                            <option value="Coverage">Coverage</option>
                                                            <option value="Creator">Creator</option>
                                                            <option value="Date">Date</option>
                                                            <option value="Description">Description</option>
                                                            <option value="Format">Format</option>
                                                            <option value="Identifier">Identifier</option>
                                                            <option value="Language">Language</option>
                                                            <option value="Publisher">Publisher</option>
                                                            <option value="Relation">Relation</option>
                                                            <option value="Rights">Rights</option>
                                                            <option value="Source">Source</option>
                                                            <option value="Subject">Subject</option>
                                                            <option value="Title">Title</option>
                                                            <option value="Type">Type</option>
                                                        </select>
                                                    </td>

                                                    <td><input type="text" class="form-control" name="placeholder[1]"
                                                            placeholder="Enter Placeholder" value="" required></td>

                                                    <!-- Mandatory field -->
                                                    <td><input class="form-check-input mt-0 me-2" name="is_required[1]"
                                                            type="checkbox" value="1" id="flexCheckDefault">
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
                                                    <td><select class="form-select" name="type[2]"
                                                            aria-label="Default select example" required>
                                                            <option selected>Select Field Type</option>
                                                            <option value="text">text</option>
                                                            <option value="email">email</option>
                                                            <option value="date">date</option>
                                                            <option value="textarea">textarea</option>
                                                        </select></td>

                                                    <td>
                                                        <select class="form-select" name="title[2]"
                                                            aria-label="Default select example" required>
                                                            <option value="" selected>Select Field Title</option>
                                                            <option value="Contributor">Contributor</option>
                                                            <option value="Coverage">Coverage</option>
                                                            <option value="Creator">Creator</option>
                                                            <option value="Date">Date</option>
                                                            <option value="Description">Description</option>
                                                            <option value="Format">Format</option>
                                                            <option value="Identifier">Identifier</option>
                                                            <option value="Language">Language</option>
                                                            <option value="Publisher">Publisher</option>
                                                            <option value="Relation">Relation</option>
                                                            <option value="Rights">Rights</option>
                                                            <option value="Source">Source</option>
                                                            <option value="Subject">Subject</option>
                                                            <option value="Title">Title</option>
                                                            <option value="Type">Type</option>
                                                        </select>
                                                    </td>

                                                    <td><input type="text" class="form-control" name="placeholder[2]"
                                                            placeholder="Enter Placeholder" value="" required></td>

                                                    <!-- Mandatory field -->
                                                    <td><input class="form-check-input mt-0 me-2" name="is_required[2]"
                                                            type="checkbox" value="1" id="flexCheckDefault">
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
                                                <input type="hidden" name="row_count" id="row_count" value="2">
                                            </tbody>
                                        </table>
                                        <div class="col-lg-auto">
                                            <!-- <button type="button" class="btn btn-outline-primary me-2"><i class="bi bi-trash3-fill pe-2"></i>Delete Template</button> -->
                                            <button type="submit" name="submit" class="btn btn-primary"><i
                                                    class="bi bi-check-circle-fill pe-2"></i>Save Fields</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    <?php }
                } ?>
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
            var field_count = 'field' + row_count;

            row +=
                '<tr class="draggable-item"><td class="fixed-col"><i class="bi bi-arrows-move pe-2"></i>' + row_count + '</td><td><select class="form-select" name="type[' + row_count + ']" required aria-label="Default select example"><option selected>Select Field Type</option><option value="text">text</option><option value="email">email</option><option value="date">date</option><option value="textarea">textarea</option></select></td><td><select class="form-select" name="title[' + row_count + ']" aria-label="Default select example" required><option value="" selected>Select Field Title</option><option value="Contributor">Contributor</option><option value="Coverage">Coverage</option><option value="Creator">Creator</option><option value="Date">Date</option><option value="Description">Description</option><option value="Format">Format</option><option value="Identifier">Identifier</option><option value="Language">Language</option><option value="Publisher">Publisher</option><option value="Relation">Relation</option><option value="Rights">Rights</option><option value="Source">Source</option><option value="Subject">Subject</option><option value="Title">Title</option><option value="Type">Type</option></select></td><td><input type="text" class="form-control" name="placeholder[' + row_count + ']" placeholder="Enter Placeholder" value="" required></td><!-- Mandatory field --><td><input class="form-check-input mt-0 me-2" name="is_required[ ' +row_coun t +']" type="checkbox" value="1" id="flexCheckDefault"><label class="form-check-label" for="flexCheckDefault">Mandatory field</label></td>';
            row +=
                '<td><button type="button" class="btn neutral-outlin-btn deleteRow"><i class="bi bi-trash3-fill pe-2"></i>Delete field</button></td></tr>';
            $("tbody").append(row);
            $('#row_count').val(row_count);
        });


        $("#templateFieldTable").on("click", ".deleteRow", function () {
            var row_count = $('#row_count').val();
            row_count--;
            $('#row_count').val(row_count);
            $(this).closest("tr").remove();
        });

    </script>
</body>


</html>