<?php
include "head.php";

$upload_id = $_GET['upload_id'];
echo "<script>console.log(" . $upload_id . ");</script>";
?>

<body>

    <!-- Top Nav Bar -->
    <?php include "header.php" ?>

    <!-- main content -->
    <section class="record-content">
        <div class="container px-5 py-5">
            <div class="row gx-5 justify-content-center mx-0">
                <div id="container" class="col-lg-11 col-xl-9 col-xxl-8">
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include "footer.php" ?>

    <script>
        $(document).ready(function () {
            var upload_id = <?php echo isset($_GET["upload_id"]) ? $_GET["upload_id"] : "null"; ?>;
            console.log(upload_id);
            if (upload_id !== null && upload_id !== '') {
                $.ajax({
                    url: 'getUploadById.php',
                    method: 'GET',
                    data: {
                        upload_id: upload_id
                    },
                    success: function (response) {
                        // Handle the AJAX success response
                        console.log(response);
                        var containerElement = document.getElementById("container");

                        if (response !== null) {
                            containerElement.innerHTML = buildHTML(response.uploads[0]);
                        }

                    },
                    error: function (error) {
                        // Handle the AJAX error
                        console.log(error);
                    }
                });

            }
        });

        function buildHTML(jsonObj) {
            var docType = jsonObj.template_name;
            var docTitle = jsonObj.title;
            var title = jsonObj.file_name;
            var description = jsonObj.description;
            var publishDate = jsonObj.date;
            var previewImageFormat = jsonObj.format;

            if (previewImageFormat === null) {
                // The format value is null
                // Retrieve the value from file_name
                previewImageFormat = title.split('.').pop();
            }

            var previewImage = "../client-records/" + title;

            var html = "";

            // Document type
            if (docType !== null && docType !== '') {
                html += '<div id="doctypecontainer" class="d-flex align-items-center pb-2">' + docType + '</div>';
            }

            // Document title
            if (docTitle !== null && docTitle !== '') {
                html += '<h4 id="titlecontainer" class="primary-red text-wrap text-break serif">' + docTitle + '</h4>';
            }

            // Document description
            if (description !== null && description !== '') {
                html += '<div id="desccontainer">' + description + '</div>';
            }

            // Document publish date
            if (publishDate !== null && publishDate !== '') {
                html += '<div id="publishdatecontainer" class="pb-4">Published at ' + publishDate + '</div>';
            }

            // Document preview
            if (previewImageFormat !== null && previewImageFormat !== '') {
                var lowerCaseFormat = previewImageFormat.toLowerCase();
                if (lowerCaseFormat === "jpg" || lowerCaseFormat === "png") {
                    // JPG file preview
                    html += '<div id="previewcontainer" class="row preview-area">';
                    html += '<img src="' + previewImage + '" alt="Preview Image">';
                    html += '</div>';
                } else if (lowerCaseFormat === "doc" || lowerCaseFormat === "docx") {
                    // DOC or DOCX file preview (temporary using thumb as preview)
                    var filenameWithoutExtension = title.split('.').slice(0, -1).join('.');
                    var filePreviewPath = filenameWithoutExtension + "-thumb.png";

                    html += '<div id="previewcontainer" class="row preview-area">';
                    html += '<img src="../client-records/' + filePreviewPath + '" alt="Preview Image">';
                    html += '</div>';
                } else if (lowerCaseFormat === "pdf") {
                    // PDF file preview
                    html += '<div id="previewcontainer" class="row preview-area">';
                    html += '<iframe src="' + previewImage + '" width="100%" height="600" frameborder="0"></iframe>';
                    html += '</div>';
                }
            }

            return html;
        }
    </script>
</body>

</html>