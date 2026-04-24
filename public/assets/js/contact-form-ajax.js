/* ============================================================
   Contact form AJAX submission handler
   Replaces traditional form POST with background fetch
   Shows success/error message inline without page reload
   
   Add to /assets/js/contact-form-ajax.js
   ============================================================ */

document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector(".contact-form");
    if (!form) return;

    const submitBtn = form.querySelector("button[type='submit']");
    const originalBtnText = submitBtn?.textContent || "Send Request";
    const contactSection = document.getElementById("contact");

    // Prevent default form submission
    form.addEventListener("submit", async function (e) {
        e.preventDefault();

        // Disable submit button
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.textContent = "Sending...";
        }

        // Step 1: Get reCAPTCHA token
        if (typeof grecaptcha === "undefined") {
            showError("reCAPTCHA not loaded. Please refresh the page.");
            resetButton();
            return;
        }

        let recaptchaToken = "";

        try {
            recaptchaToken = await grecaptcha.execute('6Lcsf8csAAAAAObrutJZjr9ogA646qxEh6Fle0Th', { action: 'contact' });
        } catch (error) {
            console.error("reCAPTCHA error:", error);
            showError("reCAPTCHA verification failed. Please try again.");
            resetButton();
            return;
        }

        if (!recaptchaToken) {
            showError("Could not get reCAPTCHA token. Please try again.");
            resetButton();
            return;
        }

        // Step 2: Prepare form data
        const formData = new FormData(form);
        formData.set("recaptcha_token", recaptchaToken);

        // Step 3: Submit via fetch (AJAX)
        try {
            const response = await fetch("/contact-submit.php", {
                method: "POST",
                body: formData,
            });

            // Step 4: Check response
            if (response.ok) {
                // Success - show message and clear form
                showSuccess();
                form.reset();
                // Regenerate CSRF token by reloading it
                regenerateCSRFToken();
            } else {
                showError("Server error. Please try again.");
                console.error("Response status:", response.status);
            }
        } catch (error) {
            console.error("Fetch error:", error);
            showError("Network error. Please check your connection.");
        } finally {
            resetButton();
        }
    });

    /* ── Show success message inline ── */
    function showSuccess() {
        // Remove any existing alerts
        const existingAlert = form.querySelector(".contact-alert");
        if (existingAlert) {
            existingAlert.remove();
        }

        // Create success alert
        const alertDiv = document.createElement("div");
        alertDiv.className = "contact-alert success";
        alertDiv.innerHTML = `
            <strong>✓ Message sent!</strong>
            <p>Thank you for contacting us. We'll respond within 24 hours.</p>
        `;

        // Insert after form header or at top of form
        const formWrapper = form.closest(".contact-form-wrap");
        formWrapper.insertBefore(alertDiv, form);

        // Auto-remove after 5 seconds
        setTimeout(() => {
            alertDiv.style.transition = "opacity 0.3s";
            alertDiv.style.opacity = "0";
            setTimeout(() => alertDiv.remove(), 300);
        }, 5000);

        // Scroll to success message smoothly
        alertDiv.scrollIntoView({ behavior: "smooth", block: "center" });
    }

    /* ── Show error message inline ── */
    function showError(message) {
        // Remove any existing alerts
        const existingAlert = form.querySelector(".contact-alert");
        if (existingAlert) {
            existingAlert.remove();
        }

        // Create error alert
        const alertDiv = document.createElement("div");
        alertDiv.className = "contact-alert error";
        alertDiv.innerHTML = `
            <strong>✗ Error sending message</strong>
            <p>${message || "Please check your information and try again."}</p>
        `;

        // Insert at top of form
        const formWrapper = form.closest(".contact-form-wrap");
        formWrapper.insertBefore(alertDiv, form);

        // Scroll to error message
        alertDiv.scrollIntoView({ behavior: "smooth", block: "center" });
    }

    /* ── Reset submit button ── */
    function resetButton() {
        if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.textContent = originalBtnText;
        }
    }

    /* ── Regenerate CSRF token (fetch fresh one) ── */
    async function regenerateCSRFToken() {
        try {
            const response = await fetch("/api/csrf-token.php");
            if (response.ok) {
                const data = await response.json();
                const csrfInput = form.querySelector('input[name="csrf_token"]');
                if (csrfInput && data.token) {
                    csrfInput.value = data.token;
                }
            }
        } catch (error) {
            console.warn("Could not regenerate CSRF token:", error);
            // Not critical - form will work anyway
        }
    }
});