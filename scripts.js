document.addEventListener('DOMContentLoaded', () => {
    // Call functions after DOM is fully loaded
    setup3DModels();
    setupSmoothScrolling();
});

// Setup 3D Models using model-viewer (or Three.js)
function setup3DModels() {
    const modelViewerElements = document.querySelectorAll('model-viewer');
    
    // You can add any interactive features here, such as changing the model's environment
    modelViewerElements.forEach((modelViewer) => {
        modelViewer.addEventListener('load', () => {
            console.log("3D Model loaded!");
        });

        // Example: Changing environment on click
        modelViewer.addEventListener('click', () => {
            modelViewer.setAttribute('src', 'path-to-new-model.glb');
        });
    });
}

// Smooth scrolling to section when clicking on navigation links
function setupSmoothScrolling() {
    const smoothScrollLinks = document.querySelectorAll('a[href^="#"]');

    smoothScrollLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            
            const targetId = link.getAttribute('href').slice(1);
            const targetElement = document.getElementById(targetId);
            
            targetElement.scrollIntoView({
                behavior: 'smooth',
                block: 'start',
            });
        });
    });
}
function handleScrollAnimation() {
    const scrollElements = document.querySelectorAll('.fade-in');

    scrollElements.forEach(element => {
        const elementPosition = element.getBoundingClientRect().top;
        const screenPosition = window.innerHeight / 1.3;

        if (elementPosition < screenPosition) {
            element.classList.add('visible');
        }
    });
}

window.addEventListener('scroll', handleScrollAnimation);

// Add 'fade-in' class to elements in HTML to use this effect
