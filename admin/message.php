<?php if(isset($_SESSION) && isset($_SESSION['error'])){ ?>
    <!-- Toast message -->
    <div class="toast-container position-absolute top-0 p-3 mt-5 end-0 alert">
        <div class=" toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
            <div class="toast-body">
                <button type="button" class="btn-close pull-right" data-bs-dismiss="toast" aria-label="Close"></button>
                    <?php echo !empty($_SESSION['error']) ? $_SESSION['error'] :''; ?>
                <i class="bi bi-cross-cross-fill pe-2"></i>
            </div>
        </div>
    </div>

<?php
 } 
    // unset($_SESSION['error']);

 ?>

<?php if(isset($_SESSION) && isset($_SESSION['message'])){
    $message = $_SESSION['message'];

 ?>
<!-- Toast message -->
<div class="toast-container position-absolute top-0 p-3 mt-5 end-0 alert">
    <div class=" toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
        <div class="toast-body">
            <button type="button" class="btn-close pull-right" data-bs-dismiss="toast" aria-label="Close"></button>
            <?php echo !empty($message) ? $message :''; ?>
        </div>
    </div>
</div>
<?php 

    
}
if(isset($_SESSION['message'])){    
    // unset($_SESSION['message']);
} 

?>

