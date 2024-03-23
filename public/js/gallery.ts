document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("fullImageModal") as HTMLElement;
    const fullImage = document.getElementById("fullImage") as HTMLImageElement;
    const closeModal = document.getElementById("closeModal") as HTMLElement;

    document.querySelectorAll('.preview-img').forEach(img => {
        img.addEventListener('click', () => {
            const fullImageUrl = (img as HTMLImageElement).getAttribute('data-full');
            if (fullImageUrl) {
                fullImage.src = fullImageUrl;
                modal.style.display = "block";
            }
        });
    });
    
    closeModal.addEventListener('click', function() {
        modal.style.display = "none";
    });

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});