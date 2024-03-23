document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("fullImageModal") as HTMLElement;
    const fullImage = document.getElementById("fullImage") as HTMLImageElement;
    const closeModal = document.getElementById("closeModal") as HTMLElement;

    document.querySelectorAll('.preview-img').forEach(img => {
        img.addEventListener('click', function(event) {
            // Using event.target to get the clicked element
            const target = event.target as HTMLImageElement;
            const fullImageUrl = target.getAttribute('data-full');
            if (fullImageUrl) {
                fullImage.src = fullImageUrl;
                modal.style.display = "flex";
            }
        });
    });

    closeModal.addEventListener('click', function() {
        modal.style.display = "none";
    });

    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});