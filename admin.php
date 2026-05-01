<?php 
include('db.php'); 
include('header.php'); 

// --- 1. LOGIC LAYER (The "Brain") ---

// 7.2 MYSQL BASICS: DELETE Logic
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $del_sql = "DELETE FROM inquiries WHERE id = $id";
    if ($conn->query($del_sql)) {
        header("Location: admin.php");
        exit(); 
    }
}

// 7.2 MYSQL BASICS: UPDATE Logic
if (isset($_GET['read_id'])) {
    $id = intval($_GET['read_id']);
    $upd_sql = "UPDATE inquiries SET status = 'Read' WHERE id = $id";
    if ($conn->query($upd_sql)) {
        header("Location: admin.php");
        exit();
    }
}

// 7.2 MYSQL BASICS: SELECT Logic 
// CHANGED: ORDER BY id ASC so new entries stack at the BOTTOM
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
                        <th>#</th> <!-- Changed from ID to # for sequential numbering -->
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
                        $display_id = 1; // Start our virtual counter
                        while($row = $result->fetch_assoc()): 
                        ?>
                            <tr style="<?php echo ($row['status'] == 'Read') ? 'opacity: 0.5;' : ''; ?>">
                                <!-- FIX: Displaying the sequential number instead of the Database ID -->
                                <td><?php echo $display_id++; ?></td>
                                
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['type']); ?></td>
                                <td>
                                    <span style="color: <?php echo (strtolower($row['priority']) == 'urgent') ? '#ef4444' : '#4ade80'; ?>; font-weight: bold;">
                                        <?php echo ucfirst($row['priority']); ?>
                                    </span>
                                </td>
                                <td><?php echo htmlspecialchars($row['message']); ?></td>
                                <td>
                                    <!-- Only show "Read" if it hasn't been clicked yet -->
                                    <?php if ($row['status'] != 'Read'): ?>
                                        <a href="admin.php?read_id=<?php echo $row['id']; ?>" 
                                           style="color: var(--accent); text-decoration: none; margin-right: 15px;">✔ Read</a>
                                    <?php endif; ?>
                                    
                                    <!-- Keep row['id'] for the backend link so the DB knows what to delete -->
                                    <a href="admin.php?delete_id=<?php echo $row['id']; ?>" 
                                       style="color: #ef4444; text-decoration: none;" 
                                       onclick="return confirm('Permanent delete. Proceed?')">🗑 Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="6" style="text-align: center;">No messages found in database.</td></tr>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" style="text-align: center; font-weight: bold; background: rgba(255,255,255,0.05);">
                            Total Inquiries: <?php echo $result ? $result->num_rows : 0; ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </section>
</main>

<?php include('footer.php'); ?>