<?php
// Start the session
session_start();

?>
<?php include "head.php" ?>

<body>
    <!-- Top Nav Bar -->
    <?php include "header.php" ?>

    <!-- Search Bar -->
    <section class="searchForm py-4">
        <div class="container">
            <div class=" row justify-content-center mx-0">
                <form class="row mx-0" action="seachUpload.php" method="GET">
                    <div class="col-md-8 mx-0">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <div class="dropdown input-group pe-2">
                                    <input type="text" class="form-control" aria-label="Text input with dropdown button"
                                        name="provided_keyword" required>
                                    <button class="btn btn-secondary pe-lg-3 dropdown-toggle default_option"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">All
                                        Document
                                        Types</button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" value="Advertisement Journal"
                                                href="#">Advertisement Journal</a></li>
                                        <li><a class="dropdown-item" value="Advertisement Newspaper"
                                                href="#">Advertisement Newspaper</a></li>
                                        <li><a class="dropdown-item" value="Article Journal" href="#">Article
                                                Journal</a></li>
                                        <li><a class="dropdown-item" value="Article Newspaper" href="#">Article
                                                Newspaper</a></li>
                                        <li><a class="dropdown-item" value="Book Historical" href="#">Book
                                                Historical</a></li>
                                        <li><a class="dropdown-item" value="Photograph Commercial" href="#">Photograph
                                                Commercial</a></li>
                                        <li><a class="dropdown-item" value="Photograph Personal" href="#">Photograph
                                                Personal</a></li>
                                        <li><a class="dropdown-item" value="Sales Brochure" href="#">Sales Brochure</a>
                                        </li>
                                        <li><a class="dropdown-item" value="Sales Record" href="#">Sales Record</a></li>
                                    </ul>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary homeSearchBtn"><i
                                    class="bi bi-search pe-2"></i>Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Main content area -->
    <section id="search-result-content">
        <div class="container">
            <div class="row">

                <!-- Search filter -->
                <div class="filter-section col-lg-3">

                    <!-- Car type -->
                    <ul class="list-group list-group-flush border-bottom py-2">
                        <p class="filterHeading primary-neutal-900">Car Type</p>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="car-type" value="Sedan"
                                id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Sedan
                            </label>
                        </li>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="car-type" value="SUV">
                            <label class="form-check-label" for="flexCheckDefault">
                                SUV
                            </label>
                        </li>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="car-type" value="Hatchback">
                            <label class="form-check-label" for="flexCheckDefault">
                                Hatchback
                            </label>
                        </li>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="car-type" value="Sports Car">
                            <label class="form-check-label" for="flexCheckDefault">
                                Sports Car
                            </label>
                        </li>
                    </ul>

                    <!-- Publish Date -->
                    <ul class="list-group list-group-flush border-bottom py-4">
                        <p class=" filterHeading primary-neutal-900">Publish Date</p>
                        <div class=" dropdown year">
                            <button class="btn btn-outline-secondary dropdown-toggle default_option" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                All year
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" value="1960-1980">1960-1980</a></li>
                                <li><a class="dropdown-item" href="#" value="1981-2000">1981-2000</a></li>
                                <li><a class="dropdown-item" value="2001-2021">2001-2021</a></li>
                            </ul>
                        </div>
                    </ul>

                    <!-- File source -->
                    <ul class="list-group list-group-flush border-bottom py-2"">
                            <p class=" filterHeading primary-neutal-900">Source</p>
                        <li class=" list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="source" value="All Sources"
                                id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                All Sources
                            </label>
                        </li>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="source"
                                value="Government publication">
                            <label class="form-check-label" for="flexCheckDefault">
                                Government publication
                            </label>
                        </li>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="source" value="Morning Bulletin ">
                            <label class="form-check-label" for="flexCheckDefault">
                                Morning Bulletin
                            </label>
                        </li>
                    </ul>
                </div>

                <!-- Result listing -->
                <div class="col-lg-9">

                    <!-- Header -->
                    <div class="row mx-0 pt-4">
                        <div class="col-lg d-flex px-0">
                            <h4 class=" primary-red serif mb-0">Search Result</h4>
                            <form class="form-inline ms-4">
                                <div class="dropdown sort-by">
                                    <button class="btn btn-outline-secondary dropdown-toggle default_option"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Sort By: <span>Relevance</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" value="relevance">Relevance</a></li>
                                        <li><a class="dropdown-item" value="year-asc">Year - Old to New</a>
                                        </li>
                                        <li><a class="dropdown-item" value="year-desc">Year - New to Old</a></li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-auto">
                            <?php
                            if (isset($_SESSION["jsonString"])) {
                                $jsonString = $_SESSION["jsonString"];
                                $jsonObj = json_decode($jsonString);
                                
                                if (property_exists($jsonObj, "uploads")) {
                                    echo "<p>" . count($jsonObj->uploads) . "<span> result(s)</span></p>";
                                } else {
                                    echo "<p>0<span> result(s)</span></p>";
                                }
                                
                            }
                            ?>
                        </div>
                    </div>

                    <!--Document Item-->
                    <div id="itemContainer">
                        <?php
                        if (isset($_SESSION["jsonString"])) {
                            $jsonString = $_SESSION["jsonString"];
                            $jsonObj = json_decode($jsonString);
                            $html = "";
                            if (property_exists($jsonObj, "uploads")) {
                                foreach ($jsonObj->uploads as $upload) {
                                    // Create HTML element for each upload
                                    if (strtolower($upload->format) === "jpg" || strtolower($upload->format) === "png") {
                                        $filePreviewPath = $upload->file_name;
                                    } else {
                                        $filenameWithoutExtension = pathinfo($upload->file_name, PATHINFO_FILENAME);
                                        $filePreviewPath = $filenameWithoutExtension . "-thumb.png";
                                    }
                                    $html .= '<div class="search-result-item row align-items-center border-bottom py-md-5">';
                                    $html .= '<div class="col-lg-3 pb-2">';
                                    $html .= '<img src="client-records/' . $filePreviewPath . '" class="img-thumbnail" alt="...">';
                                    $html .= '</div>';
                                    $html .= '<div class="col-lg-9">';
                                    $html .= '<div id="doctypecontainer" class="d-flex align-items-center primary-neutal-800 pb-2">';
                                    $html .= $upload->template_name;
                                    $html .= '</div>';
                                    $html .= '<h4 id="titlecontainer" class="primary-red text-wrap text-break serif">' . $upload->file_name . '</h4>';
                                    $html .= '<p class="primary-neutal-800">' . $upload->description . '</p>';
                                    $html .= '<p class="primary-neutal-800">Published at ' . $upload->date . '</p>';
                                    $html .= '<div class="upload-id" style="display: none;"><p>' . $upload->upload_id . '</p></div>';
                                    $html .= '</div>';
                                    $html .= '</div>';
                                    $_SESSION["upload_" . $upload->upload_id] = $upload;
                                }
                            } else {
                                $html .= $jsonObj->message;
                            }
                            echo $html;
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function () {
            $(".search-result-item").click(function () {
                var upload_id = $(this).find(".upload-id").text();
                // Redirect to another HTML page
                window.location.href = "record_detail.php?upload_id=" + upload_id;
            });
        });
    </script>

    <!-- footer -->
    <?php include "footer.php" ?>
    <?php include "scripts.php" ?>
</body>

</html>