window.onload = function () {
    const alertBox = document.getElementById('flashAlert');

    if (alertBox) {
        setTimeout(() => {
            alertBox.style.transition = "opacity 0.5s ease";
            alertBox.style.opacity = "0";

            setTimeout(() => {
                alertBox.remove();

                // ✅ OPTIONAL AUTO REDIRECT AFTER SUCCESS
                if (alertBox.classList.contains('success-alert')
                    && document.body.dataset.redirect) {
                    window.location.href = document.body.dataset.redirect;
                }

            }, 500);
        }, 3000);
    }
};
