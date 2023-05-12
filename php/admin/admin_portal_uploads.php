<?php include 'head.php'; ?>
<?php include 'message.php'; ?>

<body id="page-top">
    <div class="wrapper">

        <!-- Sidebar  -->
        <?php include 'sidebar.php'; ?>

        <!-- Page Content  -->
        <div id="content">

            <!-- Topnav -->
            <?php include 'header.php' ?>

            <div class="container-fluid">

                <!-- Page header -->
                <div class="row mx-0 mb-4">
                    <div class="col-lg d-flex px-0">
                        <h1 class="h3 primary-red mb-0">Uploads</h1>
                    </div>
                </div>

                <!-- Page content -->
                <div class="row mx-0">

                    <!-- Tab menu -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="published-tab" data-bs-toggle="tab"
                                data-bs-target="#published-tab-pane" type="button" role="tab"
                                aria-controls="published-tab-pane" aria-selected="true">Pending for Approval</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="archived-tab" data-bs-toggle="tab"
                                data-bs-target="#archived-tab-pane" type="button" role="tab"
                                aria-controls="archived-tab-pane" aria-selected="false">Archived</button>
                        </li>
                    </ul>

                    <!-- Tab content -->
                    <div class="tab-content px-0" id="myTabContent">
                        <!-- Pending for approval tab -->
                        <div class="tab-pane fade show active" id="published-tab-pane" role="tabpanel"
                            aria-labelledby="published-tab" tabindex="0">
                            <table class="table table-striped table-hover">
                                <!-- Record listing content -->
                                <tbody>

                                    <?php
                                        // SQL query to fetch data from database
                                        $getPendingUpload = "SELECT uu.upload_id, uu.file_name, uu.contributor, uu.coverage, uu.creator, uu.date, uu.description, uu.format, uu.identifier, uu.language, uu.publisher, uu.relation, uu.rights, uu.source, uu.title, uu.first_name, uu.last_name, uu.email, uu.upload_status,uu.created, t.template_name, GROUP_CONCAT(DISTINCT k.keyword SEPARATOR ',') AS subject
                                        FROM user_uploads AS uu
                                        JOIN template AS t ON uu.template_id = t.id
                                        LEFT JOIN keyword_upload AS ku ON uu.upload_id = ku.upload_id
                                        LEFT JOIN keyword AS k ON ku.keyword_id = k.keyword_id
                                        WHERE upload_status = 1
                                        GROUP BY uu.upload_id";

                                        // Execute query and get results
                                        $getPendingUploadResult = $conn->query($getPendingUpload);

                                        // Check for errors
                                        if (!$getPendingUploadResult) {
                                            http_response_code(400);
                                            die("An error occurred while retrieving data: " . $conn->error);
                                        }

                                        // Check if there are any rows returned
                                        if ($getPendingUploadResult->num_rows > 0) {
                                            while($row = $getPendingUploadResult->fetch_assoc()) {
                                                // Extract individual row data
                                                extract($row);

                                                echo '<tr class="align-middle">';

                                                    // <!-- File name & document type -->
                                                    echo '<th scope="row" width="40%">';
                                                    echo '<p class="recordFileName mb-0">'.$title.'</p>';
                                                    echo '<p class="recordCategory mb-0">'.$template_name.'</p>';
                                                    echo '</th>';

                                                    // Upload date
                                                    $formatted_date = date('Y-m-d h:iA', strtotime($created));
                                                    echo '<td>'.$formatted_date.'</span></td>';

                                                    // Uploader details
                                                    echo '<td scope="row">';
                                                        echo '<p class="mb-0">' . $first_name . ' ' . $last_name . '</p>';
                                                        echo '<p class="mb-0">'.$row["email"].'</p>';
                                                    echo '</td>';

                                                    // Action button
                                                    echo '<td>';
                                                        echo '<button type="button" class="btn neutral-outlin-btn me-lg-2">';
                                                        echo '<a href="./admin_portal_edit_upload.php?id=' . $upload_id . '">';
                                                        echo '<i class="bi bi-pencil-fill pe-2"></i>Edit';
                                                        echo '</a>';
                                                        echo '</button>';
                                                    echo '</td>';
                                                echo '</tr>';
                                            }
                                            // Set response code to 200 OK
                                            http_response_code(200);
                                        } else {
                                            // Set response code to 400 Bad Request
                                            http_response_code(400);

                                            // Output error message
                                            echo "No uploads found.";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Archived tab -->
                        <div class="tab-pane fade" id="archived-tab-pane" role="tabpanel" aria-labelledby="archived-tab"
                            tabindex="0">
                            <table class="table table-striped table-hover">
                                <!-- Record listing content -->
                                <tbody>
                                    <?php
                                    // SQL query to fetch data from database
                                    $getArchivedUpload = "SELECT uu.upload_id, uu.file_name, uu.contributor, uu.coverage, uu.creator, uu.date, uu.description, uu.format, uu.identifier, uu.language, uu.publisher, uu.relation, uu.rights, uu.source, uu.title, uu.first_name, uu.last_name, uu.email, uu.upload_status,uu.created, t.template_name, GROUP_CONCAT(DISTINCT k.keyword SEPARATOR ',') AS subject
                                    FROM user_uploads AS uu
                                    JOIN template AS t ON uu.template_id = t.id
                                    LEFT JOIN keyword_upload AS ku ON uu.upload_id = ku.upload_id
                                    LEFT JOIN keyword AS k ON ku.keyword_id = k.keyword_id
                                    WHERE upload_status = 3
                                    GROUP BY uu.upload_id";

                                    // Execute query and get results
                                    $getArchivedUploadResult = $conn->query($getArchivedUpload);

                                    // Check for errors
                                    if (!$getArchivedUploadResult) {
                                        http_response_code(400);
                                        die("An error occurred while retrieving data: " . $conn->error);
                                    }

                                    // Check if there are any rows returned
                                    if ($getArchivedUploadResult->num_rows > 0) {
                                        while($row = $getArchivedUploadResult->fetch_assoc()) {
                                            // Extract individual row data
                                            extract($row);

                                            echo '<tr class="align-middle">';

                                            // <!-- File name & document type -->
                                            echo '<th scope="row" width="40%">';
                                            echo '<p class="recordFileName mb-0">'.$title.'</p>';
                                            echo '<p class="recordCategory mb-0">'.$template_name.'</p>';
                                            echo '</th>';

                                            // Upload date
                                            $formatted_date = date('Y-m-d h:iA', strtotime($created));
                                            echo '<td>'.$formatted_date.'</td>';

                                            // Uploader details
                                            echo '<td scope="row">';
                                            echo '<p class="mb-0">' . $first_name . ' ' . $last_name . '</p>';
                                            echo '<p class="mb-0">'.$row["email"].'</p>';
                                            echo '</td>';

                                            // Action button
                                            echo '<td>';
                                            echo '<button type="button" class="btn neutral-outlin-btn me-lg-2">';
                                            echo '<a href="./admin_portal_edit_upload.php?id=' . $upload_id . '">';
                                            echo '<i class="bi bi-pencil-fill pe-2"></i>Edit';
                                            echo '</a>';
                                            echo '</button>';
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                        // Set response code to 200 OK
                                        http_response_code(200);
                                    } else {
                                        // Set response code to 400 Bad Request
                                        http_response_code(400);

                                        // Output error message
                                        echo "No uploads found.";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'script.php' ?>
</body>


</html>