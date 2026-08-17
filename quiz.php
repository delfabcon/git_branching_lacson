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
$agree = $_POST['agree'] ?? '';

// If registration data missing, redirect to index
if (empty(trim($complete_name)) || empty(trim($email))) {
    header('Location: index.php');
    exit;
}

$questions = get_all_questions();
$total_questions = count($questions);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IPT Quiz Web App - Quiz Module</title>
    <!-- Bulma CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Custom Neo-Brutalist Blue & Yellow Theme -->
    <link rel="stylesheet" href="style.css" />
</head>
<body>

<!-- Sticky Timer Header -->
<header class="sticky-timer">
    <div class="container">
        <div class="level is-mobile mb-2">
            <div class="level-left">
                <div class="level-item">
                    <div class="is-flex is-align-items-center gap-2">
                        <i class="fa-solid fa-bolt has-text-warning fa-lg"></i>
                        <span class="title is-5 has-text-white mb-0">IPT Quiz Module</span>
                    </div>
                </div>
            </div>
            <div class="level-right">
                <div class="level-item">
                    <span class="has-text-grey-light mr-2 font-weight-bold">Time Left:</span>
                    <span id="timerDisplay" class="timer-text">
                        <i class="fa-solid fa-clock mr-1"></i><span id="secondsLeft">60</span>s
                    </span>
                </div>
            </div>
        </div>
        <progress id="timerProgress" class="progress is-warning is-small" value="60" max="60" style="height: 10px; border: 2px solid #000; border-radius: 10px;">100%</progress>
    </div>
</header>

<!-- Main Quiz Container -->
<main class="container px-4 my-5" style="max-width: 760px;">
    <form id="quizForm" method="POST" action="result.php">
        <!-- Pass registration details forward -->
        <input type="hidden" name="complete_name" value="<?php echo htmlspecialchars($complete_name); ?>" />
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>" />
        <input type="hidden" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>" />
        <input type="hidden" name="contact_number" value="<?php echo htmlspecialchars($contact_number); ?>" />
        <input type="hidden" name="agree" value="<?php echo htmlspecialchars($agree); ?>" />

        <!-- Render All Questions -->
        <?php foreach ($questions as $index => $q): ?>
            <div class="neo-card">
                <div class="is-flex is-justify-content-space-between is-align-items-center mb-3">
                    <span class="neo-badge">
                        Question <?php echo ($index + 1); ?> of <?php echo $total_questions; ?>
                    </span>
                </div>
                <h3 class="title is-5 mb-4 has-text-dark">
                    <?php echo htmlspecialchars($q['question']); ?>
                </h3>

                <div class="field">
                    <?php foreach ($q['options'] as $option): ?>
                        <label class="option-card">
                            <input type="radio" 
                                   name="answers[<?php echo $index; ?>]" 
                                   value="<?php echo htmlspecialchars($option['key']); ?>" />
                            <span>
                                <strong style="color: var(--color-blue-primary);"><?php echo htmlspecialchars($option['key']); ?>.</strong> 
                                <?php echo htmlspecialchars($option['value']); ?>
                            </span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="field mt-5">
            <button type="submit" class="button neo-btn is-fullwidth">
                <span>Submit Quiz</span>
                <i class="fa-solid fa-paper-plane ml-2"></i>
            </button>
        </div>
    </form>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const totalTime = 60; // 60 seconds auto-submit
    let timeLeft = totalTime;
    
    const timerDisplay = document.getElementById('timerDisplay');
    const secondsLeftSpan = document.getElementById('secondsLeft');
    const timerProgress = document.getElementById('timerProgress');
    const quizForm = document.getElementById('quizForm');

    let submitted = false;

    const countdownInterval = setInterval(function () {
        timeLeft--;
        secondsLeftSpan.textContent = timeLeft;
        timerProgress.value = timeLeft;

        if (timeLeft <= 15 && timeLeft > 5) {
            timerDisplay.className = 'timer-text warning';
            timerProgress.className = 'progress is-warning is-small';
        } else if (timeLeft <= 5) {
            timerDisplay.className = 'timer-text danger';
            timerProgress.className = 'progress is-danger is-small';
        }

        if (timeLeft <= 0) {
            clearInterval(countdownInterval);
            if (!submitted) {
                submitted = true;
                quizForm.submit();
            }
        }
    }, 1000);

    quizForm.addEventListener('submit', function () {
        submitted = true;
        clearInterval(countdownInterval);
    });
});
</script>

</body>
</html>