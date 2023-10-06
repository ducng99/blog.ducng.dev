<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->renderSection('meta_tags') ?>
    <title>
        <? if (!empty(uri_string())) : ?>
            <?= $this->renderSection('title', true) ?> -
        <? endif; ?>
        Thomas Nguyen junk yard
    </title>
    <link rel="icon" href="<?= base_url("logo.svg") ?>" type="image/svg+xml" />
    <link rel="canonical" href="<?= base_url(uri_string()) ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Ubuntu+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <link href="<?= base_url("assets/css/styles.css") ?>" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/htmx.org@1.9"></script>

    <?
    // Storyblok Bridge
    if (ENVIRONMENT !== 'production') :
    ?>
        <script src="//app.storyblok.com/f/storyblok-v2-latest.js" type="text/javascript"></script>
    <? endif; ?>
</head>

<body class="bg-secondary text-primary font-mono">
    <? if (ENVIRONMENT !== 'production') : ?>
        <script>
            const storyblokInstance = new window.StoryblokBridge()
            storyblokInstance.on(['published', 'change'], () => {
                // reload page if save or publish is clicked
                window.location.reload(true)
            });

            storyblokInstance.on('input', (event) => {
                // Access currently changed but not yet saved content via:
                const storyJson = JSON.stringify(event.story);

                // Get updated HTML
                fetch("<?= base_url('storyblok_load_story') ?>", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: storyJson,
                    })
                    .then(response => response.text())
                    .then((data) => {
                        // Update the page
                        document.body.parentElement.innerHTML = data;
                        htmx.process(document.body);
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
            });
        </script>
    <? endif; ?>

    <?= view_cell('\App\Controllers\Components\NavbarController::index') ?>

    <?= $this->renderSection('main') ?>
</body>

</html>
