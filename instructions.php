<?php
require_once "helpers.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$complete_name = $_POST['complete_name'] ?? '';
$email = $_POST['email'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$contact_number = $_POST['contact_number'] ?? '';

// If complete name or email is empty, redirect back to index
if (empty(trim($complete_name)) || empty(trim($email))) {
    header('Location: index.php');
    exit;
}

$first_name = get_first_name($complete_name);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IPT Quiz Web App - Instructions</title>
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
            <span class="brand-badge">STEP 2 OF 3</span>
        </div>
        <div class="is-hidden-mobile">
            <span class="has-text-grey-light">Pre-Quiz Instructions</span>
        </div>
    </div>
</nav>

<!-- Electric Blue Hero Header -->
<header class="blue-hero">
    <div class="container">
        <h1 class="title">
            Hello <?php echo htmlspecialchars($first_name); ?>, please read the instructions first
        </h1>
        <p class="subtitle mt-2">
            Review the quiz rules and accept terms before starting your timed assessment.
        </p>
    </div>
</header>

<!-- Wavy Bottom Section Divider -->
<div class="wave-divider">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
    </svg>
</div>

<!-- Main Instructions Card -->
<main class="container px-4 my-5" style="max-width: 680px;">
    <div class="neo-card">
        <div class="mb-5">
            <span class="neo-badge mb-3"><i class="fa-solid fa-clipboard-list mr-2"></i>Quiz Protocol</span>
            <h2 class="title is-4 has-text-dark">Rules & Guidelines</h2>
        </div>

        <div class="content mb-5">
            <ul style="list-style-type: none; padding-left: 0;">
                <li class="mb-3 p-3" style="background: var(--color-yellow-light); border: 2.5px solid var(--color-dark); border-radius: 12px; font-weight: 600; color: var(--color-dark) !important;">
                    <i class="fa-solid fa-circle-check has-text-link mr-2"></i>
                    The quiz features <strong style="color: var(--color-dark) !important; font-weight: 800;">5 multiple-choice questions</strong> loaded all at once.
                </li>
                <li class="mb-3 p-3" style="background: var(--color-yellow-light); border: 2.5px solid var(--color-dark); border-radius: 12px; font-weight: 600; color: var(--color-dark) !important;">
                    <i class="fa-solid fa-stopwatch has-text-link mr-2"></i>
                    You have exactly <strong style="color: var(--color-dark) !important; font-weight: 800;">60 seconds</strong> to submit your answers.
                </li>
                <li class="mb-3 p-3" style="background: var(--color-yellow-light); border: 2.5px solid var(--color-dark); border-radius: 12px; font-weight: 600; color: var(--color-dark) !important;">
                    <i class="fa-solid fa-paper-plane has-text-link mr-2"></i>
                    The quiz will <strong style="color: var(--color-dark) !important; font-weight: 800;">automatically submit</strong> when the timer reaches 0.
                </li>
            </ul>
        </div>

        <div class="field mb-4">
            <label class="label"><i class="fa-solid fa-file-contract mr-2"></i>Terms and Conditions</label>
            <div class="p-4" style="background: var(--color-gray-bg); border: 2.5px solid var(--color-dark); border-radius: 12px; max-height: 160px; overflow-y: auto; font-size: 0.9rem; font-weight: 600; color: var(--color-dark) !important;">
                <p class="mb-2" style="color: var(--color-dark) !important;">
                    <strong style="color: var(--color-dark) !important; font-weight: 800;">1. Honesty Policy:</strong> By proceeding, you commit to completing this test independently without relying on third-party help or automated tools.
                </p>
                <p class="mb-2" style="color: var(--color-dark) !important;">
                    <strong style="color: var(--color-dark) !important; font-weight: 800;">2. Single Timed Session:</strong> Once initiated, the 60-second countdown runs continuously and cannot be paused or restarted.
                </p>
                <p style="color: var(--color-dark) !important;">
                    <strong style="color: var(--color-dark) !important; font-weight: 800;">3. Hidden Form Data:</strong> Your name, email, birthdate, and contact number are passed solely via hidden form inputs for session tracking.
                </p>
            </div>
        </div>

        <form id="instructionsForm" method="POST" action="quiz.php">
            <!-- Hidden inputs to pass registration data forward without sessions -->
            <input type="hidden" name="complete_name" value="<?php echo htmlspecialchars($complete_name); ?>" />
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>" />
            <input type="hidden" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>" />
            <input type="hidden" name="contact_number" value="<?php echo htmlspecialchars($contact_number); ?>" />

            <div class="field mb-5">
                <div class="control">
                    <label class="checkbox font-weight-bold" style="font-weight: 700;">
                        <input type="checkbox" id="termsCheckbox" name="agree" value="1" style="transform: scale(1.2); margin-right: 8px;">
                        I agree to the <a href="#" onclick="event.preventDefault();" class="has-text-link">terms and conditions</a>
                    </label>
                </div>
            </div>

            <div class="field">
                <button type="submit" id="btnStartQuiz" class="button neo-btn is-fullwidth" disabled>
                    <span>Start Quiz</span>
                    <i class="fa-solid fa-play ml-2"></i>
                </button>
            </div>
        </form>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const termsCheckbox = document.getElementById('termsCheckbox');
    const btnStartQuiz = document.getElementById('btnStartQuiz');

    function toggleSubmitButton() {
        if (termsCheckbox.checked) {
            btnStartQuiz.removeAttribute('disabled');
        } else {
            btnStartQuiz.setAttribute('disabled', 'disabled');
        }
    }

    termsCheckbox.addEventListener('change', toggleSubmitButton);
    toggleSubmitButton();
});
</script>

</body>
</html>