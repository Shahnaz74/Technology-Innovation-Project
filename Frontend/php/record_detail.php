<?php
include "head.php";

$upload_id = $_GET['upload_id'];
echo "<script>console.log(" . $upload_id . ");</script>";
if (isset($_SESSION["upload_" . $upload_id])) {
    $jsonObj = $_SESSION["upload_" . $upload_id];
    echo "<script>console.log(" . json_encode($jsonObj) . ");</script>";
}

?>

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
                    $docTitle = $jsonObj->title;
                    $title = $jsonObj->file_name;
                    $description = $jsonObj->description;
                    $publishDate = $jsonObj->date;
                    $previewImageFormat = $jsonObj->format;
                    $previewImage = "../client-records/" . $title;

                    // Build the HTML structure
                    $html = "";
                    // Document type
                    $html .= '<div id="doctypecontainer" class="d-flex align-items-center pb-2">' . $docType . '</div>';

                    // Document title
                    $html .= '<h4 id="titlecontainer" class="primary-red text-wrap text-break serif">' . $docTitle . '</h4>';

                    // Document description
                    $html .= '<div id="desccontainer">' . $description . '</div>';

                    // Document publish date
                    $html .= '<div id="publishdatecontainer">Published at ' . $publishDate . '</div>';

                    // Document preview
                    if (strtolower($previewImageFormat) === "jpg" || strtolower($previewImageFormat) === "png") {
                        // JPG file preview
                        $html .= '<div id="previewcontainer" class="row preview-area">';
                        $html .= '<img src="' . $previewImage . '" alt="Preview Image">';
                        $html .= '</div>';
                    } elseif (strtolower($previewImageFormat) === "doc" || strtolower($previewImageFormat) === "docx") {
                        // DOC or DOCX file preview (temporary using thumb as preview)
                        $filenameWithoutExtension = pathinfo($title, PATHINFO_FILENAME);
                        $filePreviewPath = $filenameWithoutExtension . "-thumb.png";

                        $html .= '<div id="previewcontainer" class="row preview-area">';
                        $html .= '<img src="../client-records/' . $filePreviewPath . '" alt="Preview Image">';
                        $html .= '</div>';

                        // $html .=  '<div class="preview-area" id="previewcontainer">';
                        // $html .=  '<iframe src="http://localhost/Technology-innovation/client-records/AN_P6_SydneyMorningHerald_21Jun1971.docx&embedded=true" width="100%" height="600" frameborder="0"></iframe>';
                        // $html .=  '</div>';
                    } elseif (strtolower($previewImageFormat) === "pdf") {
                        // PDF file preview
                        $html .= '<div id="previewcontainer" class="row preview-area" >';
                        $html .= '<iframe src="' . $previewImage . '" width="100%" height="600" frameborder="0"></iframe>';
                        $html .= '</div>';
                    }

                    // Output the HTML code
                    echo $html;

                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include "footer.php" ?>
</body>

</html>