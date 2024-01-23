<?php include "head.php" ?>

<body>
    <!-- Top Nav Bar -->
    <?php include "header.php" ?>

    <!-- Search Bar -->
    <form class="row mx-0" action="search_results.html" method="GET">
        <!-- Search Bar -->
        <div class="search-area-2">
            <div class="search_field input-group">
                <input id="uploaded-file-name" type="text" class="form-control" placeholder="" aria-label="">
            </div>
            <button type="submit" class="btn btn-primary btn-block sans"><i
                    class="bi bi-search pe-2"></i>Search</button>
        </div>
        <div class="search-options">
            <!-- Radio buttons to replace the select element -->
            <label>
                <input type="radio" name="documentType" value="All Document Types">
                All Document Types
            </label>
            <label>
                <input type="radio" name="documentType" value="Advertisement Journal">
                Advertisement Journal
            </label>
            <label>
                <input type="radio" name="documentType" value="Advertisement Newspaper">
                Advertisement Newspaper
            </label>
            <label>
                <input type="radio" name="documentType" value="Article Journal">
                Article Journal
            </label>
            <label>
                <input type="radio" name="documentType" value="Article Newspaper">
                Article Newspaper
            </label>
            <label>
                <input type="radio" name="documentType" value="Book Historical">
                Book Historical
            </label>
            <label>
                <input type="radio" name="documentType" value="Book Technical">
                Book Technical
            </label>
            <label>
                <input type="radio" name="documentType" value="Photograph Commercial">
                Photograph Commercial
            </label>
            <label>
                <input type="radio" name="documentType" value="Photograph Personal">
                Photograph Personal
            </label>
            <label>
                <input type="radio" name="documentType" value="Sales Brochure">
                Sales Brochure
            </label>
            <label>
                <input type="radio" name="documentType" value="Sales Record">
                Sales Record
            </label>
        </div>
    </form>

    <div class="row mx-0">
        <div id="search-result-content" class="container-fluid d-flex">
            <div class="filter-section">
                <ul>
                    <li>
                        <label>Car Type</label>
                        <input type="checkbox" name="car-type" value="Sedan">Sedan<br>
                        <input type="checkbox" name="car-type" value="SUV">SUV<br>
                        <input type="checkbox" name="car-type" value="Hatchback">Hatchback<br>
                        <input type="checkbox" name="car-type" value="Sports Car">Sports Car<br>
                    </li>
                    <li>
                        <p><label>Publish Date</label>From:
                            <select name="year-from">
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                            </select>
                            To:
                            <select name="year-to">
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                            </select>
                        </p>
                    </li>
                    <li>
                        <label>Source</label>
                        <input type="checkbox" name="source" value="Dealer">Dealer<br>
                        <input type="checkbox" name="source" value="Private">Private<br>
                    </li>
                </ul>
            </div>

            <div class="search-result-section flex-grow-1">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2>Search Result</h2>
                    <div class="sort-by">
                        <label for="sort-by-select">Sort By:</label>
                        <select id="sort-by-select" name="sort-by">
                            <option value="relevance">Relevance</option>
                            <option value="price-asc">Price: Low to High</option>
                            <option value="price-desc">Price: High to Low</option>
                            <option value="year-asc">Year: Old to New</option>
                            <option value="year-desc">Year: New to Old</option>
                        </select>
                    </div>
                </div>
                <!--Document Item-->
                <div class="search-result-item row">
                    <div class="col-2">
                        <img src="img/uploadFileDummy.png" class="img-thumbnail" alt="...">
                    </div>
                    <div class="col">
                        <!--Document Type-->
                        <div>Advertisement</div>
                        <!--Document Title-->
                        <div>Rover Regent Motors Advertred 2</div>
                        <!--Document Description-->
                        <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                            ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat...</div>
                        <!--Publish Date-->
                        <div>Published at Jun, 1999</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include "footer.php" ?>
    <?php include "scripts.php" ?>
</body>

<!--
    <div class="main-container">
        <div class="filter-section">
            <h2>Filter Results</h2>
            <ul>
                <li>
                    <label>Car Type</label>
                    <input type="checkbox" name="car-type" value="Sedan">Sedan<br>
                    <input type="checkbox" name="car-type" value="SUV">SUV<br>
                    <input type="checkbox" name="car-type" value="Hatchback">Hatchback<br>
                    <input type="checkbox" name="car-type" value="Sports Car">Sports Car<br>
                </li>
                <li>
                    <p><label>Publish Date</label>From:
                        <select name="year-from">
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                        </select>
                        To:
                        <select name="year-to">
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                        </select>
                    </p>
                </li>
                <li>
                    <label>Source</label>
                    <input type="checkbox" name="source" value="Dealer">Dealer<br>
                    <input type="checkbox" name="source" value="Private">Private<br>
                </li>
            </ul>
        </div>
        <div class="search-result-section">
            <h2>Search Result</h2>
            <div class="sort-by">
                <label for="sort-by-select">Sort By:</label>
                <select id="sort-by-select" name="sort-by">
                    <option value="relevance">Relevance</option>
                    <option value="price-asc">Price: Low to High</option>
                    <option value="price-desc">Price: High to Low</option>
                    <option value="year-asc">Year: Old to New</option>
                    <option value="year-desc">Year: New to Old</option>
                </select>
            </div>
            <div class="search-result-item">
                <h3>Product 1</h3>
                <p>Description of Product 1</p>
                <p>Category: Books</p>
                <p>Price: $10</p>
                <p>Brand: Apple</p>
            </div>
            <div class="search-result-item">
                <h3>Product 2</h3>
                <p>Description of Product 2</p>
                <p>Category: Electronics</p>
                <p>Price: $50</p>
                <p>Brand: Samsung</p>
            </div>
        </div>
    </div>
 -->

</html>