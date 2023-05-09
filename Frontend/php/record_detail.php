<?php
// Start the session
session_start();

if (isset($_SESSION["upload_id"])) {
    $target = $_SESSION["upload_id"];
    echo "<script>console.log(" . $target . ");</script>";
    if (isset($_SESSION["upload_".$target])) {
        echo "<script>console.log(" . $_SESSION["upload_".$target] . ");</script>";
    }

    // unset($_SESSION["errorString"]);
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

                    <!-- Document type -->
                    <div id="doctypecontainer" class="d-flex align-items-center pb-2"><img
                            src="img/recordCat_advertisment2.svg" class="me-2" alt="">Advertisement</div>

                    <!-- Document title -->
                    <h4 id="titlecontainer" class="primary-red text-wrap text-break serif">Rover Regent Motors Advertred
                        2</h4>

                    <!-- Document description -->
                    <div id="desccontainer">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor
                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                        ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate
                        velit
                        esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                        sunt in
                        culpa
                        qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur
                        adipiscing
                        elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                        nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                        reprehenderit
                        in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                        cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                    <!-- Document publish date -->
                    <div id="publishdatecontainer">Published at Jun, 1999</div>
                    <!-- Document preview -->
                    <div id="previewcontainer">
                        <img src="img/uploadFileDummy.png" class="img-thumbnail" alt="...">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include "footer.php" ?>
    <?php include "scripts.php" ?>
</body>

</html>