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
                // THIS IS THE ONLY LINE WE ARE ADDING:
                document.getElementById('contactForm').submit();

                document.getElementById('contactForm').reset();
                countDiv.innerText = "0 / 50 characters";
                // ... rest of your styling code
            }
            countDiv.style.color = "#d2b48c";
            countDiv.style.opacity = "0.6";
            countDiv.style.textShadow = "none";
        }
    };

    // 4. Custom Picture Showcase Logic
    const nextBtn = document.getElementById('nextPictureBtn');
    const showcaseImg = document.getElementById('showcaseImage');
    const showcaseCaption = document.getElementById('showcaseCaption');

    if (nextBtn && showcaseImg && showcaseCaption) {
        const images = [
            { src: 'assets/project(1).png', caption: 'Showcase 1' },
            { src: 'assets/project(2).png', caption: 'Showcase 2' }
        ];
        let currentIdx = 0;

        nextBtn.addEventListener('click', () => {
            currentIdx = (currentIdx + 1) % images.length;
            
            // Fade out
            showcaseImg.style.opacity = 0;
            showcaseCaption.style.opacity = 0;
            
            setTimeout(() => {
                showcaseImg.src = images[currentIdx].src;
                showcaseCaption.innerText = images[currentIdx].caption;
                
                // Fade in
                showcaseImg.style.opacity = 1;
                showcaseCaption.style.opacity = 1;
            }, 400);
        });
    }

    // 5. Video Play/Pause Overlay Logic
    const video = document.getElementById('showcaseVideo');
    const videoOverlay = document.getElementById('videoClickArea');

    if (video && videoOverlay) {
        const togglePlay = () => {
            if (video.paused) {
                video.play();
            } else {
                video.pause();
            }
        };

        videoOverlay.addEventListener('click', togglePlay);

        // Update UI based on video state
        video.addEventListener('play', () => {
            videoOverlay.classList.add('playing');
        });

        video.addEventListener('pause', () => {
            videoOverlay.classList.remove('playing');
        });
    }
});