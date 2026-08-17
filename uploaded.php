<?php
$upload_directory = __DIR__ . '/uploads/';
if (!is_dir($upload_directory)) {
    mkdir($upload_directory, 0777, true);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IPT File Uploader - Display</title>
    <!-- Bulma CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Custom Neo-Brutalist Theme -->
    <link rel="stylesheet" href="style.css" />
</head>
<body>

<nav class="top-navbar">
    <div class="container is-flex is-justify-content-space-between is-align-items-center">
        <div class="brand">
            <i class="fa-solid fa-cloud-arrow-up has-text-warning"></i>
            <span>IPT File Uploader</span>
            <span class="brand-badge">MEDIA GALLERY</span>
        </div>
        <div>
            <a href="index.php" style="color: var(--color-yellow-main); font-weight: 700;">
                <i class="fa-solid fa-arrow-left mr-1"></i>Back to Upload Form
            </a>
        </div>
    </div>
</nav>

<header class="blue-hero">
    <div class="container">
        <h1 class="title">Uploaded Files Viewer</h1>
        <p class="subtitle mt-2">Displaying your uploaded media files.</p>
    </div>
</header>

<div class="wave-divider">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
    </svg>
</div>

<main class="container px-4 my-5" style="max-width: 860px;">

    <!-- 1. Text File Display -->
    <?php
    if (isset($_FILES['text_file']) && $_FILES['text_file']['error'] === UPLOAD_ERR_OK) {
        $uploaded_text_file = $upload_directory . basename($_FILES['text_file']['name']);
        if (move_uploaded_file($_FILES['text_file']['tmp_name'], $uploaded_text_file)) {
            $text_content = file_get_contents($uploaded_text_file);
            ?>
            <div class="neo-card mb-5">
                <div class="mb-3">
                    <span class="neo-badge"><i class="fa-solid fa-file-lines mr-1"></i>Text Document</span>
                    <h3 class="title is-5 mt-2"><?php echo htmlspecialchars(basename($_FILES['text_file']['name'])); ?></h3>
                </div>
                <textarea class="textarea neo-input" rows="8" readonly style="font-family: monospace; height: auto !important; color: #0f172a !important;"><?php echo htmlspecialchars($text_content); ?></textarea>
            </div>
            <?php
        }
    }
    ?>

    <!-- 2. PDF File Display (pdf-file-upload branch) -->
    <?php
    if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
        $uploaded_pdf_file = $upload_directory . basename($_FILES['pdf_file']['name']);
        if (move_uploaded_file($_FILES['pdf_file']['tmp_name'], $uploaded_pdf_file)) {
            $pdf_url = 'uploads/' . rawurlencode(basename($_FILES['pdf_file']['name']));
            ?>
            <div class="neo-card mb-5">
                <div class="mb-3">
                    <span class="neo-badge"><i class="fa-solid fa-file-pdf mr-1"></i>PDF Document</span>
                    <h3 class="title is-5 mt-2"><?php echo htmlspecialchars(basename($_FILES['pdf_file']['name'])); ?></h3>
                </div>
                <div class="pdf-container" style="border: 2.5px solid var(--color-dark); border-radius: 12px; overflow: hidden; box-shadow: 3px 3px 0px var(--color-dark);">
                    <iframe src="<?php echo $pdf_url; ?>" width="100%" height="550px" style="border: none;"></iframe>
                </div>
            </div>
            <?php
        }
    }
    ?>

    <!-- 3. Audio File Display (audio-file-upload branch) -->
    <?php
    if (isset($_FILES['audio_file']) && $_FILES['audio_file']['error'] === UPLOAD_ERR_OK) {
        $uploaded_audio_file = $upload_directory . basename($_FILES['audio_file']['name']);
        if (move_uploaded_file($_FILES['audio_file']['tmp_name'], $uploaded_audio_file)) {
            $audio_url = 'uploads/' . rawurlencode(basename($_FILES['audio_file']['name']));
            ?>
            <div class="neo-card mb-5">
                <div class="mb-3">
                    <span class="neo-badge"><i class="fa-solid fa-file-audio mr-1"></i>Audio Track</span>
                    <h3 class="title is-5 mt-2"><?php echo htmlspecialchars(basename($_FILES['audio_file']['name'])); ?></h3>
                </div>
                <div class="audio-container p-4" style="border: 2.5px solid var(--color-dark); border-radius: 12px; background: var(--color-yellow-light); box-shadow: 3px 3px 0px var(--color-dark);">
                    <audio controls style="width: 100%;">
                        <source src="<?php echo $audio_url; ?>" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>
            </div>
            <?php
        }
    }
    ?>

    <!-- 4. Image File Display (image-file-upload branch) -->
    <?php
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
        $uploaded_image_file = $upload_directory . basename($_FILES['image_file']['name']);
        if (move_uploaded_file($_FILES['image_file']['tmp_name'], $uploaded_image_file)) {
            $image_url = 'uploads/' . rawurlencode(basename($_FILES['image_file']['name']));
            ?>
            <div class="neo-card mb-5">
                <div class="mb-3">
                    <span class="neo-badge"><i class="fa-solid fa-file-image mr-1"></i>Uploaded Image</span>
                    <h3 class="title is-5 mt-2"><?php echo htmlspecialchars(basename($_FILES['image_file']['name'])); ?></h3>
                </div>
                <div class="has-text-centered p-4" style="border: 2.5px solid var(--color-dark); border-radius: 12px; background: var(--color-white); box-shadow: 3px 3px 0px var(--color-dark);">
                    <img src="<?php echo $image_url; ?>" alt="Uploaded Image" style="max-height: 500px; width: auto; border-radius: 8px; object-fit: contain;" />
                </div>
            </div>
            <?php
        }
    }
    ?>

    <!-- 5. Video File Display (video-file-upload branch) -->
    <?php
    if (isset($_FILES['video_file']) && $_FILES['video_file']['error'] === UPLOAD_ERR_OK) {
        $uploaded_video_file = $upload_directory . basename($_FILES['video_file']['name']);
        if (move_uploaded_file($_FILES['video_file']['tmp_name'], $uploaded_video_file)) {
            $video_url = 'uploads/' . rawurlencode(basename($_FILES['video_file']['name']));
            ?>
            <div class="neo-card mb-5">
                <div class="mb-3">
                    <span class="neo-badge"><i class="fa-solid fa-file-video mr-1"></i>Video Player</span>
                    <h3 class="title is-5 mt-2"><?php echo htmlspecialchars(basename($_FILES['video_file']['name'])); ?></h3>
                </div>
                <div class="video-container p-3" style="border: 2.5px solid var(--color-dark); border-radius: 12px; background: var(--color-dark); box-shadow: 3px 3px 0px var(--color-dark);">
                    <video controls style="width: 100%; border-radius: 8px; max-height: 500px;">
                        <source src="<?php echo $video_url; ?>" type="video/mp4">
                        Your browser does not support the video element.
                    </video>
                </div>
            </div>
            <?php
        }
    }
    ?>

    <div class="has-text-centered mt-5">
        <a href="index.php" class="button neo-btn" style="max-width: 320px; display: inline-flex !important;">
            <i class="fa-solid fa-arrow-left mr-2"></i>Upload Another File
        </a>
    </div>

</main>

</body>
</html>
