# IPT Quiz Web Application (Blue & Yellow Neo-Brutalist Theme)

A PHP-based Quiz Web Application built with a registration flow that uses **hidden input form fields** exclusively for session state management (no `$_SESSION` global variables).

## Features

- **Step 1: Registration Form (`index.php`)**: Collects user details (Complete Name, Email, Birthdate, Contact Number) with real-time JavaScript validation for required fields.
- **Step 2: Pre-Quiz Instructions (`instructions.php`)**: Greets the user personally using their first name, displays rules and terms, and validates terms agreement before starting the quiz.
- **Step 3: All-at-Once Quiz Module (`quiz.php`)**: Renders all 5 quiz questions simultaneously on a single page, complete with styled radio button option cards, a sticky timer header, and a **60-second JavaScript auto-submit countdown**.
- **Step 4: Results & Detailed Breakdown (`result.php`)**:
  - Dynamically calculates score out of 5.
  - Applies score-dependent hero section styling (`is-success` for score > 2, `is-danger` for score <= 2).
  - Triggers Confetti.js celebration **only** on achieving a perfect score (5/5).
  - Formats birthdate into `"Month dd, YYYY"` format.
  - Displays user profile and a detailed question-by-question breakdown table with status badges (`Correct` / `Incorrect`).

## Tech Stack & Design

- **PHP 8.x**: Server-side processing and state passing via `$_POST` hidden inputs.
- **Bulma CSS v1.0.2 & Font Awesome 6.x**: UI framework and vector icons.
- **Custom Neo-Brutalist Styling (`style.css`)**: High-contrast Blue & Yellow pop-art aesthetic with thick borders, hard offset shadows, rounded pill buttons, and SVG wavy dividers.
- **Vanilla JavaScript**: Form validation, countdown timer, auto-submit, and terms toggle.

## Running Locally

1. Ensure PHP 8.x is installed on your system.
2. Start the built-in development server in the project directory:
   ```bash
   php -S localhost:8000
   ```
3. Open your browser and navigate to `http://localhost:8000`.
