<?php 
include('db.php'); 
include('header.php'); 

$status_message = "";

// Handle deletion
if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    $stmt = $conn->prepare("DELETE FROM inquiries WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $status_message = "<div class='alert success'>Inquiry deleted successfully.</div>";
        } else {
            $status_message = "<div class='alert error'>Failed to delete inquiry.</div>";
        }
        $stmt->close();
    }
}
?>
<main>
    <section>
        <h2>Admin Dashboard</h2>
        <?php echo $status_message; ?>
        <div class="table-container admin-table">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th> 
                        <th>Priority</th> 
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $res = $conn->query("SELECT * FROM inquiries");
                    if($res->num_rows > 0): $c=1; while($row = $res->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $c++; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['priority']); ?></td>
                        <td><?php echo htmlspecialchars($row['message']); ?></td>
                        <td>
                            <a href="admin.php?del=<?php echo $row['id']; ?>" class="btn-enlighten">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>
<?php include('footer.php'); ?>