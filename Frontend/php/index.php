<?php
// Start the session
session_start();

?>
<?php include "head.php" ?>

<body class="homePage">

    <!-- Top Nav Bar -->
    <?php include "header.php" ?>

    <div class="wrapper">
        <div class="user-content ">
            <div class="container-fluid homeHero">

                <!-- Search Form -->
                <form id="home-search-form" class="row mx-0">
                    <!-- Search Bar -->
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex mb-3">
                                <div class="flex-grow-1">
                                    <div class="input-group pe-2">
                                        <input type="text" class="form-control"
                                            aria-label="Text input with dropdown button" name="provided_keyword"
                                            required>
                                        <button class="btn btn-light pe-lg-5 dropdown-toggle default_option"
                                            id="documentTypesButton" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">All Document Types</button>
                                        <ul class="dropdown-menu dropdown-menu-end" name="filter_template_name">
                                        <li><a class="dropdown-item" value="All Document Types"
                                                    onclick="updateButtonDisplay(this)">All Document Types</a></li>
                                            <li><a class="dropdown-item" value="Advertisement Journal"
                                                    onclick="updateButtonDisplay(this)">Advertisement Journal</a></li>
                                            <li><a class="dropdown-item" value="Advertisement Newspaper"
                                                    onclick="updateButtonDisplay(this)">Advertisement Newspaper</a></li>
                                            <li><a class="dropdown-item" value="Article Journal"
                                                    onclick="updateButtonDisplay(this)">Article Journal</a></li>
                                            <li><a class="dropdown-item" value="Article Newspaper"
                                                    onclick="updateButtonDisplay(this)">Article Newspaper</a></li>
                                            <li><a class="dropdown-item" value="Book Historical"
                                                    onclick="updateButtonDisplay(this)">Book Historical</a></li>
                                            <li><a class="dropdown-item" value="Photograph Commercial"
                                                    onclick="updateButtonDisplay(this)">Photograph Commercial</a></li>
                                            <li><a class="dropdown-item" value="Photograph Personal"
                                                    onclick="updateButtonDisplay(this)">Photograph Personal</a></li>
                                            <li><a class="dropdown-item" value="Sales Brochure"
                                                    onclick="updateButtonDisplay(this)">Sales Brochure</a></li>
                                            <li><a class="dropdown-item" value="Sales Record"
                                                    onclick="updateButtonDisplay(this)">Sales Record</a></li>
                                            <!-- <li><a class="dropdown-item" value="All"
                                                   >All Document Types</a></li>
                                            <li><a class="dropdown-item" value="PDF"
                                                    onclick="updateButtonDisplay(this)">PDF</a></li>
                                            <li><a class="dropdown-item" value="IMAGE"
                                                    onclick="updateButtonDisplay(this)">IMAGE</a></li> -->
                                        </ul>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary homeSearchBtn"><i
                                        class="bi bi-search pe-2"></i>Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Nav Boxes -->
            <section class="row">
                <div class="col-sm-2 search-results recordCatAdv">
                    <h5 class="primary-neutal-100 serif"><img src="img/recordCat_advertisement_white.svg" width="64px"
                            alt="Area 1" class="pb-2"><br>Advertisement
                    </h5>
                </div>
                <div class="col-sm-2 search-results recordCatNews">
                    <h5 class="primary-neutal-100 serif"><img src="img/recordCat_article_white.svg" width="64px"
                            alt="Area 1" class="pb-2"><br>Article</h5>
                </div>
                <div class="col-sm-2 search-results recordCatBook">
                    <h5 class="primary-neutal-100 serif"><img src="img/recordCat_book_white.svg" width="64px"
                            alt="Area 1" class="pb-2"><br>Book</h5>
                </div>
                <div class="col-sm-2 search-results recordCatPhoto">
                    <h5 class="primary-neutal-100 serif"><img src="img/recordCat_photos_white.svg" width="64px"
                            alt="Area 1" class="pb-2"><br>Photograph</h5>
                </div>
                <div class="col-sm-2 search-results recordCatSalesBrochure">
                    <h5 class="primary-neutal-100 serif"><img src="img/recordCat_sales_brochure_white.svg" width="64px"
                            alt="Area 1" class="pb-2"><br>Sales Brochure
                    </h5>
                </div>
                <div class="col-sm-2 search-results recordCatSalesRecord">
                    <h5 class="primary-neutal-100 serif"><img src="img/recordCat_sales_records_white.svg" width="64px"
                            alt="Area 1" class="pb-2"><br>Sales Record
                    </h5>
                </div>
            </section>
        </div>
    </div>
    <!-- footer -->

    <script>
        function updateButtonDisplay(selectedItem) {
            var selectedValue = $(selectedItem).attr('value');
            var selectedText = $(selectedItem).text();

            // Update the button's text with the selected value
            $('#documentTypesButton').text(selectedText);

            // Optionally, you can store the selected value in a hidden input field for form submission
            $('input[name="filter_template_name"]').val(selectedValue);
        }
        // home search button clicked event
        $(document).ready(function () {
            $('.homeSearchBtn').click(function () {
                var keyword = $('input[name="provided_keyword"]').val();
                var templateName = $('#documentTypesButton').text();
                if (templateName === "All Document Types") {
                    templateName = "";
                }
                console.log(keyword);
                console.log(templateName);

                // Make the AJAX request
                $.ajax({
                    url: 'filterUploads.php',
                    method: 'GET',
                    data: {
                        provided_keyword: keyword,
                        filter_template_name: templateName
                    },
                    success: function (response) {
                        // Handle the AJAX success response
                        console.log(response);
                        // Make an additional AJAX request to set the session variable
                        $.ajax({
                            url: 'set_session.php',
                            method: 'POST',
                            data: { 
                                provided_keyword: keyword,
                                response: JSON.stringify(response) 
                            },
                            success: function () {
                                // Redirect to search_results.php
                                window.location.href = 'search_results.php';
                            },
                            error: function (error) {
                                // Handle the AJAX error
                                console.error(error);
                            }
                        });
                    },
                    error: function (error) {
                        // Handle the AJAX error
                        console.error(error);
                    }
                });
            });
        });
        // Nav Box clicked event 
        $(document).ready(function () {
            // Add click event handlers for each item
            $(".search-results").on("click", function () {
                var parameter = $(this).find('h5').text().trim();
                console.log("clicked" + parameter);

                // Make the API call for the clicked item
                $.ajax({
                    url: "filterUploads.php",
                    method: "GET",
                    data: { filter_template_name: parameter },
                    success: function (response) {
                        // Handle the API response
                        console.log(response);
                        // Make an additional AJAX request to set the session variable
                        $.ajax({
                            url: 'set_session.php',
                            method: 'POST',
                            data: { response: JSON.stringify(response) },
                            success: function () {
                                // Redirect to search_results.php
                                window.location.href = 'search_results.php';
                            },
                            error: function (error) {
                                // Handle the AJAX error
                                console.error(error);
                            }
                        });
                    },
                    error: function (xhr, status, error) {
                        // Handle API call error
                        console.log(error);
                    }
                });
            });
        });



    </script>

    <?php include "footer.php" ?>
</body>

</html>