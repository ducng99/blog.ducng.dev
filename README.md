# Junk yard

A collection of junks created with [HTMX](https://htmx.org/) + [Storyblok](https://www.storyblok.com/) + [CodeIgniter 4](https://www.codeigniter.com/).

## Why?

My original blog website was made with Wordpress (I know), which is heavy, a target for bots and not easily customisable.

After using Storyblok (headless CMS) at work, I thought why not just write my own blog.

The original idea was using React or Svelte for frontend code and use Storyblok JS library to fetch & process data, all processing on frontend (maybe throw some Remix.js in there).
Then HTMX poped out of no where, bringing some JS features to HTML through DOM attributes with templating in mind.

As a PHP developer, started with PHP 5.3 when all websites are PHP + HTML, this brought some nostalgic memories with LAMP stack.
So off I went using CodeIgniter (also something I learned at work) as a templating framework, HTMX to fetch and display view components, Storyblok to host my junks.

## Server Requirements

PHP version 8.0 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
