<?php include "head.php" ?>

<body class="homePage">

    <!-- Top Nav Bar -->
    <?php include "header.php" ?>

    <div class="wrapper">
        <div class="user-content ">
            <div class="container-fluid homeHero">

                <!-- Search Form -->
                <form id="home-search-form" class="row mx-0" action="search_results.php" method="GET">
                    <!-- Search Bar -->
                    <!-- <div class="search-area">
                        <div class="search_field">
                            <input type="text" class="input" name="query" placeholder="Search">
                        </div>
                        <div class="dropdown">
                            <div class="default_option">All Document Type</div>
                            <ul>
                                <li>All</li>
                                <li>PDF</li>
                                <li>IMAGE</li>
                            </ul>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block sans"><i
                            class="bi bi-search pe-2"></i>Search</button>
                    </div> -->

                    <div class="d-flex justify-content-center align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex mb-3">
                                <div class="flex-grow-1">
                                    <div class="input-group pe-2">
                                        <input type="text" class="form-control"
                                            aria-label="Text input with dropdown button">
                                        <button class="btn btn-light pe-lg-5 dropdown-toggle default_option"
                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">All Document
                                            Types</button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#">All</a></li>
                                            <li><a class="dropdown-item" href="#">PDF</a></li>
                                            <li><a class="dropdown-item" href="#">IMAGE</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary homeSearchBtn"><i
                                        class="bi bi-search pe-2"></i>Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Nav Boxes -->
            <section class="row">
                <div class="col-sm-2 search-results recordCatAdv">
                    <h5 class="primary-neutal-100 serif"><img src="img/recordCat_advertisement_white.svg"
                            width="64px" alt="Area 1" class="pb-2"><br>Advertisement
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
                    <h5 class="primary-neutal-100 serif"><img src="img/recordCat_sales_brochure_white.svg"
                            width="64px" alt="Area 1" class="pb-2"><br>Sales
                        Brochure
                    </h5>
                </div>
                <div class="col-sm-2 search-results recordCatSalesRecord">
                    <h5 class="primary-neutal-100 serif"><img src="img/recordCat_sales_records_white.svg"
                            width="64px" alt="Area 1" class="pb-2"><br>Sales Record
                    </h5>
                </div>
            </section>
        </div>
    </div>
    <!-- footer -->
    
    <?php include "footer.php" ?>
    <?php include "scripts.php" ?>
</body>

</html>