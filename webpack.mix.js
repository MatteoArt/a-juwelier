const mix = require('laravel-mix');
require('laravel-mix-mjml');

mix.mjml('resources/emails', 'resources/views/emails');