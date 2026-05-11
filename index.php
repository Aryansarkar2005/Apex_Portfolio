<?php 
include('db.php'); 
include('header.php'); 

$status_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $priority = trim($_POST['priority'] ?? 'Normal');
    $message = trim($_POST['message'] ?? '');
    
    if (empty($name) || empty($email) || empty($message)) {
        $status_message = "<div class='alert error'>Please fill in all required fields.</div>";
    } elseif (strlen($message) > 50) {
        $status_message = "<div class='alert error'>Message is too long. Max 50 characters.</div>";
    } else {
        $stmt = $conn->prepare("INSERT INTO inquiries (name, email, priority, message) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("ssss", $name, $email, $priority, $message);
            if ($stmt->execute()) {
                $status_message = "<div class='alert success'>Message sent successfully!</div>";
            } else {
                $status_message = "<div class='alert error'>Something went wrong. Please try again.</div>";
            }
            $stmt->close();
        } else {
            $status_message = "<div class='alert error'>Database error.</div>";
        }
    }
}
?>
<main>
    <section id="home">
        <h2 class="section-subtitle">Welcome Back</h2>
        <p>Current Status: <strong>3rd Year Undergraduate</strong> at <?php echo $my_university; ?></p>
        <p>Focusing on ultra-realistic AI generation and cinematic development.</p>
        
        <div class="multimedia-showcase">
            <video width="100%" controls>
                <source src="assets/ai-showcase.mp4" type="video/mp4">
            </video>
            <audio controls>
                <source src="assets/intro-audio.mp3" type="audio/mpeg">
            </audio>
        </div>
    </section>

    <section id="education">
        <h2>Academic Summary</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr><th>Level</th><th>Institution</th><th>Status</th><th>Year</th></tr>
                </thead>
                <tbody>
                    <?php foreach($academic_history as $edu): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($edu['level']); ?></td>
                        <td><?php echo htmlspecialchars($edu['inst']); ?></td>
                        <td><strong><?php echo htmlspecialchars($edu['status']); ?></strong></td>
                        <td><?php echo htmlspecialchars($edu['year']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section id="projects-section">
        <h2>My Projects</h2>
        <div id="projects">
            <?php foreach($my_projects as $p): ?>
                <article class="project-card">
                    <h3><?php echo htmlspecialchars($p['title']); ?></h3>
                    <p class="project-tech">Tech: <?php echo htmlspecialchars($p['tech']); ?></p>
                    <p><?php echo getStatusBadge($p['status']); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section id="contact">
        <h2>Connect</h2>
        <?php echo $status_message; ?>
        <form action="index.php" method="POST" id="contactForm">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" id="userName" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" id="userEmail" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label>Inquiry Priority:</label>
                <select name="priority" id="inquiryPriority">
                    <option value="Normal">Normal</option>
                    <option value="Immediate">Immediate</option>
                </select>
            </div>
            <div class="form-group">
                <label for="userMessage">Message:</label>
                <input type="text" id="userMessage" name="message" placeholder="How can I help you?">
                
                <div id="charCount">0 / 50 characters</div>
            </div>
            <div class="checkbox-row">
                <div class="checkbox-group">
                    <input type="checkbox" name="terms" id="termsBox">
                <label for="termsBox" class="terms-label">I agree to be contacted.</label>
                </div>
            </div>
            <button type="button" id="submitBtn">Send Message</button>
        </form>
    </section>
</main>
<script src="script.js?v=<?php echo time(); ?>"></script>
<?php include('footer.php'); ?>