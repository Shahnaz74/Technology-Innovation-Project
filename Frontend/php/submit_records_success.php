<?php include "head.php" ?>

<body>
    <!-- Top Nav Bar -->
    <?php include "header.php" ?>

    <div class="d-flex justify-content-center align-items-center fullPageHeight">
        <div class="text-center mt-5">
            <img src="../img/upload-success.svg" class="mb-5" alt="">
            <h1 class="h3 primary-red mb-3">Upload Success!</h1>
            <p>Thank you. Your record has been submitted successfully.</p>
        </div>
    </div>

    <!-- footer -->
    <?php include "footer.php" ?>

    <script>
        // Redirect to homepage after 3 seconds
        setTimeout(function () {
            window.location.href = "index.php";
        }, 3000);

    </script>

</body>

</html>