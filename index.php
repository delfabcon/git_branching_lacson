<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IPT10 Laboratory Activity #3B - File Uploads</title>
    <!-- Bulma CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Custom Neo-Brutalist Theme -->
    <link rel="stylesheet" href="style.css" />
</head>
<body>

<!-- Navigation Header -->
<nav class="top-navbar">
    <div class="container is-flex is-justify-content-space-between is-align-items-center">
        <div class="brand">
            <i class="fa-solid fa-cloud-arrow-up has-text-warning"></i>
            <span>IPT File Uploader</span>
            <span class="brand-badge">AUDIO BRANCH</span>
        </div>
        <div class="is-hidden-mobile">
            <span class="has-text-grey-light">PHP & Git Branching Activity</span>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<header class="blue-hero">
    <div class="container">
        <h1 class="title">File Upload Dashboard</h1>
        <p class="subtitle mt-2">Upload multiple media types and display them dynamically with PHP.</p>
    </div>
</header>

<!-- Wavy Divider -->
<div class="wave-divider">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
    </svg>
</div>

<!-- Main Form Section -->
<main class="container px-4 my-5" style="max-width: 680px;">
    <div class="neo-card">
        <div class="mb-5">
            <span class="neo-badge mb-2"><i class="fa-solid fa-folder-open mr-2"></i>Media Manager</span>
            <h2 class="title is-4 has-text-dark">Upload Your Files</h2>
        </div>

        <form action="uploaded.php" method="POST" enctype="multipart/form-data">
            <!-- Base Text File Input -->
            <div class="field mb-4">
                <label class="label"><i class="fa-solid fa-file-lines mr-2"></i>Text File (.txt)</label>
                <div class="control">
                    <input class="input neo-input" type="file" name="text_file" accept=".txt" />
                </div>
            </div>

            <!-- Audio File Input (audio-file-upload branch) -->
            <div class="field mb-4">
                <label class="label"><i class="fa-solid fa-file-audio mr-2"></i>Audio File (.mp3)</label>
                <div class="control">
                    <input class="input neo-input" type="file" name="audio_file" accept=".mp3" />
                </div>
            </div>

            <div class="field mt-5">
                <button type="submit" class="button neo-btn is-fullwidth">
                    <span>Upload & Display Files</span>
                    <i class="fa-solid fa-upload ml-2"></i>
                </button>
            </div>
        </form>
    </div>
</main>

</body>
</html>