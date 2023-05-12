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
                $select = "DELETE FROM fields where id=".$id;
                $delete = mysqli_query($conn, $select);
                if($delete){
                    $_SESSION['message'] = "Field Deleted Successfully"; 
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
                        <h1 class="h3 primary-red mb-0">Template Fields</h1>
                    </div>
                    <?php if(isset($_GET['id'])){
                        $id = $_GET['id']; 
                    ?>

                    <div class="col-lg-auto">
                        <a href="admin_portal_edit_template.php?id=<?php echo $id; ?>&edit=<?php echo 'field_edit'; ?>"><button type="button" class="btn btn-primary"><i class="bi bi-plus-lg pe-2"></i></i>Add More Fields</button></a>
                    </div>
                <?php } ?>
                </div>

                <!-- Page content -->
                <div class="row mx-0">

                    <table class="table table-striped table-hover">
                        <tbody>
                            <tr>
                                <th>Field Type</th>
                                <th>Field Title</th>
                                <th>Field Name</th>
                                <th>Field Placeholder</th>
                                <th>Field Required</th>
                                <th>Delete</th>
                            </tr>
                            <?php
                                if(isset($_GET['id'])){
                                $id = $_GET['id'];
                                $select = "SELECT * FROM fields where  `template_id` =".$id;
                                $runQuery = mysqli_query($conn, $select);
                                $rowcount=mysqli_num_rows($runQuery);
                                if($rowcount > 0){
                                    while($row = mysqli_fetch_object($runQuery)){
                            ?>
                            <tr class="align-middle">
                                <td><?php echo !empty($row->type) ? $row->type :''; ?></td>
                                <td><?php echo !empty($row->title) ? $row->title :''; ?></td>
                                <td><?php echo !empty($row->name) ? $row->name :''; ?></td>
                                <td><?php echo !empty($row->placeholder) ? $row->placeholder :''; ?></td>
                                <td><?php echo !empty($row->is_required) ? $row->is_required :'0'; ?></td>
                                <td>
                                    <!-- <button type="button" class="btn neutral-outlin-btn me-lg-2"><i class="fas fa-copy pe-2"></i>Duplicate Template</button> -->
                                    <a href="admin_portal_fields.php?id=<?php echo $row->id; ?>&delete=<?php echo 'true'; ?>" onclick="return confirm('Are you sure you want to delete this field?')"><button type="button" class="btn neutral-outlin-btn"><i class="bi bi-trash3-fill pe-2"></i>Delete</button></a>
                                </td>
                            </tr>
                            <?php  } } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include 'script.php' ?>
</body>


</html>