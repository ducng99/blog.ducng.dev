<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thomas Nguyen junk yard</title>
    <script src="https://unpkg.com/htmx.org@1.9.5" integrity="sha384-xcuj3WpfgjlKF+FXhSQFQ0ZNr39ln+hwjN3npfM9VBnUskLolQAcN80McRIVOPuO" crossorigin="anonymous"></script>

    <? if (ENVIRONMENT === 'development') : ?>
        <script src="https://cdn.tailwindcss.com"></script>
    <? else : ?>
        <link href="<?= base_url("assets/css/styles.css") ?>" rel="stylesheet" type="text/css" />
    <? endif; ?>

    <?= $this->renderSection('meta_tags') ?>
</head>

<body>
    <?= $this->renderSection('main') ?>
</body>

</html>
