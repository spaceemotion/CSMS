# CSMS

The master server (epository and API) for Catacomb Snatch, written in PHP.
Using Limonade as a base framework, the site is built up using the static class calling feature.

## Installation

- A PHP implementation for hosting webpages (Nginx or Apache)
- MySQL database (configure the settings in `lib/database.php`)

### Using Apache

Point Apache at the directory, .htaccess does the rest.

### Using nginx

Use the following server declaration to enable rewriting for URLs

    server {
        location / {
            try_files $uri $uri/ @rewrite;
        }
        location @rewrite {
            rewrite ^/(.*)$ /index.php?u=$1&$args;
        }
    }
