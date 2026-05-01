<footer>
        <div class="footer-container" style="text-align: center; padding: 20px; border-top: 1px solid rgba(255, 255, 255, 0.1); margin-top: 50px;">
            <p>&copy; <span id="currentYear"></span> <?php echo $my_name; ?> - Apex Planet Task 1 Deliverable</p>
            <p style="font-size: 0.8rem; color: var(--text-muted);">
                Data Science Student | Built with PHP, CSS Grid & JavaScript
            </p>
        </div>
    </footer>

    <!-- INTERNAL JAVASCRIPT (Roadmap Requirement 5.1 & 5.4) -->
    <script>
        // 1. Using a Variable and Date Object
        const date = new Date();
        const year = date.getFullYear();

        // 2. DOM Manipulation: Grabbing the span and changing its text
        const yearSpan = document.getElementById('currentYear');
        if (yearSpan) {
            yearSpan.textContent = year;
        }

        // 3. Simple Event Log (Proof of Internal JS)
        console.log("Internal JS: Footer year updated to " + year);
    </script>

    <!-- EXTERNAL JAVASCRIPT -->
    <script src="script.js"></script>
</body>
</html>