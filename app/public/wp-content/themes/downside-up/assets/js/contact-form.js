/**
 * Direct Inquiry (Contact Us) form.
 *
 * Progressive enhancement over the plain admin-post.php POST already set
 * as the form's `action` (see template-parts/contact/contact-form.php):
 * when JS is available, submit is intercepted and sent instead to
 * admin-ajax.php (same nonce, same fields), and the JSON response drives
 * inline loading/success/error UI with no page reload.
 *
 * Client-side validation here is a UX convenience only — the server
 * (inc/contact-form-handler.php) always re-validates everything and is
 * the source of truth; this file never assumes a client-side "valid"
 * result means the submission will succeed.
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('du-contact-form-el');
        if (!form) {
            return;
        }

        var submitBtn = document.getElementById('du-contact-submit');
        var statusSuccess = document.getElementById('du-contact-status-success');
        var statusError = document.getElementById('du-contact-status-error');
        var statusErrorText = document.getElementById('du-contact-status-error-text');
        var ajaxUrl = (window.duContactForm && window.duContactForm.ajaxUrl) || null;

        var genericErrorMessage = "We couldn't transmit your inquiry at this time. Please try again or contact us directly.";
        var validationErrorMessage = 'Please correct the highlighted fields and try again.';

        var fields = ['du_name', 'du_email', 'du_interest', 'du_message'];
        var isSubmitting = false;

        function getFieldWrap(name) {
            return form.querySelector('[data-du-field="' + name + '"]');
        }

        function getFieldInput(name) {
            return form.querySelector('[name="' + name + '"]');
        }

        function clearFieldError(name) {
            var wrap = getFieldWrap(name);
            if (!wrap) {
                return;
            }
            wrap.classList.remove('du-form-field--error');
            var input = getFieldInput(name);
            var errorEl = wrap.querySelector('.du-form-field__error');
            if (input) {
                input.removeAttribute('aria-invalid');
            }
            if (errorEl) {
                errorEl.hidden = true;
                errorEl.textContent = '';
            }
        }

        function setFieldError(name, message) {
            var wrap = getFieldWrap(name);
            if (!wrap) {
                return;
            }
            wrap.classList.add('du-form-field--error');
            var input = getFieldInput(name);
            var errorEl = wrap.querySelector('.du-form-field__error');
            if (input) {
                input.setAttribute('aria-invalid', 'true');
            }
            if (errorEl) {
                errorEl.hidden = false;
                errorEl.textContent = message;
            }
        }

        function clearAllErrors() {
            fields.forEach(clearFieldError);
        }

        function hideStatus() {
            if (statusSuccess) {
                statusSuccess.hidden = true;
            }
            if (statusError) {
                statusError.hidden = true;
            }
        }

        function showSuccess() {
            hideStatus();
            if (statusSuccess) {
                statusSuccess.hidden = false;
                statusSuccess.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
            form.hidden = true;
        }

        function showError(message) {
            hideStatus();
            if (statusError) {
                statusError.hidden = false;
                if (statusErrorText) {
                    statusErrorText.textContent = message || genericErrorMessage;
                }
                statusError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }

        function setLoading(loading) {
            isSubmitting = loading;
            if (!submitBtn) {
                return;
            }
            submitBtn.disabled = loading;
            submitBtn.setAttribute('aria-busy', loading ? 'true' : 'false');
        }

        /**
         * Minimal client-side checks — required fields, well-formed email,
         * non-empty message. Mirrors, but does not replace, the server's
         * validation in downside_up_process_contact_submission().
         */
        function validateClientSide() {
            clearAllErrors();
            var isValid = true;

            var name = getFieldInput('du_name');
            if (!name || !name.value.trim()) {
                setFieldError('du_name', 'Please enter your full name.');
                isValid = false;
            }

            var email = getFieldInput('du_email');
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email || !email.value.trim() || !emailPattern.test(email.value.trim())) {
                setFieldError('du_email', 'Please enter a valid email address.');
                isValid = false;
            }

            var interest = getFieldInput('du_interest');
            if (!interest || !interest.value) {
                setFieldError('du_interest', 'Please select an area of interest.');
                isValid = false;
            }

            var message = getFieldInput('du_message');
            if (!message || !message.value.trim()) {
                setFieldError('du_message', 'Please add a short message describing your inquiry.');
                isValid = false;
            }

            return isValid;
        }

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            // Guards against duplicate submissions from repeated clicks/
            // Enter-key presses while a request is already in flight.
            if (isSubmitting) {
                return;
            }

            hideStatus();

            if (!validateClientSide()) {
                showError(validationErrorMessage);
                return;
            }

            if (!ajaxUrl) {
                // No AJAX endpoint available for some reason — fall back to
                // the form's native admin-post.php submission rather than
                // silently doing nothing.
                form.submit();
                return;
            }

            setLoading(true);

            var formData = new FormData(form);

            fetch(ajaxUrl, {
                method: 'POST',
                credentials: 'same-origin',
                body: formData
            })
                .then(function (response) {
                    return response.json().then(function (json) {
                        return { ok: response.ok, json: json };
                    });
                })
                .then(function (result) {
                    setLoading(false);

                    if (result.json && result.json.success) {
                        showSuccess();
                        return;
                    }

                    var data = (result.json && result.json.data) || {};

                    if (data.errors) {
                        Object.keys(data.errors).forEach(function (fieldName) {
                            setFieldError(fieldName, data.errors[fieldName]);
                        });
                    }

                    showError(data.message || genericErrorMessage);
                })
                .catch(function () {
                    setLoading(false);
                    showError(genericErrorMessage);
                });
        });

        // Clear a field's error as soon as the visitor edits it.
        fields.forEach(function (name) {
            var input = getFieldInput(name);
            if (!input) {
                return;
            }
            input.addEventListener('input', function () {
                clearFieldError(name);
            });
            input.addEventListener('change', function () {
                clearFieldError(name);
            });
        });
    });
})();
