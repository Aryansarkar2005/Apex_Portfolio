document.addEventListener('DOMContentLoaded', () => {
    const headerHeight = 85;

    // 1. Navigation Logic
    document.querySelectorAll('nav a').forEach(link => {
        link.onclick = (e) => {
            const href = link.getAttribute('href');
            if (href.includes('#')) {
                e.preventDefault();
                const target = document.querySelector('#' + href.split('#')[1]);
                if (target) window.scrollTo({ top: target.offsetTop - headerHeight, behavior: 'smooth' });
            }
        };
    });

    // 2. Character Counter
    const msgInput = document.getElementById('userMessage');
    const countDiv = document.getElementById('charCount');

    if (msgInput && countDiv) {
        msgInput.addEventListener('input', () => {
            const val = msgInput.value.length;
            countDiv.innerText = `${val} / 50 characters`;

            if (val === 0) {
                countDiv.style.color = "#d2b48c";
                countDiv.style.opacity = "0.6";
                countDiv.style.textShadow = "none";
            } else if (val <= 50) {
                countDiv.style.color = "#2ecc71";
                countDiv.style.opacity = "1";
                countDiv.style.textShadow = "0 0 10px rgba(46, 204, 113, 0.6)";
            } else {
                countDiv.style.color = "#ff4d4d";
                countDiv.style.opacity = "1";
                countDiv.style.textShadow = "0 0 10px rgba(255, 77, 77, 0.6)";
            }
        });
    }

    // 3. Validation Logic
    const btn = document.getElementById('submitBtn');
    if (btn) {
        btn.onclick = () => {
            if (!document.getElementById('userName').value.trim()) {
                alert("Name required.");
            } else if (!document.getElementById('userEmail').value.trim()) {
                alert("Email required.");
            } else if (msgInput.value.length > 50) {
                alert("Message is too long.");
            } else if (!document.getElementById('termsBox').checked) {
                alert("Please accept the terms.");
            } else {
                alert("Message sent successfully!");
                document.getElementById('contactForm').reset();
                countDiv.innerText = "0 / 50 characters";
                countDiv.style.color = "#d2b48c";
                countDiv.style.opacity = "0.6";
                countDiv.style.textShadow = "none";
            }
        };
    }
});