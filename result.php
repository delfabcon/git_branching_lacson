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

// Retrieve submitted answers array
$user_answers = $_POST['answers'] ?? [];

// Calculate score (0 to 5)
$score = compute_score($user_answers);
$total_questions = count(get_answers());
$is_perfect_score = ($score === $total_questions);

// Hero class: beyond 2 points (3, 4, 5) -> is-success; otherwise (0, 1, 2) -> is-danger
$hero_class = ($score > 2) ? 'is-success' : 'is-danger';
$neo_hero_class = ($score > 2) ? 'hero-results-success' : 'hero-results-danger';

// Format birthdate
$formatted_birthdate = format_birthdate($birthdate);

// Get questions data
$questions = get_all_questions();
$correct_answers = get_answers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IPT Quiz Web App - Results</title>
    <!-- Bulma CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Custom Neo-Brutalist Blue & Yellow Theme -->
    <link rel="stylesheet" href="style.css" />

    <?php if ($is_perfect_score): ?>
        <script src="https://cdn.jsdelivr.net/npm/confetti-js@0.0.18/dist/index.min.js"></script>
    <?php endif; ?>
</head>
<body>

<?php if ($is_perfect_score): ?>
    <canvas id="confetti-canvas"></canvas>
<?php endif; ?>

<!-- Top Navigation Bar -->
<nav class="top-navbar">
    <div class="container is-flex is-justify-content-space-between is-align-items-center">
        <div class="brand">
            <i class="fa-solid fa-bolt has-text-warning"></i>
            <span>IPT Quiz App</span>
            <span class="brand-badge">STEP 3 OF 3</span>
        </div>
        <div class="is-hidden-mobile">
            <span class="has-text-grey-light">Assessment Results</span>
        </div>
    </div>
</nav>

<!-- Dynamic Hero Banner (Blue Success vs Red Danger) -->
<section class="hero <?php echo $hero_class; ?> <?php echo $neo_hero_class; ?> py-6">
    <div class="hero-body text-center">
        <div class="container text-center">
            <span class="neo-badge mb-3" style="background: var(--color-yellow-main); color: #000;">
                <i class="fa-solid fa-trophy mr-1"></i>FINAL SCORE
            </span>
            <h1 class="title is-1 has-text-white mb-2" style="font-size: 3.25rem; text-shadow: 3px 3px 0px #000;">
                Your Score: <?php echo $score; ?> / <?php echo $total_questions; ?>
            </h1>
            <p class="subtitle is-4 has-text-white-ter" style="font-weight: 700;">
                <?php if ($score > 2): ?>
                    <i class="fa-solid fa-face-smile mr-2"></i>Awesome Job! You passed the IPT Quiz.
                <?php else: ?>
                    <i class="fa-solid fa-face-frown mr-2"></i>Needs Improvement. Try again next time!
                <?php endif; ?>
            </p>
        </div>
    </div>
</section>

<!-- Wavy Bottom Section Divider -->
<div class="wave-divider">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
    </svg>
</div>

<main class="container px-4 my-5" style="max-width: 860px;">

    <!-- Examinee Registration Information Table -->
    <div class="neo-card">
        <div class="mb-4">
            <span class="neo-badge mb-2"><i class="fa-solid fa-id-card mr-2"></i>Examinee Information</span>
            <h2 class="title is-4 has-text-dark">User Profile</h2>
        </div>
        <div class="table-container">
            <table class="table neo-table is-fullwidth">
                <thead>
                    <tr>
                        <th style="width: 35%;">Field</th>
                        <th>Registered Information</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Complete Name</td>
                        <td><?php echo htmlspecialchars($complete_name); ?></td>
                    </tr>
                    <tr>
                        <td>Email Address</td>
                        <td><?php echo htmlspecialchars($email); ?></td>
                    </tr>
                    <tr>
                        <td>Birthdate</td>
                        <td><?php echo htmlspecialchars($formatted_birthdate); ?></td>
                    </tr>
                    <tr>
                        <td>Contact Number</td>
                        <td><?php echo htmlspecialchars($contact_number ?: 'N/A'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Detailed Question & Answer Breakdown Table -->
    <div class="neo-card">
        <div class="mb-4">
            <span class="neo-badge mb-2"><i class="fa-solid fa-square-poll-vertical mr-2"></i>Performance Breakdown</span>
            <h2 class="title is-4 has-text-dark">Detailed Question & Answer Review</h2>
        </div>
        <div class="table-container">
            <table class="table neo-table is-fullwidth">
                <thead>
                    <tr>
                        <th style="width: 6%;">#</th>
                        <th style="width: 36%;">Question</th>
                        <th style="width: 24%;">Your Answer</th>
                        <th style="width: 24%;">Correct Answer</th>
                        <th style="width: 10%;">Result</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($questions as $idx => $q): 
                        $correct_key = $correct_answers[$idx] ?? '';
                        $user_key = $user_answers[$idx] ?? null;

                        $correct_text = '';
                        $user_text = 'No Answer';

                        foreach ($q['options'] as $opt) {
                            if ($opt['key'] === $correct_key) {
                                $correct_text = "({$opt['key']}) {$opt['value']}";
                            }
                            if (!is_null($user_key) && $opt['key'] === $user_key) {
                                $user_text = "({$opt['key']}) {$opt['value']}";
                            }
                        }

                        $is_correct = (!is_null($user_key) && $user_key === $correct_key);
                    ?>
                        <tr>
                            <td><?php echo ($idx + 1); ?></td>
                            <td><?php echo htmlspecialchars($q['question']); ?></td>
                            <td>
                                <?php if ($is_correct): ?>
                                    <span style="color: #15803d !important; font-weight: 700;"><?php echo htmlspecialchars($user_text); ?></span>
                                <?php elseif (!is_null($user_key)): ?>
                                    <span style="color: #b91c1c !important; font-weight: 700;"><?php echo htmlspecialchars($user_text); ?></span>
                                <?php else: ?>
                                    <span style="color: #64748b !important; font-weight: 600;"><em><?php echo htmlspecialchars($user_text); ?></em></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span style="color: #15803d !important; font-weight: 700;">
                                    <?php echo htmlspecialchars($correct_text); ?>
                                </span>
                            </td>
                            <td class="has-text-centered">
                                <?php if ($is_correct): ?>
                                    <span class="status-pill correct">
                                        <i class="fa-solid fa-check mr-1"></i> Correct
                                    </span>
                                <?php else: ?>
                                    <span class="status-pill incorrect">
                                        <i class="fa-solid fa-xmark mr-1"></i> Incorrect
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="mt-5 text-center has-text-centered">
            <a href="index.php" class="button neo-btn">
                <i class="fa-solid fa-rotate-right mr-2"></i>
                <span>Retake Quiz / Register New User</span>
            </a>
        </div>
    </div>

</main>

<?php if ($is_perfect_score): ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var confettiSettings = {
        target: 'confetti-canvas',
        max: 90,
        size: 1.5,
        animate: true,
        props: ['circle', 'square', 'triangle', 'line'],
        colors: [[250,204,21],[37,99,235],[96,165,250],[254,240,138]]
    };
    var confetti = new ConfettiGenerator(confettiSettings);
    confetti.render();
});
</script>
<?php endif; ?>

</body>
</html>