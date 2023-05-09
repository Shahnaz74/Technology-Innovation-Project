<?php include 'head.php'; ?>

<body id="page-top">
    <div class="wrapper">

        <!-- Sidebar  -->
        <?php include 'sidebar.php'; ?>

        <!-- Page Content  -->
        <div id="content">
            <?php
                    if(isset($_POST['submit_template'])){
                        // print_r($_POST);
                        $tid = $_POST['template_id'];
                        $template_name = $_POST['templateName'];
                        $select = "SELECT * FROM template where id = ".$tid;
                        $runQuery = mysqli_query($conn, $select);
                        $rowcount=mysqli_num_rows($runQuery);
                        if($rowcount > 0){
                        $sql = "UPDATE `template` SET `template_name`='$template_name' WHERE id = ".$tid;
                        $update = mysqli_query($conn, $sql);
                            if($update){
                                $_SESSION['message'] = "Templated Update Successfully";
                                header('Location:admin_portal_templates.php'); 
                            }
                        }else{
                            $_SESSION['error'] = "Template Name Already Exist.";
                        }
                    }
                    

                        if(isset($_POST['submit'])){
                            // echo "<pre>";
                            // print_r($_POST);die;
                            $template_id = $_POST['template_id'];
                            $field_type = $_POST['type'];
                            $field_title = $_POST['title'];
                            $field_placeholder = $_POST['placeholder'];
                            $field_required = $_POST['is_required'];
                            $count = $_POST['row_count'];

                            $res_arr_values = array();
                            
                            for($i = 1;$i <= $count;$i++){
                                if(empty($field_required[$i])){
                                    $field_required[$i] = 0;
                                }
                                $res_arr_values[$i] = [
                                   'field_type' => $field_type[$i],
                                   'field_title' => $field_title[$i],
                                   'field_placeholder' => $field_placeholder[$i],
                                   'field_required' => $field_required[$i],    
                                ];
                            }
                                
                                foreach ($res_arr_values as $val) {
                                    $field_type = $val['field_type'];
                                    $field_title = $val['field_title'];
                                    $field_name = strtolower($val['field_title']);
                                    $field_placeholder = $val['field_placeholder'];
                                    $field_required = $val['field_required'];
                                $select = "SELECT * FROM fields where LOWER(name) = LOWER('" . $field_name . "') AND `template_id` = ".$template_id;

                                $runQuery = mysqli_query($conn, $select);
                                $rowcount = mysqli_num_rows($runQuery);
                                // echo $rowcount;die;
                                if($rowcount == 0){    
                                    $sql = "INSERT INTO `fields`(`type`, `title`, `name`,`placeholder`,`is_required`, `template_id`) VALUES ('$field_type','$field_title','$field_name','$field_placeholder','$field_required','$template_id')";
                                    // echo $sql;
                                    mysqli_query($conn, $sql);
                                }else{
                                    $select = "SELECT * FROM fields where LOWER(name) = LOWER('" . $field_name . "') AND `template_id` = ".$template_id;
                                    $runQuery = mysqli_query($conn, $select);   
                                    $rowcount = mysqli_num_rows($runQuery);
                                    if($rowcount > 0){  
                                        $row = mysqli_fetch_assoc($runQuery);
                                        $id = $row['id'];
                                    $sql = "UPDATE `fields` SET `type` = '$field_type' , `title` = '$field_title' ,`name` = '$field_name',`placeholder` = '$field_placeholder' ,`is_required` = '$field_required' , `template_id` = '$template_id' WHERE `id` = '$id'";
                                    // echo $sql;
                                    $runQuery = mysqli_query($conn, $sql); 

                                }
                              }
                                // print_r($res_arr_values);
                           }
                           $_SESSION['message'] = "Fields Updated Successfully";
                                header('Location:admin_portal_fields.php?id='.$template_id);
                       }
            ?>
            <?php include 'message.php'; ?>

            <!-- Topnav -->
            <?php include 'header.php' ?>
            <div class="container-fluid">
        <?php if(isset($_GET['edit']) && $_GET['edit'] == "template_edit"){
                $id = $_GET['id'];
            ?>
            <?php $select = "SELECT * FROM template where `id` = ".$id;
                        // echo $select;die;
                        $runQuery = mysqli_query($conn, $select);
                        $rowcount=mysqli_num_rows($runQuery);
                        if($rowcount > 0){
                            $row = mysqli_fetch_object($runQuery);
                            ?>
            <form class="needs-validation" method="POST">
                <!-- Page header -->
                <header id="form-header" class="row mx-0 mb-4 sticky-top">
                    <div class="col-lg d-flex">
                        <h1 class="h3 primary-red">Edit Template</h1>
                    </div>
                </header> 
                <!-- Page content -->
                <div class="row mx-0">
                    <!-- Template name -->
                    <div class="mb-4">
                        <label for="templateName" class="form-label">Template name <span
                                class="mandatoryField">*</span></label>
                        <input type="text" class="form-control" id="templateName" name="templateName" placeholder="Enter Template Name" value="<?php echo !empty($row->template_name) ? $row->template_name :''; ?>" required>
                        <div class="invalid-feedback">
                            File name is required
                        </div>
                    </div>
                    <input type="hidden" name="template_id" value="<?php echo $row->id; ?>">
                    <div class="col-lg-auto">
                        <!-- <button type="button" class="btn btn-outline-primary me-2"><i class="bi bi-trash3-fill pe-2"></i>Delete Template</button> -->
                        <button type="submit" name="submit_template" value="Save Template" class="btn btn-primary"><i class="bi bi-check-circle-fill pe-2"></i>Update Template</button>
                    </div>
                </div>
                    
            </form> 
        <?php } } ?>
        <?php if(isset($_GET['edit']) && $_GET['edit'] == "field_edit"){
            $id = $_GET['id'];
            ?>
            <?php $select = "SELECT * FROM template where `id` = ".$id;
                        $runQuery = mysqli_query($conn, $select);
                        $rowcount=mysqli_num_rows($runQuery);
                        if($rowcount > 0){
                            $row = mysqli_fetch_object($runQuery);
                            $select1 = "SELECT * FROM fields where `template_id` = ".$row->id;
                            $runQuery1 = mysqli_query($conn, $select1);
                            $rowcount1=mysqli_num_rows($runQuery1);
                            if($rowcount1 > 0){
                            ?>
            <form method="POST" >   

                <!-- Page header -->
                <header id="form-header" class="row mx-0 mb-4 sticky-top mt-5">
                    <div class="col-lg d-flex">
                        <h1 class="h3 primary-red">Edit Fields</h1>
                    </div>
                </header>    

                <div class="row mx-0">
                        <!-- Template icon -->
                        <!-- <div class="row mb-4"> -->
                            <!-- <p>Template</p> -->
                            
                            <div class="col">
                                <div class="btn-group templateIconSelect" role="group"
                                    aria-label="Basic radio toggle button group">
                                    <select class="form-select" name="template_id" aria-label="Default select example" required>
                                        <option value="">Select Template</option>
                                        <?php 
                                            $select = "SELECT * FROM template";
                                            // echo $select;die;
                                            $runQuery = mysqli_query($conn, $select);
                                            $rowcount=mysqli_num_rows($runQuery);
                                            if($rowcount > 0){
                                                // echo $row->id;
                                                while($trow = mysqli_fetch_object($runQuery)){
                                                  $tid = $trow->id;
                                                  $templatename = $trow->template_name;  
                                        ?>
                                            <option value="<?php echo $tid; ?>" <?php echo $row->id == $tid ? "selected" :''; ?>><?php echo $templatename; ?></option>
                                        <?php 
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        <!-- </div> -->

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
                                        <?php 
                                            $count = 1;
                                            while($row1 = mysqli_fetch_object($runQuery1)){
                                         ?>
                                        <tr class="draggable-item">
                                            <!-- Drag icon & row number -->
                                            <td class="fixed-col"><i class="bi bi-arrows-move pe-2"></i><?php echo $count; ?></td>
                                            <!-- <td><span class="js-sort-number">1</span>
                                            </td> -->

                                              <!-- Data field selection -->
                                              <td><select class="form-select" name="type[<?php echo $count; ?>]" aria-label="Default select example" required>
                                                    <option value="" selected>Select Field Type</option>
                                                    <option value="text" <?php echo $row1->type == "text" ? "selected" :''; ?>>text</option>
                                                    <option value="email" <?php echo $row1->type == "email" ? "selected" :''; ?>>email</option>
                                                    <option value="date" <?php echo $row1->type == "date" ? "selected" :''; ?>>date</option>
                                                    <option value="textarea" <?php echo $row1->type == "textarea" ? "selected" :''; ?>>textarea</option>
                                                </select></td>

                                                <td>
                                                <select class="form-select" name="title[<?php echo $count; ?>]" aria-label="Default select example" required>
                                                    <option value="" selected>Select Field Title</option>
                                                    <option value="Contributor" <?php echo $row1->title == "Contributor" ? "selected" :''; ?>>Contributor</option>
                                                    <option value="Coverage" <?php echo $row1->title == "Coverage" ? "selected" :''; ?>>Coverage</option>
                                                    <option value="Creator" <?php echo $row1->title == "Creator" ? "selected" :''; ?>>Creator</option>
                                                    <option value="Date" <?php echo $row1->title == "Date" ? "selected" :''; ?>>Date</option>
                                                    <option value="Description" <?php echo $row1->title == "Description" ? "selected" :''; ?>>Description</option>
                                                    <option value="Format" <?php echo $row1->title == "Format" ? "selected" :''; ?>>Format</option>
                                                    <option value="Identifier" <?php echo $row1->title == "Identifier" ? "selected" :''; ?>>Identifier</option>
                                                    <option value="Language" <?php echo $row1->title == "Language" ? "selected" :''; ?>>Language</option>
                                                    <option value="Publisher" <?php echo $row1->title == "Publisher" ? "selected" :''; ?>>Publisher</option>
                                                    <option value="Relation" <?php echo $row1->title == "Relation" ? "selected" :''; ?>>Relation</option>
                                                    <option value="Rights" <?php echo $row1->title == "Rights" ? "selected" :''; ?>>Rights</option>
                                                    <option value="Source" <?php echo $row1->title == "Source" ? "selected" :''; ?>>Source</option>
                                                    <option value="Subject" <?php echo $row1->title == "Subject" ? "selected" :''; ?>>Subject</option>
                                                    <option value="Title" <?php echo $row1->title == "Title" ? "selected" :''; ?>>Title</option>
                                                    <option value="Type" <?php echo $row1->title == "Type" ? "selected" :''; ?>>Type</option>
                                                </select>
                                            </td> 

                                            <td><input type="text" class="form-control" name="placeholder[<?php echo $count; ?>]" placeholder="Enter Field Placeholder" value="<?php echo $row1->placeholder; ?>" required></td>

                                            <!-- Mandatory field -->
                                            <td><input class="form-check-input mt-0 me-2" name="is_required[<?php echo $count; ?>]"  type="checkbox" <?php echo $row1->is_required == "1" ? "checked" :''; ?> value="1"
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
                                        <?php 

                                            $count++;
                                        } ?>
                                    </tbody>
                                </table>
                                        
                            
                                <input type="hidden" name="row_count" id="row_count" value="<?php echo $rowcount1; ?>">
                                <div class="col-lg-auto">
                                    <!-- <button type="button" class="btn btn-outline-primary me-2"><i class="bi bi-trash3-fill pe-2"></i>Delete Template</button> -->
                                    <button type="submit" name="submit" class="btn btn-primary"><i class="bi bi-check-circle-fill pe-2"></i>Update Fields</button>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </form>
            <?php  } } }?>
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
      '<tr class="draggable-item"><td class="fixed-col"><i class="bi bi-arrows-move pe-2"></i>'+row_count+'</td><td><select class="form-select" name="type['+row_count+']" required aria-label="Default select example"><option selected>Select Field Type</option><option value="text">text</option><option value="email">email</option><option value="date">date</option><option value="textarea">textarea</option></select></td><td><select class="form-select" name="title['+row_count+']" aria-label="Default select example" required><option value="" selected>Select Field Title</option><option value="Contributor">Contributor</option><option value="Coverage">Coverage</option><option value="Creator">Creator</option><option value="Date">Date</option><option value="Description">Description</option><option value="Format">Format</option><option value="Identifier">Identifier</option><option value="Language">Language</option><option value="Publisher">Publisher</option><option value="Relation">Relation</option><option value="Rights">Rights</option><option value="Source">Source</option><option value="Subject">Subject</option><option value="Title">Title</option><option value="Type">Type</option></select></td><td><input type="text" class="form-control" name="placeholder['+row_count+']" placeholder="Enter Placeholder" value="" required></td><!-- Mandatory field --><td><input class="form-check-input mt-0 me-2" name="is_required['+row_count+']" type="checkbox" value="1" id="flexCheckDefault"><label class="form-check-label" for="flexCheckDefault">Mandatory field</label></td>';
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