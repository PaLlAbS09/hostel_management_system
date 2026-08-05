<?php  
include './config/auth.php'; 
include './includes/header.php';  
include './includes/nav.php';  
?>
<div class="page-wrapper">     
    <div class="container-fluid">         
        <div class="row justify-content-center">             
            <div class="col-md-6">                 
                <h4 class="card-title mb-3">Change Password</h4>                 
                <?php if(isset($_SESSION['error'])): ?>                     
                    <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>                 
                <?php endif; ?>                                  
                
                <div class="card p-4 shadow-sm">                     
                    <form action="./Authentication/change_process.php" id="changePasswordForm" method="POST">                         
                        <div class="form-group mb-3">                             
                            <label class="text-dark">Email Address</label>                             
                            <input type="email" name="email" id="email" class="form-control" required>                         
                        </div>                         
                        <div class="form-group mb-3">                             
                            <label class="text-dark">Old Password</label>                             
                            <input type="password" name="old_password" id="old_password" class="form-control" required>                         
                        </div>                         
                        <div class="form-group mb-3">                             
                            <label class="text-dark">New Password</label>                             
                            <input type="password" name="new_password" id="new_password" class="form-control" required minlength="6">                         
                        </div>                         
                        <div class="form-group mb-4">                             
                            <label class="text-dark">Confirm New Password</label>                             
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required minlength="6">                         
                        </div>                         
                        <button type="submit" class="btn btn-warning w-100">Update Password</button>                     
                    </form>                 
                </div>             
            </div>         
        </div>     
    </div> 
    
    <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#changePasswordForm').on('submit', function(e) {
            let newPassword = $('#new_password').val();
            let confirmPassword = $('#confirm_password').val();
            
            if (newPassword.length < 6) {
                alert('New password must be at least 6 characters long.');
                e.preventDefault();
                return false;
            }
            if (newPassword !== confirmPassword) {
                alert('New password and Confirm password do not match.');
                e.preventDefault();
                return false;
            }
        });
    });
    </script>

<?php include './includes/footer.php'; ?>