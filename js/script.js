document.addEventListener('DOMContentLoaded', () => {
    // Mobile Menu Toggle
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.nav-links');

    if (hamburger) {
        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            const expanded = navLinks.classList.contains('active');
            hamburger.setAttribute('aria-expanded', expanded);
            hamburger.classList.toggle('active');
            hamburger.innerHTML = expanded ? '<i class="fas fa-times" aria-hidden="true"></i>' : '<i class="fas fa-bars" aria-hidden="true"></i>';
        });
    }

    // Hero Slider Functionality
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    const prevBtn = document.querySelector('.slider-prev');
    const nextBtn = document.querySelector('.slider-next');
    let currentSlide = 0;
    let slideInterval;

    function showSlide(index) {
        // Hide all slides
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => {
            dot.classList.remove('active');
            dot.setAttribute('aria-selected', 'false');
        });

        // Show current slide
        slides[index].classList.add('active');
        dots[index].classList.add('active');
        dots[index].setAttribute('aria-selected', 'true');

        currentSlide = index;
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    function startAutoSlide() {
        slideInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds
    }

    function stopAutoSlide() {
        clearInterval(slideInterval);
    }

    // Event listeners
    if (nextBtn) nextBtn.addEventListener('click', nextSlide);
    if (prevBtn) prevBtn.addEventListener('click', prevSlide);

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => showSlide(index));
    });

    // Pause auto-slide on hover
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        heroSection.addEventListener('mouseenter', stopAutoSlide);
        heroSection.addEventListener('mouseleave', startAutoSlide);
    }

    // Start auto-slide
    startAutoSlide();

    // Keyboard Navigation for Dropdown Menus
    const dropdownTriggers = document.querySelectorAll('.nav-item.has-dropdown > a');

    dropdownTriggers.forEach(trigger => {
        const dropdown = trigger.nextElementSibling;
        let isOpen = false;

        // Handle keyboard events
        trigger.addEventListener('keydown', (e) => {
            switch(e.key) {
                case 'Enter':
                case ' ':
                case 'ArrowDown':
                    e.preventDefault();
                    toggleDropdown();
                    if (dropdown) {
                        const firstItem = dropdown.querySelector('a');
                        if (firstItem) firstItem.focus();
                    }
                    break;
                case 'Escape':
                    e.preventDefault();
                    closeDropdown();
                    break;
            }
        });

        // Handle mouse events for desktop
        trigger.addEventListener('mouseenter', () => {
            if (window.innerWidth > 991) {
                openDropdown();
            }
        });

        trigger.parentElement.addEventListener('mouseleave', () => {
            if (window.innerWidth > 991) {
                closeDropdown();
            }
        });

        // Touch events for mobile
        trigger.addEventListener('touchstart', (e) => {
            if (window.innerWidth <= 991) {
                e.preventDefault();
                toggleDropdown();
            }
        });

        function toggleDropdown() {
            if (isOpen) {
                closeDropdown();
            } else {
                closeAllDropdowns();
                openDropdown();
            }
        }

        function openDropdown() {
            if (dropdown) {
                dropdown.style.opacity = '1';
                dropdown.style.visibility = 'visible';
                dropdown.style.transform = 'translateY(0)';
            }
            trigger.setAttribute('aria-expanded', 'true');
            isOpen = true;
        }

        function closeDropdown() {
            if (dropdown) {
                dropdown.style.opacity = '0';
                dropdown.style.visibility = 'hidden';
                dropdown.style.transform = 'translateY(10px)';
            }
            trigger.setAttribute('aria-expanded', 'false');
            isOpen = false;
        }

        function closeAllDropdowns() {
            dropdownTriggers.forEach(otherTrigger => {
                const otherDropdown = otherTrigger.nextElementSibling;
                if (otherDropdown && otherTrigger !== trigger) {
                    otherDropdown.style.opacity = '0';
                    otherDropdown.style.visibility = 'hidden';
                    otherDropdown.style.transform = 'translateY(10px)';
                    otherTrigger.setAttribute('aria-expanded', 'false');
                }
            });
        }
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.nav-item')) {
            dropdownTriggers.forEach(trigger => {
                const dropdown = trigger.nextElementSibling;
                if (dropdown) {
                    dropdown.style.opacity = '0';
                    dropdown.style.visibility = 'hidden';
                    dropdown.style.transform = 'translateY(10px)';
                    trigger.setAttribute('aria-expanded', 'false');
                }
            });
        }
    });

    // Smooth Scrolling for Anchor Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                // Close mobile menu if open
                if (navLinks.classList.contains('active')) {
                    navLinks.classList.remove('active');
                    hamburger.innerHTML = '<i class="fas fa-bars"></i>';
                }
            }
        });
    });

    // Intersection Observer for Scroll Animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.course-card, .benefit-item, .blog-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
        observer.observe(el);
    });

    // Dynamic Header Background
    const header = document.querySelector('header');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.style.background = 'rgba(15, 23, 42, 0.98)';
            header.style.boxShadow = '0 4px 6px -1px rgba(0, 0, 0, 0.1)';
        } else {
            header.style.background = 'rgba(15, 23, 42, 0.95)';
            header.style.boxShadow = 'none';
        }
    });
});
