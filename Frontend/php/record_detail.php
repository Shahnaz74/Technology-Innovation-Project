<?php
// Start the session
session_start();

$upload_id = $_GET['upload_id'];
echo "<script>console.log(" . $upload_id . ");</script>";
if (isset($_SESSION["upload_" . $upload_id])) {
    $jsonObj = $_SESSION["upload_" . $upload_id];
    echo "<script>console.log(" . json_encode($jsonObj) . ");</script>";
}

?>
<?php include "head.php" ?>

<body>

    <!-- Top Nav Bar -->
    <?php include "header.php" ?>

    <!-- main content -->
    <section class="record-content">
        <div class="container px-5 py-5">
            <div class="row gx-5 justify-content-center mx-0">
                <div class="col-lg-11 col-xl-9 col-xxl-8">

                    <?php
                    $docType = $jsonObj->template_name;
                    $title = $jsonObj->file_name;
                    $description = $jsonObj->description;
                    $publishDate = $jsonObj->date;
                    $previewImage = "img/uploadFileDummy.png";

                    // Build the HTML structure
                    $html = '
                    <!-- Document type -->
                    <div id="doctypecontainer" class="d-flex align-items-center pb-2">
                        <img src="img/recordCat_advertisment2.svg" class="me-2" alt="">
                        ' . $docType . '
                    </div>
            
                    <!-- Document title -->
                    <h4 id="titlecontainer" class="primary-red text-wrap text-break serif">' . $title . '</h4>
            
                    <!-- Document description -->
                    <div id="desccontainer">' . $description . '</div>
            
                    <!-- Document publish date -->
                    <div id="publishdatecontainer">Published at ' . $publishDate . '</div>
            
                    <!-- Document preview -->
                    <div id="previewcontainer">
                        <img src="' . $previewImage . '" class="img-thumbnail" alt="...">
                    </div>
                ';

                    // Output the HTML code
                    echo $html;

                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include "footer.php" ?>
    <?php include "scripts.php" ?>
</body>

</html>