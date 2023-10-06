This is where the main pages are.

`default.php` is the main template which contains necessary headers.

Other pages extends this view and specify the `main` section to be inserted into `<body>` tag.

In addition to `$component` variable containing the model instance, a `$story` variable stores the array receive through Storyblok is also available, gives access to common story fields such as `name`, `published_at`, `created_at`.
