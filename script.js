document.addEventListener('DOMContentLoaded', function () {
    // 1. DOM Elements
    const contactForm = document.getElementById('contactForm');
    const nameInput = document.getElementById('userName');
    const emailInput = document.getElementById('userEmail');
    const messageInput = document.getElementById('userMessage');
    const charCountDisplay = document.getElementById('charCount');
    const termsBox = document.getElementById('termsBox');
    const submitBtn = document.getElementById('submitBtn');

    // 2. Character Counter
    if (messageInput && charCountDisplay) {
        messageInput.addEventListener('keyup', function () {
            const length = messageInput.value.length;
            charCountDisplay.textContent = `${length} / 50 characters maximum`;

            if (length > 50) {
                charCountDisplay.style.color = "#ef4444";
                messageInput.style.border = "2px solid #ef4444";
            } else {
                charCountDisplay.style.color = "#4ade80";
                messageInput.style.border = "1px solid rgba(255, 255, 255, 0.1)";
            }
        });
    }

    // 3. Form Validation and Submission
    if (submitBtn && contactForm) {
        submitBtn.addEventListener('click', function () {
            const nameValue = nameInput.value.trim();
            const emailValue = emailInput.value.trim();
            const messageValue = messageInput.value.trim();
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            let error = "";

            if (nameValue === "") error = "Please enter your name.";
            else if (!emailPattern.test(emailValue)) error = "Please enter a valid email.";
            else if (messageValue.length > 50) error = "Message too long!";
            else if (termsBox && !termsBox.checked) error = "Please agree to the terms.";

            if (error !== "") {
                alert(error);
            } else {
                contactForm.submit();
            }
        });
    }
});

// 4. Smooth Scroll with Header Offset
document.querySelectorAll('nav a[href*="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const url = new URL(this.href);
        if (url.pathname === window.location.pathname || url.pathname === '/index.php') {
            const targetId = url.hash.substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                e.preventDefault();
                const headerHeight = document.querySelector('header').offsetHeight;
                window.scrollTo({
                    top: targetElement.offsetTop - headerHeight,
                    behavior: "smooth"
                });
            }
        }
    });
});