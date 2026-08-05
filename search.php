<?php  
include './config/auth.php'; 
include './config/dbcon.php'; 
include './includes/header.php'; 
include './includes/nav.php'; 

$results = []; 
if (isset($_GET['q'])) {     
    $searchTerm = "%" . $_GET['q'] . "%";     
    $stmt = $pdo->prepare("         
        SELECT * FROM students          
        WHERE first_name LIKE ?          
        OR last_name LIKE ?          
        OR reg_no LIKE ?          
        OR room_no LIKE ?     
    ");     
    $stmt->execute([$searchTerm, $searchTerm, $searchTerm, $searchTerm]);     
    $results = $stmt->fetchAll(); 
}
?>
<div class="page-wrapper">     
    <div class="container-fluid">         
        <h4 class="card-title mb-3">Search Students</h4>                  
        
        <div class="card p-4 shadow-sm mb-4">             
            <form method="GET" class="d-flex">                 
                <input type="text" name="q" class="form-control mr-2" placeholder="Search by name, reg no, or room..." required value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">                 
                <button type="submit" class="btn btn-primary">Search</button>             
            </form>         
        </div>         
        
        <?php if (isset($_GET['q'])): ?>             
            <h5 class="mb-3 text-dark">Results for "<?= htmlspecialchars($_GET['q']) ?>"</h5>                          
            <div class="card">                 
                <div class="card-body">                     
                    <div class="table-responsive">                         
                        <table class="table table-bordered table-striped no-wrap">                             
                            <thead class="bg-dark text-white">                                 
                                <tr>                                     
                                    <th>Reg No</th>                                     
                                    <th>Name</th>                                     
                                    <th>Room No</th>                                     
                                    <th>Contact</th>                                     
                                    <th>Actions</th>                                 
                                </tr>                             
                            </thead>                             
                            <tbody>                                 
                                <?php foreach($results as $res): ?>                                     
                                    <tr>                                         
                                        <td><?= htmlspecialchars($res['reg_no']) ?></td>                                         
                                        <td><?= htmlspecialchars($res['first_name'] . ' ' . $res['last_name']) ?></td>                                         
                                        <td><?= htmlspecialchars($res['room_no']) ?></td>                                         
                                        <td><?= htmlspecialchars($res['contact_no']) ?></td>                                         
                                        <td>                                             
                                            <a href="./students/edit.php?id=<?= $res['id'] ?>" class="btn btn-sm btn-warning">Edit</a>                                         
                                        </td>                                     
                                    </tr>                                 
                                <?php endforeach; ?>                                 
                                <?php if(empty($results)): ?>                                     
                                    <tr><td colspan="5" class="text-center text-danger">No students found matching your search.</td></tr>                                 
                                <?php endif; ?>                             
                            </tbody>                         
                        </table>                     
                    </div>                 
                </div>             
            </div>         
        <?php endif; ?>     
    </div> 
<?php include './includes/footer.php'; ?>