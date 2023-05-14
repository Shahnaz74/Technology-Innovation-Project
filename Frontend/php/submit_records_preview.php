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


    <header id="form-header" class="row mx-0 mb-4 sticky-top">

        <div class="col-lg-auto">
            <button type="button" id="backButton" class="btn btn-outline-primary me-2"><i
                    class="bi bi-archive-fill pe-2 "></i>Go Back & Edit</button>
            <button type="button" id="publishButton" class="btn btn-primary"><i
                    class="bi bi-check-circle-fill pe-2"></i>Publish</button>
        </div>
    </header>

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