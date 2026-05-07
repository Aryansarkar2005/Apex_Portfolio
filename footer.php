<footer>
        <div class="footer-container" style="text-align: center; padding: 20px; border-top: 1px solid rgba(255, 255, 255, 0.1); margin-top: 50px;">
            <p>&copy; <span id="currentYear"></span> <?php echo $my_name; ?> - Portfolio Task 1</p>
            <p style="font-size: 0.8rem; color: var(--text-muted);">
                Built with PHP, CSS Grid & JavaScript
            </p>
        </div>
    </footer>

    <script>
        const date = new Date();
        const yearSpan = document.getElementById('currentYear');
        if (yearSpan) { yearSpan.textContent = date.getFullYear(); }
    </script>
    <script src="script.js"></script>
</body>
</html>