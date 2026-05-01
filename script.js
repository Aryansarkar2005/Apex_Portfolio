document.addEventListener('DOMContentLoaded', function () {
    // 5.1 VARIABLES, ARRAYS & LOOPS (Requirement: DONE ✅)
    const portfolioOwner = "Aryan Sarkar";
    const mySkills = ["HTML5", "CSS3", "JavaScript", "PHP", "MySQL"];

    console.log(`Portfolio of: ${portfolioOwner}`);
    mySkills.forEach((skill, index) => {
        console.log(`Skill ${index + 1}: ${skill}`);
    });

    // 5.2 DOM MANIPULATION (Requirement: DONE ✅)
    const contactForm = document.getElementById('contactForm');
    const nameInput = document.getElementById('userName');
    const emailInput = document.getElementById('userEmail');
    const messageInput = document.getElementById('userMessage');
    const charCountDisplay = document.getElementById('charCount');
    const termsBox = document.querySelector('input[name="terms"]');

    // Sync Initial State
    if (charCountDisplay) {
        charCountDisplay.textContent = `0 / 50 characters maximum`;
        charCountDisplay.style.color = "#4ade80";
    }

    // 5.3 EVENT HANDLING: KEYUP (Requirement: DONE ✅)
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

    // 5.4 MANUAL FORM SUBMISSION (Requirement: DONE ✅)
    const submitBtn = document.getElementById('submitBtn');

    if (submitBtn && contactForm) {
        submitBtn.addEventListener('click', function () {

            // --- THE FIX: Define these variables inside the click function ---
            const nameValue = nameInput.value.trim();
            const emailValue = emailInput.value.trim();
            const messageValue = messageInput.value.trim();
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            // 1. CHECK FOR ERRORS
            let error = "";

            if (nameValue === "") {
                error = "Please enter your name.";
            } else if (!emailPattern.test(emailValue)) {
                error = "Please enter a valid email address.";
            } else if (messageValue.length > 50) {
                error = "Message too long! Keep it under 50 characters.";
            } else if (termsBox && !termsBox.checked) {
                error = "Please agree to be contacted before submitting.";
            }

            // 2. DECIDE WHAT TO DO
            if (error !== "") {
                // Error found: Show alert and stop submission
                alert(error);
            } else {
                // SUCCESS: Silent hand-off to PHP.
                // This triggers the "Got it!" alert inside your index.php.
                contactForm.submit();
            }
        });
    }
});

// --- PRECISION SCROLL OFFSET FOR STICKY HEADER ---
document.querySelectorAll('nav a[href^="index.php#"], nav a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');

        // Only run this if the link is an anchor on the current page
        if (href.includes('#')) {
            e.preventDefault();
            const targetId = href.split('#')[1];
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                const headerHeight = document.querySelector('header').offsetHeight;
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerHeight;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });
            } else {
                // If the element isn't on this page, just follow the link normally
                window.location.href = href;
            }
        }
    });
});

// --- FIX FOR CROSS-PAGE ANCHOR GLITCH ---
window.addEventListener('load', function () {
    if (window.location.hash) {
        // Give the browser a tiny 100ms breath to finish rendering
        setTimeout(function () {
            const targetId = window.location.hash.substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                const headerHeight = document.querySelector('header').offsetHeight;
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerHeight;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });
            }
        }, 100);
    }
});