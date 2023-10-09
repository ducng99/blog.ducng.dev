<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <? $this->renderSection('meta_tags') ?>
    <title>
        <? if (!empty(uri_string())) : ?>
            <? $this->renderSection('title', true) ?> -
        <? endif; ?>
        Thomas Nguyen junk yard
    </title>
    <link rel="icon" href="<?= base_url("logo.svg") ?>" type="image/svg+xml" />
    <link rel="canonical" href="<?= base_url(uri_string()) ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Ubuntu+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flickity@2/dist/flickity.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flickity@2/dist/flickity.pkgd.min.js"></script>

    <link href="<?= base_url("assets/css/styles.css") ?>" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/htmx.org@1.9"></script>

    <?
    // Storyblok Bridge
    if (ENVIRONMENT !== 'production') :
    ?>
        <script src="//app.storyblok.com/f/storyblok-v2-latest.js" type="text/javascript"></script>
    <? endif; ?>
    <script>
        function onThemeChange() {
            if (localStorage.theme === 'dark') {
                document.documentElement.classList.add('dark');
                updateThemeIcon('dark');
            } else if (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.classList.add('dark');
                updateThemeIcon('');
            } else {
                document.documentElement.classList.remove('dark');
                updateThemeIcon('light');
            }
        }

        onThemeChange();

        document.addEventListener('DOMContentLoaded', function() {
            if (localStorage.theme === 'dark') {
                updateThemeIcon('dark');
            } else if (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                updateThemeIcon('');
            } else {
                updateThemeIcon('light');
            }
        });

        function updateThemeIcon(theme) {
            if (document.body) {
                let themeIcon = document.body.querySelector('#theme-icon');

                if (themeIcon) {
                    switch (theme) {
                        case 'light':
                            themeIcon.classList.replace('bi-moon-stars-fill', 'bi-brightness-high-fill');
                            themeIcon.classList.replace('bi-circle-half', 'bi-brightness-high-fill');
                            break;
                        case 'dark':
                            themeIcon.classList.replace('bi-brightness-high-fill', 'bi-moon-stars-fill');
                            themeIcon.classList.replace('bi-circle-half', 'bi-moon-stars-fill');
                            break;
                        default:
                            themeIcon.classList.replace('bi-brightness-high-fill', 'bi-circle-half');
                            themeIcon.classList.replace('bi-moon-stars-fill', 'bi-circle-half');
                            break;
                    }
                }
            }
        }

        function setTheme(theme) {
            if (theme) {
                localStorage.theme = theme;
            } else {
                localStorage.removeItem('theme');
            }
            onThemeChange();
        }
    </script>
</head>

<body class="bg-secondary text-primary font-mono" hx-indicator="#progress-indicator">
    <? if (ENVIRONMENT !== 'production') : ?>
        <script>
            window.addEventListener('load', () => {
                const storyblokInstance = new StoryblokBridge()
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
            });
        </script>
    <? endif; ?>

    <div id="progress-indicator"></div>

    <?= view_cell('\App\Controllers\Components\NavbarController::index') ?>
    <? $this->renderSection('main') ?>
    <?= view_cell('\App\Controllers\Components\FooterController::index') ?>
</body>

</html>
