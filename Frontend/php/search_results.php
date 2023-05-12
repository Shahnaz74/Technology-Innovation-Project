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
                <form class="row mx-0">
                    <div class="col-md-8 mx-0">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <div class="dropdown input-group pe-2">
                                    <input type="text" class="form-control" aria-label="Text input with dropdown button"
                                        name="provided_keyword" required <?php
                                        if (isset($_SESSION["provided_keyword"]) && !empty($_SESSION["provided_keyword"])) {
                                            echo 'value="' . $_SESSION["provided_keyword"] . '"';
                                        }
                                        ?>>
                                    <button class="btn btn-secondary pe-lg-3 dropdown-toggle default_option"
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
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary homeSearchBtn"><i
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

                    <!-- Car Type Subject-->
                    <ul class="list-group list-group-flush border-bottom py-2">
                        <p class="filterHeading primary-neutal-900">Car Type Subject</p>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="car-type" value="All" id="carTypeAll"
                                checked>
                            <label class="form-check-label" for="carTypeAll">All Car Type Subject</label>
                        </li>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="car-type" value="LR1" id="carTypeLR1">
                            <label class="form-check-label" for="carTypeLR1">LR1</label>
                        </li>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="car-type" value="LR2" id="carTypeLR2">
                            <label class="form-check-label" for="carTypeLR2">LR2</label>
                        </li>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="car-type" value="P3" id="carTypeP3">
                            <label class="form-check-label" for="carTypeP3">P3</label>
                        </li>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="car-type" value="P4" id="carTypeP4">
                            <label class="form-check-label" for="carTypeP4">P4</label>
                        </li>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="car-type" value="P6" id="carTypeP6">
                            <label class="form-check-label" for="carTypeP6">P6</label>
                        </li>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="car-type" value="Range Rover"
                                id="carTypeRR">
                            <label class="form-check-label" for="carTypeRR">Range Rover</label>
                        </li>
                    </ul>

                    <!-- Publish Date -->
                    <ul class="list-group list-group-flush border-bottom py-4">
                        <p class=" filterHeading primary-neutal-900">Publish Date</p>
                        <div class=" dropdown year">
                            <button class="btn btn-outline-secondary dropdown-toggle default_option" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">All Year</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" value="All year">All year</a></li>
                                <li><a class="dropdown-item" value="1940-1960">1940-1960</a></li>
                                <li><a class="dropdown-item" value="1961-1980">1961-1980</a></li>
                                <li><a class="dropdown-item" value="1981-2000">1981-2000</a></li>
                                <li><a class="dropdown-item" value="2001-2023">2001-2023</a></li>
                            </ul>
                        </div>
                    </ul>

                    <!-- File publisher -->
                    <ul class="list-group list-group-flush border-bottom py-2">
                        <p class=" filterHeading primary-neutal-900">Publisher</p>
                        <li class=" list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="publisher" value="All Publishers"
                                id="publisherAll" checked>
                            <label class="form-check-label" for="publisherAll">All Publishers</label>
                        </li>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="publisher" value="The Motor"
                                id="publisherMotor">
                            <label class="form-check-label" for="publisherMotor">
                                The Motor
                            </label>
                        </li>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="publisher" value="Autocar"
                                id="publisherAutocar">
                            <label class="form-check-label" for="publisherAutocar">
                                Autocar
                            </label>
                        </li>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="publisher" value="Weekly Times"
                                id="publisherWeeklyTimes">
                            <label class="form-check-label" for="publisherWeeklyTimes">
                                Weekly Times
                            </label>
                        </li>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="publisher" value="Argus"
                                id="publisherArgus">
                            <label class="form-check-label" for="publisherArgus">
                                Argus
                            </label>
                        </li>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="publisher" value="The Age"
                                id="publisherAge">
                            <label class="form-check-label" for="publisherAge">
                                The Age
                            </label>
                        </li>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="publisher" value="The Herald"
                                id="publisherHerald">
                            <label class="form-check-label" for="publisherHerald">
                                The Herald
                            </label>
                        </li>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="publisher" value="The Sun News"
                                id="publisherSunNews">
                            <label class="form-check-label" for="publisherSunNews">
                                The Sun News
                            </label>
                        </li>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="publisher"
                                value="The Sydney Morning Herald" id="publisherSydenyMorning">
                            <label class="form-check-label" for="publisherSydenyMorning">
                                The Sydney Morning Herald
                            </label>
                        </li>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="publisher"
                                value="State Library Victoria" id="publisherStateLibrary">
                            <label class="form-check-label" for="publisherStateLibrary">
                                State Library Victoria
                            </label>
                        </li>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="publisher"
                                value="Herald and Weekly Times" id="publisherHWT">
                            <label class="form-check-label" for="publisherHWT">
                                Herald and Weekly Times
                            </label>
                        </li>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="publisher" value="Land Rover Co"
                                id="publisherLRC">
                            <label class="form-check-label" for="publisherLRC">
                                Land Rover Co
                            </label>
                        </li>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="publisher"
                                value="British Motor Heritage" id="publisherBMH">
                            <label class="form-check-label" for="publisherBMH">
                                British Motor Heritage
                            </label>
                        </li>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="publisher" value="Rover Company"
                                id="publisherRover">
                            <label class="form-check-label" for="publisherRover">
                                Rover Company
                            </label>
                        </li>
                        <li class="list-group-item px-0">
                            <input class="form-check-input" type="checkbox" name="publisher" value="Regent Motors"
                                id="publisherRM">
                            <label class="form-check-label" for="publisherRM">
                                Regent Motors
                            </label>
                        </li>
                    </ul>

                    <button id="applyFiltersBtn" class="btn btn-primary mt-3">Apply Filters</button>
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
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false" id="sortButton">
                                        Sort By: <span>Year - New to Old</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <!-- <li><a class="dropdown-item" value="relevance">Relevance</a></li> -->
                                        <li><a class="dropdown-item" value="year-asc">Year - Old to New</a>
                                        </li>
                                        <li><a class="dropdown-item" value="year-desc">Year - New to Old</a></li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-auto">
                            <?php
                            if (isset($_SESSION["filteredResponse"])) {
                                $jsonString = $_SESSION["filteredResponse"];
                                $jsonObj = json_decode($jsonString);

                                if ($jsonObj != null && property_exists($jsonObj, "uploads")) {
                                    echo "<p>" . count($jsonObj->uploads) . "<span> result(s)</span></p>";
                                } else {
                                    echo "<p>0<span> result(s)</span></p>";
                                }
                            } else if (isset($_SESSION["jsonString"])) {
                                $jsonString = $_SESSION["jsonString"];
                                $jsonObj = json_decode($jsonString);

                                if ($jsonObj != null && property_exists($jsonObj, "uploads")) {
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
                        $html = "";
                        if (isset($_SESSION["filteredResponse"])) {
                            $jsonString = $_SESSION["filteredResponse"];
                            $jsonObj = json_decode($jsonString);                            
                            if ($jsonObj != null && property_exists($jsonObj, "uploads")) {
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
                                    $html .= '<h4 id="titlecontainer" class="primary-red text-wrap text-break serif">' . $upload->title . '</h4>';
                                    $html .= '<p class="primary-neutal-800">' . $upload->description . '</p>';
                                    $html .= '<p class="primary-neutal-800">Published at ' . $upload->date . '</p>';
                                    $html .= '<div class="upload-id" style="display: none;"><p>' . $upload->upload_id . '</p></div>';
                                    $html .= '</div>';
                                    $html .= '</div>';
                                    $_SESSION["upload_" . $upload->upload_id] = $upload;
                                }
                            } else if ($jsonObj != null) {
                                $html .= $jsonObj->message;
                            }
                        } else if (isset($_SESSION["jsonString"])) {
                            $jsonString = $_SESSION["jsonString"];
                            $jsonObj = json_decode($jsonString);
                            if ($jsonObj != null && property_exists($jsonObj, "uploads")) {
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
                                    $html .= '<h4 id="titlecontainer" class="primary-red text-wrap text-break serif">' . $upload->title . '</h4>';
                                    $html .= '<p class="primary-neutal-800">' . $upload->description . '</p>';
                                    $html .= '<p class="primary-neutal-800">Published at ' . $upload->date . '</p>';
                                    $html .= '<div class="upload-id" style="display: none;"><p>' . $upload->upload_id . '</p></div>';
                                    $html .= '</div>';
                                    $html .= '</div>';
                                    $_SESSION["upload_" . $upload->upload_id] = $upload;
                                }
                            } else if ($jsonObj != null) {
                                $html .= $jsonObj->message;
                            }
                        }
                        if (!$html) {
                            $html .= "No uploads found with provided keyword.";
                        }                        
                        echo $html;
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script>
        function updateButtonDisplay(selectedItem) {
            var selectedValue = $(selectedItem).attr('value');
            var selectedText = $(selectedItem).text();

            // Update the button's text with the selected value
            $('#documentTypesButton').text(selectedText);

            // Optionally, you can store the selected value in a hidden input field for form submission
            $('input[name="filter_template_name"]').val(selectedValue);
        }

        function sortByOldToNew(array) {
            array.sort(function (a, b) {
                // Convert the date strings to Date objects for comparison
                const dateA = new Date(a.date);
                const dateB = new Date(b.date);

                // Compare the dates
                if (dateA < dateB) {
                    return -1; // dateA comes before dateB
                } else if (dateA > dateB) {
                    return 1; // dateA comes after dateB
                }
                return 0; // dates are equal
            });

            return array;
        }

        function sortByNewToOld(array) {
            array.sort(function (a, b) {
                // Convert the date strings to Date objects for comparison
                const dateA = new Date(a.date);
                const dateB = new Date(b.date);

                if (dateA > dateB) {
                    return -1; // dateA comes after dateB
                } else if (dateA < dateB) {
                    return 1; // dateA comes before dateB
                }

                return 0; // dates are equal
            });

            return array;
        }

        function initializeSortDropdown() {
            // Get the necessary elements
            const sortDropdown = document.querySelector('.dropdown.sort-by');
            const sortButton = sortDropdown.querySelector('.dropdown-toggle');
            const sortOptions = sortDropdown.querySelectorAll('.dropdown-item');

            const sorting = "<?php echo isset($_SESSION['sorting']) ? $_SESSION['sorting'] : ''; ?>";

            if (sorting === 'year-asc') {
                sortButton.innerHTML = `Sort By: <span>Year - Old to New</span>`; 
            } else {
                sortButton.innerHTML = `Sort By: <span>Year - New to Old</span>`; 
            }

            // Add click event listener to each sort option
            sortOptions.forEach(option => {
                option.addEventListener('click', function () {
                    const selectedOption = this.getAttribute('value');
                    sortButton.innerHTML = `Sort By: <span>${this.innerHTML}</span>`;

                    // Retrieve the session JSON string 
                    var jsonString = <?php echo json_encode($_SESSION["jsonString"]); ?>;
                    var filteredResponse = <?php echo json_encode($_SESSION["filteredResponse"]); ?>;
                    // Check if the JSON string is empty or null
                    if (!jsonString) {
                        return;
                    }

                    if (!filteredResponse) {
                        // Parse the JSON string to an object
                        var jsonObj = JSON.parse(jsonString);
                    } else {
                        var jsonObj = JSON.parse(filteredResponse);
                    }

                    // Perform sorting based on the selected option
                    if (selectedOption === 'year-asc') {
                        // Call your year-asc sorting function or perform any other action for year-asc sorting
                        console.log('Sorting by year - Old to New...');
                        jsonObj.uploads = sortByOldToNew(jsonObj.uploads);

                    } else if (selectedOption === 'year-desc') {
                        // Call your year-desc sorting function or perform any other action for year-desc sorting
                        console.log('Sorting by year - New to Old...');
                        jsonObj.uploads = sortByNewToOld(jsonObj.uploads);
                    }

                    // Convert the updated JSON object back to a string
                    var updatedJsonString = JSON.stringify(jsonObj);

                    console.log('Sorted:', updatedJsonString);

                    updateItemContainer(jsonString, updatedJsonString, selectedOption);
                });
            });
        }

        // Call the function to initialize the sort dropdown
        initializeSortDropdown();

        document.getElementById('applyFiltersBtn').addEventListener('click', applyFilters);

        // Get the dropdown button and menu
        var dropdownButton = document.querySelector('.dropdown.year .dropdown-toggle');
        var dropdownMenu = document.querySelector('.dropdown.year .dropdown-menu');

        // Add click event listener to the dropdown button
        dropdownButton.addEventListener('click', function () {
            // Toggle the dropdown menu visibility
            dropdownMenu.classList.toggle('show');
        });

        // Add click event listener to the dropdown menu items
        var dropdownItems = dropdownMenu.querySelectorAll('.dropdown-item');
        for (var i = 0; i < dropdownItems.length; i++) {
            dropdownItems[i].addEventListener('click', function () {
                // Get the selected value
                var selectedValue = this.getAttribute('value');

                // Update the dropdown button text
                dropdownButton.textContent = this.textContent;

                // Close the dropdown menu
                dropdownMenu.classList.remove('show');
            });
        }

        // Close the dropdown menu if user clicks outside of it
        window.addEventListener('click', function (event) {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.remove('show');
            }
        });

        function applyFilters() {

            // Get the selected filter values
            var selectedCarTypes = getSelectedCheckboxValues('car-type');
            var selectedPublishers = getSelectedCheckboxValues('publisher');
            var selectedPublishDate = dropdownButton.textContent;

            // Apply the filters to your search results
            console.log('Selected Car Types:', selectedCarTypes);
            console.log('Selected Publishers:', selectedPublishers);
            console.log('Selected Publish Date:', selectedPublishDate);

            // Retrieve the session JSON string 
            var jsonString = <?php echo json_encode($_SESSION["jsonString"]); ?>;
            // Check if the JSON string is empty or null
            if (!jsonString) {
                return;
            }

            // Parse the JSON string to an object
            var jsonObj = JSON.parse(jsonString);
            // Create an array to store the filtered uploads
            var filteredUploads = [];

            // Iterate over the uploads and apply filters
            if (jsonObj.hasOwnProperty("uploads")) {
                for (var i = 0; i < jsonObj.uploads.length; i++) {
                    var upload = jsonObj.uploads[i];

                    // Apply selectedCarTypes filter
                    if (selectedCarTypes.length > 0) {
                        if (selectedCarTypes.includes("All")) {
                            // "All" keyword selected, no need to check other keywords
                        } else if (!selectedCarTypes.some(keyword => upload.subject.includes(keyword))) {
                            continue;
                        }
                    }

                    // Apply selectedPublishDate filter
                    if (selectedPublishDate !== "All Year") {
                        var values = selectedPublishDate.split("-");
                        var startYear = values[0];
                        var endYear = values[1];

                        var selectedPublishYear = upload.date.split("-")[0];  // Extract the year from the date string

                        if (selectedPublishYear < startYear || selectedPublishYear > endYear) { // out of range{
                            continue;
                        }
                    }

                    // Apply selectedPublishers filter
                    if (selectedPublishers.length > 0) {
                        if (selectedPublishers.includes("All Publishers")) {
                            // "All" keyword selected, no need to check other keywords
                        } else if (!selectedPublishers.some(keyword => upload.publisher.toLowerCase().indexOf(keyword.toLowerCase()) !== -1)) {
                            continue;
                        }
                    }

                    // Add the upload to the filtered array
                    filteredUploads.push(upload);
                }
            }

            // Update the uploads array in the JSON object with the filtered uploads
            jsonObj.uploads = filteredUploads;

            // Convert the updated JSON object back to a string
            var updatedJsonString = JSON.stringify(jsonObj);

            console.log('Selected Publish Date:', updatedJsonString);

            updateItemContainer(jsonString, updatedJsonString);
        }

        function updateItemContainer(jsonString, updatedJsonString, sorting) {
            $.ajax({
                url: 'set_session.php',
                method: 'POST',
                data: {
                    response: jsonString,
                    filteredResponse: updatedJsonString,
                    sorting: sorting
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
        }

        function getSelectedCheckboxValues(checkboxName) {
            var checkboxes = document.querySelectorAll('input[name="' + checkboxName + '"]:checked');
            var values = [];
            for (var i = 0; i < checkboxes.length; i++) {
                values.push(checkboxes[i].value);
            }
            return values;
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
</body>

</html>