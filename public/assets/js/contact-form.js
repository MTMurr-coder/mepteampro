/* ============================================================
   Contact form validation and UX improvements
   Add to /assets/js/contact-form.js (new file)
   ============================================================ */

document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector(".contact-form");
    if (!form) return;

    const nameInput = form.querySelector('input[name="name"]');
    const emailInput = form.querySelector('input[name="email"]');
    const messageInput = form.querySelector('textarea[name="message"]');
    const submitBtn = form.querySelector('button[type="submit"]');

    // Track validation state
    const isValid = {
        name: false,
        email: false,
        message: false
    };

    // Validation rules
    const validators = {
        name: (value) => {
            const trimmed = value.trim();
            if (trimmed.length < 2) return "Name must be at least 2 characters";
            if (trimmed.length > 100) return "Name must be less than 100 characters";
            return null;
        },
        email: (value) => {
            const trimmed = value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(trimmed)) return "Please enter a valid email address";
            return null;
        },
        message: (value) => {
            const trimmed = value.trim();
            if (trimmed.length < 10) return "Message must be at least 10 characters";
            if (trimmed.length > 5000) return "Message must be less than 5000 characters";
            return null;
        }
    };

    // Set validation state and show/hide error
    const setValidation = (field, inputElement, isFieldValid, errorMessage) => {
        isValid[field] = isFieldValid;
        const formGroup = inputElement.closest(".form-group");
        const errorEl = formGroup.querySelector(".form-error") || createErrorElement(formGroup);

        if (isFieldValid) {
            formGroup.classList.remove("error");
            formGroup.classList.add("valid");
            errorEl.textContent = "";
        } else {
            formGroup.classList.remove("valid");
            formGroup.classList.add("error");
            errorEl.textContent = errorMessage || "This field is invalid";
        }

        updateSubmitButton();
    };

    // Create error message element if it doesn't exist
    const createErrorElement = (formGroup) => {
        const errorEl = document.createElement("div");
        errorEl.className = "form-error";
        formGroup.appendChild(errorEl);
        return errorEl;
    };

    // Update submit button state
    const updateSubmitButton = () => {
        const allValid = isValid.name && isValid.email && isValid.message;
        submitBtn.disabled = !allValid;
    };

    // Real-time validation on input
    nameInput?.addEventListener("input", (e) => {
        const error = validators.name(e.target.value);
        setValidation("name", nameInput, !error, error);
    });

    emailInput?.addEventListener("input", (e) => {
        const error = validators.email(e.target.value);
        setValidation("email", emailInput, !error, error);
    });

    messageInput?.addEventListener("input", (e) => {
        const error = validators.message(e.target.value);
        setValidation("message", messageInput, !error, error);
    });

    // Blur validation (more aggressive feedback on unfocus)
    [nameInput, emailInput, messageInput].forEach((input) => {
        input?.addEventListener("blur", (e) => {
            const fieldName = e.target.name;
            if (fieldName === "name") {
                const error = validators.name(e.target.value);
                setValidation("name", nameInput, !error, error);
            } else if (fieldName === "email") {
                const error = validators.email(e.target.value);
                setValidation("email", emailInput, !error, error);
            } else if (fieldName === "message") {
                const error = validators.message(e.target.value);
                setValidation("message", messageInput, !error, error);
            }
        });
    });

    // Form submission with loading state
    form.addEventListener("submit", (e) => {
        // Browser will prevent submission if any input is invalid
        if (nameInput.validity.valid && emailInput.validity.valid && messageInput.validity.valid) {
            submitBtn.disabled = true;
            submitBtn.textContent = "Sending...";
            // Form submits normally; PHP handles it
        } else {
            e.preventDefault();
            // Trigger validation on all fields
            [nameInput, emailInput, messageInput].forEach((input) => {
                input.dispatchEvent(new Event("blur"));
            });
        }
    });

    // Initialize — check if fields already have values (e.g., after validation error redirect)
    if (nameInput?.value) {
        const error = validators.name(nameInput.value);
        setValidation("name", nameInput, !error, error);
    }
    if (emailInput?.value) {
        const error = validators.email(emailInput.value);
        setValidation("email", emailInput, !error, error);
    }
    if (messageInput?.value) {
        const error = validators.message(messageInput.value);
        setValidation("message", messageInput, !error, error);
    }
});