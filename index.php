<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IPT Quiz Web App - Registration</title>
    <!-- Bulma CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Custom Neo-Brutalist Blue & Yellow Theme -->
    <link rel="stylesheet" href="style.css" />
</head>
<body>

<!-- Top Navigation Bar -->
<nav class="top-navbar">
    <div class="container is-flex is-justify-content-space-between is-align-items-center">
        <div class="brand">
            <i class="fa-solid fa-bolt has-text-warning"></i>
            <span>IPT Quiz App</span>
            <span class="brand-badge">STEP 1 OF 3</span>
        </div>
        <div class="is-hidden-mobile">
            <span class="has-text-grey-light text-size-7">Registration Module</span>
        </div>
    </div>
</nav>

<!-- Electric Blue Hero Banner -->
<header class="blue-hero">
    <div class="container">
        <h1 class="title">User Registration</h1>
        <p class="subtitle mt-2">Welcome to IPT10 PHP Quiz Web Application. Please register to begin.</p>
    </div>
</header>

<!-- Wavy Bottom Section Divider -->
<div class="wave-divider">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
    </svg>
</div>

<!-- Main Form Section -->
<main class="container px-4 my-5" style="max-width: 560px;">
    <div class="neo-card">
        <div class="has-text-centered mb-5">
            <span class="neo-badge mb-3"><i class="fa-solid fa-user-pen mr-2"></i>Examinee Details</span>
            <h2 class="title is-4 has-text-dark">Enter Registration Details</h2>
        </div>

        <form id="registrationForm" method="POST" action="instructions.php" novalidate>
            <div class="field mb-4">
                <label class="label">Complete Name <span class="has-text-danger">*</span></label>
                <div class="control has-icons-left">
                    <input class="input neo-input" type="text" id="complete_name" name="complete_name" placeholder="e.g. Juan Dela Cruz" required />
                    <span class="icon is-small is-left">
                        <i class="fa-solid fa-user"></i>
                    </span>
                </div>
                <p class="help is-danger is-hidden" id="nameHelp">Please enter your complete name.</p>
            </div>

            <div class="field mb-4">
                <label class="label">Email Address <span class="has-text-danger">*</span></label>
                <div class="control has-icons-left">
                    <input class="input neo-input" type="email" id="email" name="email" placeholder="e.g. juan.cruz@example.com" required />
                    <span class="icon is-small is-left">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                </div>
                <p class="help is-danger is-hidden" id="emailHelp">Please enter a valid email address.</p>
            </div>

            <div class="field mb-4">
                <label class="label">Birthdate</label>
                <div class="control has-icons-left">
                    <input class="input neo-input" type="date" id="birthdate" name="birthdate" />
                    <span class="icon is-small is-left">
                        <i class="fa-solid fa-calendar-days"></i>
                    </span>
                </div>
            </div>

            <div class="field mb-5">
                <label class="label">Contact Number</label>
                <div class="control has-icons-left">
                    <input class="input neo-input" type="tel" id="contact_number" name="contact_number" placeholder="e.g. 09123456789" />
                    <span class="icon is-small is-left">
                        <i class="fa-solid fa-phone"></i>
                    </span>
                </div>
            </div>

            <div class="field">
                <button type="submit" id="btnNext" class="button neo-btn is-fullwidth" disabled>
                    <span>Proceed Next</span>
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </button>
            </div>
        </form>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const completeNameInput = document.getElementById('complete_name');
    const emailInput = document.getElementById('email');
    const btnNext = document.getElementById('btnNext');
    const nameHelp = document.getElementById('nameHelp');
    const emailHelp = document.getElementById('emailHelp');

    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email.trim());
    }

    function validateForm() {
        const nameVal = completeNameInput.value.trim();
        const emailVal = emailInput.value.trim();

        const isNameValid = nameVal.length > 0;
        const isEmailValid = validateEmail(emailVal);

        if (completeNameInput.dataset.touched) {
            if (!isNameValid) {
                completeNameInput.classList.add('is-danger');
                nameHelp.classList.remove('is-hidden');
            } else {
                completeNameInput.classList.remove('is-danger');
                nameHelp.classList.add('is-hidden');
            }
        }

        if (emailInput.dataset.touched) {
            if (!isEmailValid) {
                emailInput.classList.add('is-danger');
                emailHelp.classList.remove('is-hidden');
            } else {
                emailInput.classList.remove('is-danger');
                emailHelp.classList.add('is-hidden');
            }
        }

        if (isNameValid && isEmailValid) {
            btnNext.removeAttribute('disabled');
        } else {
            btnNext.setAttribute('disabled', 'disabled');
        }
    }

    [completeNameInput, emailInput].forEach(input => {
        input.addEventListener('input', function() {
            this.dataset.touched = 'true';
            validateForm();
        });
        input.addEventListener('blur', function() {
            this.dataset.touched = 'true';
            validateForm();
        });
        input.addEventListener('keyup', validateForm);
    });

    validateForm();
});
</script>

</body>
</html>