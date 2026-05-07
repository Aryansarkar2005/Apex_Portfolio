<?php 
include('db.php'); 
include('header.php'); 

// 1. FORM PROCESSING LOGIC
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']); 
    $type = mysqli_real_escape_string($conn, $_POST['type']); 
    $priority = mysqli_real_escape_string($conn, $_POST['prio']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "INSERT INTO inquiries (name, email, type, priority, message, status) 
            VALUES ('$name', '$email', '$type', '$priority', '$message', 'Unread')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Got it, $name! Your inquiry has been saved.');
                window.location.href='index.php';
              </script>";
    }
}

// 2. CATEGORY FETCHING (Graceful failure if table doesn't exist)
$categories = false;
$table_check = mysqli_query($conn, "SHOW TABLES LIKE 'categories'");
if (mysqli_num_rows($table_check) > 0) {
    $categories = mysqli_query($conn, "SELECT * FROM categories");
}
?>

<main>
    <section id="media">
        <h2>Creative Showcase</h2>
        <div class="video-container">
            <h3>Cinematic AI Reel</h3>
            <video width="100%" controls poster="assets/video-placeholder.jpg">
                <source src="assets/ai-showcase.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="audio-container" style="margin-top: 30px;">
            <h3>Project Voiceover</h3>
            <audio controls style="width: 100%;">
                <source src="assets/intro-audio.mp3" type="audio/mpeg">
            </audio>
        </div>
    </section>

    <section id="education">
        <h2>Academic Summary</h2>
        <div class="table-container">
            <table>
                <thead>
                     <tr>
                        <th>Degree</th>
                        <th>Institution</th>
                        <th>Year</th>
                     </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo htmlspecialchars($academic_info['degree']); ?></td>
                        <td><?php echo htmlspecialchars($my_university); ?></td>
                        <td><?php echo htmlspecialchars($academic_info['graduation_year']); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section id="projects-section">
        <h2>My Projects</h2>
        <div id="projects">
            <?php foreach($my_projects as $project): ?>
                <article class="project-card">
                    <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                    <p><em>Tech: <?php echo htmlspecialchars($project['tech']); ?></em></p>
                    <p>Status: <?php echo getStatusBadge($project['status']); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section id="contact">
        <h2>Contact Inquiry</h2>
        <form action="index.php" method="POST" id="contactForm">
            <div class="form-group">
                <label for="userName">Full Name:</label>
                <input type="text" name="name" id="userName" placeholder="Your Name" required>
            </div>
            <div class="form-group">
                <label for="userEmail">Email Address:</label>
                <input type="email" name="email" id="userEmail" placeholder="example@mail.com" required>
            </div>
            <div class="form-group">
                <label for="inquiryType">Inquiry Type:</label>
                <select name="type" id="inquiryType">
                    <?php 
                    if ($categories && mysqli_num_rows($categories) > 0) {
                        while($cat = mysqli_fetch_assoc($categories)) {
                            echo "<option value='".htmlspecialchars($cat['cat_name'])."'>".htmlspecialchars($cat['cat_name'])."</option>";
                        }
                    } else {
                        echo "<option value='General Inquiry'>General Inquiry</option>";
                        echo "<option value='Internship'>Internship</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="priority-container">
                <label>Priority Level:</label>
                <div class="radio-options">
                    <label><input type="radio" name="prio" value="Normal" checked> Normal</label>
                    <label><input type="radio" name="prio" value="Urgent"> Urgent</label>
                </div>
            </div>
            <div class="form-group">
                <label for="userMessage">Message:</label>
                <textarea name="message" id="userMessage" rows="4" placeholder="How can I help you?"></textarea>
                <small id="charCount">0 / 50 characters maximum</small>
            </div>
            <div class="checkbox-group">
                <label><input type="checkbox" name="terms" id="termsBox"> I agree to be contacted.</label>
            </div>
            <button type="button" id="submitBtn">Submit Details</button>
        </form>
    </section>
</main>

<script src="script.js?v=<?php echo time(); ?>"></script>
<?php include('footer.php'); ?>