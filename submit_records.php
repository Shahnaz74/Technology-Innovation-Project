<?php include "head.php" ?>
<body>
    <!-- Top Nav Bar -->
    <?php include "header.php" ?>

    <?php
        if(isset($_POST['submit'])){
            // print_r($_POST);die;
            $post = $_POST['submit'];
        }
    ?>

    <section class="record-content">
        <div class="container px-5 py-5">
            <div class="row gx-5 justify-content-center mx-0">

                <div class="col-lg-11 col-xl-9 col-xxl-8">
                    <form method="GET" >
                        <!-- Document type -->
                        <div class="col-md-4x   col-xl-9x mb-4">
                            <label for="documentType" class="form-label" required>Document type</label>
                            <select class="form-select" name="document_type" id="documentType" required>
                                <option value="">Select Document Type</option>
                                <?php 
                                    $select = "SELECT * FROM template";
                                    // echo $select;die;
                                    if(isset($_GET['document_type'])){
                                        $document_type = $_GET['document_type'];
                                    }
                                        $runQuery = mysqli_query($conn, $select);
                                        $rowcount=mysqli_num_rows($runQuery);
                                    if($rowcount > 0){
                                        while($row = mysqli_fetch_object($runQuery)){
                                          $tid = $row->id;
                                          $templatename = $row->template_name;  
                                    ?>
                                    <option value="<?php echo $tid; ?>" <?php echo !empty($_GET['document_type']) && $_GET['document_type'] == $tid ? "selected" :''; ?>><?php echo $templatename; ?></option>
                                    <?php 
                                            }
                                        }
                                    ?>
                            </select>
                        </div>
                        <div class="col-md-4x   col-xl-9x mb-4">
                            <button id="sumbitRecordBtn" type="submit" name="" class="btn btn-primary"><i class="bi bi-check-circle-fill pe-2"></i>Filter Data</button>
                            <div class="invalid-feedback">
                                Please select document type.
                            </div>
                        </div>    
                    </form>
                    <!-- Upload Form Description-->
                    <h4 id="uploadFormTitle" class="primary-red serif">Submit Record</h4>
                    <div id="uploadFormDesc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor
                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                        ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate
                        velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident,
                        sunt
                        in culpa qui officia deserunt mollit anim id est laborum. </div>
                    <!-- File Details Form -->

                    <h4 id="fileFormTitle" class="primary-red serif mb-4">File Details</h4>
                    <form class="needs-validation" method="POST" enctype="multipart/form-data">
                        <!-- File name -->
                        <div class="mb-4">
                            <label for="fileName" class="form-label">File name <span
                                    class="mandatoryField">*</span></label>
                            <input type="text" class="form-control" id="fileName" placeholder="" required>
                            <div class="invalid-feedback">
                                File name is required
                            </div>
                        </div>
                        <?php 
                            if(isset($_GET['document_type'])){
                                $template_id = $_GET['document_type'];
                                $select1 = "SELECT * FROM fields where `template_id` = ".$template_id;
                                $runQuery1 = mysqli_query($conn, $select1);
                                $rowcount1=mysqli_num_rows($runQuery1);
                            if($rowcount1 > 0){
                        ?>
                        <!-- File upload -->
                        <div class="fileUpload container mb-4 px-0">
                            <label for="documentType" class="form-label">File upload <span
                                    class="mandatoryField">*</span></label>
                            <!-- Upload file area -->
                            <div id="drop-area" class="col-md-6 col-md-offset-3 py-5">
                                <img src="../img/fileUpload.svg" class="pb-2" alt="">
                                <h5 id="drop-hint" class="serif pb-2">Drag & drop files or <a href="#"
                                        id="browse-btn">Browse</a></h5>
                                <p id="drop-subhint">Supported formats: JPEG, PNG, PDF</p>
                                <input type="file" id="file-input" accept=".jpg, .jpeg, .png, .pdf"
                                    style="display:none;">
                                <p id="drop-subhint" class="primary-red">File size limit: 2MB</p>
                                <!-- <div class="row" id="thumbnails"></div> -->
                            </div>
                            <!-- Uploaded file area -->
                            <div id="uploaded-area">
                                <div class="input-group mb-3">
                                    <input id="uploaded-file-name" type="text" class="form-control" placeholder=""
                                        aria-label="" aria-describedby="basic-addon2">
                                    <button class="input-group-text deleteFileUpload" id="basic-addon2">
                                        <i class="bi bi-trash3-fill pe-2"></i>
                                        Delete file
                                    </button>
                                </div>
                                <div class="col-4" id="thumbnails">
                                    <!-- <img src="../img/uploadFileDummy.png" class="img-thumbnail" alt="..."> -->
                                </div>
                            </div>
                        </div>
                        <?php 
                        // $row = mysqli_fetch_object($runQuery1);
                        // print_r($row);
                         while($row = mysqli_fetch_object($runQuery1)){
                        if($row->type == 'text' || $row->type == 'email' || $row->type == 'date'){ ?>
                            <div class="row mb-4">
                                <!-- File source -->
                                <div class="col-lg-6">
                                    <label for="fileSource" class="form-label"><?php echo !empty($row->title) ? $row->title :''; ?></label>
                                    <input type="<?php echo !empty($row->type) ? $row->type :''; ?>" name="<?php echo !empty($row->name) ? $row->name :''; ?>" class="form-control" id="fileSource" placeholder="">
                                </div>
                            </div>
                        <?php }else if($row->type = 'textarea') {?>
                            <!-- File description -->
                        <div class="mb-4">
                            <label for="fileDescription"><?php echo !empty($row->title) ? $row->title :''; ?></label>
                            <textarea class="form-control" name="<?php echo !empty($row->name) ? $row->name :''; ?>" rows="10" id="fileDescription"></textarea>
                        </div>
                        <?php } ?>
                        
                        <?php } } } ?>
                        <!-- Uploader Details-->
                        <h4 id="uploaderDetailsTitle" class="primary-red serif mb-4">Uploader Details</h4>
                        <div class="row">
                            <!-- First Name -->
                            <div class="col-lg-6 mb-4">
                                <label for="firstNameField" class="form-label">First Name <span
                                        class="mandatoryField">*</span></label>
                                <input type="text" class="form-control" id="firstNameField" placeholder="">
                            </div>

                            <!-- Last Name -->
                            <div class="col-lg-6 mb-4">
                                <label for="lastNameField" class="form-label">Last Name <span
                                        class="mandatoryField">*</span></label>
                                <input type="text" class="form-control" id="lastNameField" placeholder="">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="emailField" class="form-label">Email <span
                                    class="mandatoryField">*</span></label>
                            <input type="text" class="form-control" id="emailField" placeholder="">
                        </div>
                        <div class="mb-4">
                            <label for="membershipField" class="form-label">RCCA Membership ID</label>
                            <input type="text" class="form-control" id="membershipField" placeholder="">
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto my-5">
                            <button id="sumbitRecordBtn" type="submit" name="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle-fill pe-2"></i>Sumbit Record</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include "footer.php" ?>
    <?php include "scripts.php" ?>
    <!--script for drag and drop-->
    <script>
        $(document).ready(function () {
            $('#drop-area').show();
            $('#uploaded-area').hide();

            const dropZone = document.querySelector('#drop-area');
            const browseBtn = document.querySelector('#browse-btn');
            const fileInput = document.querySelector('#file-input');
            const deleteBtn = document.querySelector('#basic-addon2');

            dropZone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropZone.classList.add('drag-over');
            });

            dropZone.addEventListener('dragleave', (e) => {
                e.preventDefault();
                dropZone.classList.remove('drag-over');
            });

            dropZone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropZone.classList.remove('drag-over');
                const file = e.dataTransfer.files[0];
                handleFile(file);
            });

            browseBtn.addEventListener('click', (e) => {
                e.preventDefault();
                fileInput.click();
            });

            fileInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                handleFile(file);
            });

            deleteBtn.addEventListener('click', (e) => {
                e.preventDefault();
                $('#drop-area').show();
                $('#uploaded-area').hide();
            });

            function handleFile(file) {
                // check file type
                const allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Invalid file type. Please upload a JPEG, PNG, or PDF file.');
                    return;
                }
                $('#drop-area').hide();
                $('#uploaded-area').show();
                // Do something with the file, like upload it to a server
                console.log(file);
                var reader = new FileReader();
                reader.onload = function (event) {
                    $('#uploaded-file-name').val(file.name);
                    var thumbnail = '<div class="col-md-4 mb-4"><div class="card"><img class="card-img-top" src="' + event.target.result + '"></div></div>';
                    $('#thumbnails').html(thumbnail);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

    
</body>

</html>