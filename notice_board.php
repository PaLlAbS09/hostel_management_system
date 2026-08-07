<?php
include '../config/auth.php';
include '../config/dbcon.php';
include '../includes/header.php';
include '../includes/nav.php';


$notices = $pdo->query("SELECT * FROM notices ORDER BY id DESC")->fetchAll();

?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark m-0">Notice Board</h3>
            <button class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add New Notice</button>
        </div>

        <div class="row">
            <?php foreach ($notices as $notice): ?>
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100 border-start border-primary border-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <h5 class="card-title fw-bold text-dark m-0"><?= htmlspecialchars($notice['title']) ?></h5>
                                <span class="badge bg-light text-dark border"><?= date('d M, Y', strtotime($notice['date'])) ?></span>
                            </div>
                            <p class="card-text text-muted"><?= htmlspecialchars($notice['message']) ?></p>
                            <div class="mt-3">
                                <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i> Edit</button>
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i> Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>