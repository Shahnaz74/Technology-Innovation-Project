<?php
include "head.php";

if (isset($_GET['data'])) {
    // back from submit_records_preview.php
    $dataString = $_GET['data'];
    echo "<script>console.log(" . $dataString . ");</script>";
    // Decode the JSON string
    $data = json_decode($dataString);
}

?>

<body>
    <!-- Top Nav Bar -->
    <?php include "header.php" ?>

    <!-- Page header -->
    <header id="form-header" class="row mx-4 my-4 sticky-top">
        <div class="col-lg d-flex justify-content-between">
            <button type="button" id="backButton" class="btn btn-outline-primary me-2"><i
                    class="bi bi-archive-fill pe-2 "></i>Go Back & Edit</button>
            <h3 class="h3 primary-red">Document Preview</h3>

            <button type="button" id="publishButton" class="btn btn-primary"><i
                    class="bi bi-check-circle-fill pe-2"></i>Confirm</button>
        </div>
    </header>

    <section class="record-content bg-body-tertiary">
        <div class="container my-5 px-3 py-5 bg-white shadow-sm rounded">
            <div class="row gx-5 justify-content-center mx-0">
                <div class="col-lg-11 col-xl-9 col-xxl-8">

                    <?php
                    $docType = $data->template_name;
                    $docTitle = $data->title;
                    $title = $data->file_name;
                    $description = $data->description;
                    $publishDate = $data->date;
                    // $previewImageFormat = $data->format;
                    // $previewImage = "../client-records/" . $title;
                    $file = $data->file;
                    $previewImageFormat = pathinfo($file, PATHINFO_EXTENSION);

                    // Build the HTML structure
                    $html = "";
                    // Document type
                    $html .= '<div id="doctypecontainer" class="d-flex align-items-center pb-2">' . $docType . '</div>';

                    // Document title
                    $html .= '<h4 id="titlecontainer" class="primary-red text-wrap text-break serif">' . $docTitle . '</h4>';

                    // Document description
                    if (!empty($description)) {
                        $html .= '<div id="desccontainer">' . $description . '</div>';
                    }

                    // Document publish date
                    if (!empty($publishDate)) {
                        $html .= '<div id="publishdatecontainer" class="pb-4">Published at ' . $publishDate . '</div>';
                    }

                    // Document preview
                    if (strtolower($previewImageFormat) === "jpg" || strtolower($previewImageFormat) === "png") {
                        // JPG file preview
                        $html .= '<div class="row preview-area" id="previewcontainer">';
                        $html .= '<img src="' . $file . '" alt="Preview Image">';
                        $html .= '</div>';
                    } elseif (strtolower($previewImageFormat) === "doc" || strtolower($previewImageFormat) === "docx") {
                        // DOC or DOCX file preview (temporary using thumb as preview)
                        $filenameWithoutExtension = pathinfo($title, PATHINFO_FILENAME);
                        $filePreviewPath = $filenameWithoutExtension . "-thumb.png";

                        $html .= '<div class="row preview-area" id="previewcontainer">';
                        $html .= '<img src="../client-records/' . $filePreviewPath . '" alt="Preview Image">';
                        $html .= '</div>';

                    } elseif (strtolower($previewImageFormat) === "pdf") {
                        // PDF file preview
                        $html .= '<div class="row preview-area" id="previewcontainer">';
                        $html .= '<iframe src="' . $file . '" width="100%" height="600" frameborder="0"></iframe>';
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

    <script>
        var dataObj = <?php echo isset($_GET["data"]) ? $_GET["data"] : "null"; ?>;

        // Get the button
        const publishButton = document.getElementById('publishButton');
        const backButton = document.getElementById('backButton');

        backButton.addEventListener('click', function () {
            var data = {
                file_name: dataObj.file_name,
                file: dataObj.file,
                contributor: dataObj.contributor,
                coverage: dataObj.coverage,
                creator: dataObj.creator,
                date: dataObj.date,
                description: dataObj.description,
                format: dataObj.format,
                identifier: dataObj.identifier,
                language: dataObj.language,
                publisher: dataObj.publisher,
                relation: dataObj.relation,
                rights: dataObj.rights,
                source: dataObj.source,
                title: dataObj.title,
                first_name: dataObj.first_name,
                last_name: dataObj.last_name,
                email: dataObj.email,
                upload_status: dataObj.upload_status,
                template_name: dataObj.template_name,
                subject: dataObj.subject
            };
            var dataString = JSON.stringify(data);

            window.location.href = 'submit_records.php?data=' + encodeURIComponent(JSON.stringify(data));
        });

        // Add click event listener to the publish button
        publishButton.addEventListener('click', function () {
            $.ajax({
                url: 'createUpload.php',
                method: 'POST',
                data: {
                    file_name: dataObj.file_name,
                    file: dataObj.file,
                    contributor: dataObj.contributor,
                    coverage: dataObj.coverage,
                    creator: dataObj.creator,
                    date: dataObj.date,
                    description: dataObj.description,
                    format: dataObj.format,
                    identifier: dataObj.identifier,
                    language: dataObj.language,
                    publisher: dataObj.publisher,
                    relation: dataObj.relation,
                    rights: dataObj.rights,
                    source: dataObj.source,
                    title: dataObj.title,
                    first_name: dataObj.first_name,
                    last_name: dataObj.last_name,
                    email: dataObj.email,
                    upload_status: dataObj.upload_status,
                    template_name: dataObj.template_name,
                    subject: dataObj.subject,
                },
                success: function (response) {
                    // Handle the AJAX success response
                    console.log(response);

                    window.location.href = "submit_records_success.php";
                }, error: function (error) {
                    // Handle the AJAX error
                    console.log(error);
                }
            });

        });

    </script>

</body>

</html>