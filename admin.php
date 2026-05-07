<?php 
include('db.php'); 
include('header.php'); 

// 1. DELETE ACTION
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $del_sql = "DELETE FROM inquiries WHERE id = ?";
    $stmt = $conn->prepare($del_sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: admin.php");
        exit(); 
    }
}

// 2. MARK AS READ ACTION
if (isset($_GET['read_id'])) {
    $id = intval($_GET['read_id']);
    $upd_sql = "UPDATE inquiries SET status = 'Read' WHERE id = ?";
    $stmt = $conn->prepare($upd_sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: admin.php");
        exit();
    }
}

// 3. FETCH INQUIRIES
$sql = "SELECT * FROM inquiries ORDER BY id ASC";
$result = $conn->query($sql);
?>

<main>
    <section>
        <h2>Admin Dashboard: Contact Inquiries</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Priority</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php 
                        $counter = 1;
                        while($row = $result->fetch_assoc()): 
                        ?>
                            <tr style="<?php echo ($row['status'] == 'Read') ? 'opacity: 0.5;' : ''; ?>">
                                <td><?php echo $counter++; ?></td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['type']); ?></td>
                                <td>
                                    <span style="color: <?php echo (strtolower($row['priority']) == 'urgent') ? '#ef4444' : '#4ade80'; ?>; font-weight: bold;">
                                        <?php echo ucfirst($row['priority']); ?>
                                    </span>
                                </td>
                                <td><?php echo htmlspecialchars($row['message']); ?></td>
                                <td>
                                    <?php if ($row['status'] != 'Read'): ?>
                                        <a href="admin.php?read_id=<?php echo $row['id']; ?>" style="color: var(--accent); text-decoration: none; margin-right: 15px;">✔ Read</a>
                                    <?php endif; ?>
                                    <a href="admin.php?delete_id=<?php echo $row['id']; ?>" style="color: #ef4444; text-decoration: none;" onclick="return confirm('Permanent delete. Proceed?')">🗑 Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="6" style="text-align: center;">No messages found in database.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php include('footer.php'); ?>