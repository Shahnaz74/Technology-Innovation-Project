<?php include 'head.php'; ?>

<?php include 'message.php'; ?>

<body id="page-top">
    <div class="wrapper">

        <!-- Sidebar  -->
        <?php include 'sidebar.php'; ?>

        <!-- Page Content  -->
        <div id="content">
            <?php if(isset($_GET['delete']) && $_GET['delete'] == true){
                $id=$_GET['id'];
                $select = "DELETE FROM template where id=".$id;
                $delete = mysqli_query($conn, $select);
                if($delete){
                    $_SESSION['message'] = "Template Deleted Successfully"; 
                    header('Location:admin_portal_templates.php');
                }else{
                    $_SESSION['error'] = "Something went wrong";
                    header('Location:admin_portal_templates.php');
                }
            }
            ?>
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
                            <tr>
                                <th>Template Name</th>
                                <th>Used Records</th>
                                <th>Edit</th>
                                <th>Edit Fields</th>
                                <th>View Fields</th>
                                <th>Delete</th>
                            </tr>
                        <?php
                            // if(isset($_GET['id'])){
                            //     $id = $_GET['id'];
                            // }
                            $select2 = "SELECT * FROM template";
                            $runQuery2 = mysqli_query($conn, $select2);
                            $rowcount=mysqli_num_rows($runQuery2);
                            if($rowcount > 0){
                                // echo $rowcount;
                                // $row1 = mysqli_fetch_assoc($runQuery);
                                // 
                                // print_r(mysqli_fetch_assoc($runQuery));
                                while($row1 = mysqli_fetch_assoc($runQuery2)){
                                    $templatename = $row1['template_name'];
                            $select1 = "SELECT * FROM fields where `template_id` =".$row1['id'];
                            $runQuery1 = mysqli_query($conn, $select1);
                            $rowcount1=mysqli_num_rows($runQuery1);        
                        ?>       
                            <tr class="align-middle">
                                <th scope="row" width="25%">
                                    <p class="recordFileName mb-0"><img src="../img/recordCat_advertisment.svg"
                                            alt="Custom SVG" class="pe-1"><?php echo !empty($templatename) ? $templatename :''; ?></p>
                                </th>
                                <td class="recordCategory">Used in <span>10</span> Records</td>
                                <td><!--  <button type="button" class="btn neutral-outlin-btn me-lg-2"><i class="fas fa-copy pe-2"></i>Duplicate Template</button> -->
                                    <button type="button" class="btn neutral-outlin-btn me-lg-2"><a
                                            href="admin_portal_edit_template.php?id=<?php echo $row1['id']; ?>&edit=<?php echo 'template_edit'; ?>">
                                            <i class="bi bi-pencil-fill pe-2"></i>Edit
                                        </a></button></td>
                                        <?php if($rowcount1 > 0){ ?>
                                        <td><button type="button" class="btn neutral-outlin-btn me-lg-2"><a
                                            href="admin_portal_edit_template.php?id=<?php echo $row1['id']; ?>&edit=<?php echo 'field_edit'; ?>">
                                            <i class="bi bi-pencil-fill pe-2"></i>Edit Fields
                                        </a></button></td>
                                        <?php }else if($rowcount1 == 0){?>
                                            <td><button type="button" class="btn neutral-outlin-btn me-lg-2"><a
                                            href="admin_portal_create_template.php?id=<?php echo $row1['id']; ?>&edit=<?php echo 'add_fields'; ?>">
                                            <i class="bi bi-pencil-fill pe-2"></i>Add Fields
                                        </a></button></td>
                                        <?php } ?>
                                        <td><button type="button" class="btn neutral-outlin-btn me-lg-2"><a
                                            href="admin_portal_fields.php?id=<?php echo $row1['id']; ?>">
                                            <i class="bi bi-pencil-fill pe-2"></i>View Fields
                                        </a></button></td>
                                        <td><a href="admin_portal_templates.php?id=<?php echo $row1['id']; ?>&delete=<?php echo 'true'; ?>" onclick="return confirm('Are you sure you want to delete this template?')"><button type="button" class="btn neutral-outlin-btn"><i class="bi bi-trash3-fill pe-2"></i>Delete</button></a></td>
                            </tr>
                        <?php  } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include 'script.php' ?>
</body>


</html>