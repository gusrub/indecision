# Indecision Maker

Just a simple CodeIgniter application that lets you manage places to go and make a random choice based on that list.

## Features:

 - User login / authentication / password reset
 - Ability to modify one self profile
 - Ability to add, modify and remove places
 - Autocomplete of known places using google maps API
 - Automatic lookup of known addresses
 - Place map display given that it has a google map location
 - The usual suspects (validation, error handling)
 - Enough cowbell

## Room for improvement

Lots. CRUD's for the users and for all places so admins can manage them. Also CRUD's for catalogs like countries and states.

# Initial setup

## Database

There is a file in `db/model.mwb` that has all the models of the database that you can _"forward-engineer"_ to create the database. Alternatively there is a `db/create_db.sql` script which will do the same. You can use either MySql or MariaDB, either would work. We are using certain functions which are not available on PostgreSQL by the way so beware.

The included model/script will create an `indecision_user` mysql user/schema. Its password its `Str0ngP4ss@ci!`. The user has inser/update/delete permissions only, this is on purpuse to avoid using

## Application

Once database is created there are certain environment variables that you need to set, mainly:

 - CI_TIME_REFERENCE
 - CI_BASE_URL
 - CI_INDEX_PAGE
 - CI_LOG_THRESHOLD
 - CI_ENCRYPTION_KEY
 - CI_DB_HOST
 - CI_DB_USER
 - CI_DB_PWD
 - CI_DB_NAME
 - CI_SESS_DRIVER
 - CI_SESS_COOKIE_NAME
 - CI_SESS_EXPIRATION
 - CI_SESS_SAVE_PATH
 - CI_SESS_MATCH_IP
 - CI_SESS_TIME_TO_UPDATE
 - CI_SESS_REGENERATE_DESTROY
 - CI_COOKIE_PREFIX
 - CI_COOKIE_DOMAIN
 - CI_COOKIE_PATH
 - CI_COOKIE_SECURE
 - CI_COOKIE_HTTPONLY
 - CI_CSRF_PROTECTION
 - CI_CSRF_TOKEN_NAME
 - CI_CSRF_COOKIE_NAME
 - CI_CSRF_EXPIRE
 - CI_CSRF_REGENERATE
 - CI_CSRF_EXCLUDE_URIS

These variables need to be set so that the `src/application/config/config.php` and `src/application/config/database.php` files can read them, otherwise you need to go to those files and hardcode the encryption key and database credentials which are not under source control for obvious reasons.

If you want to make use of the mailer feature you also need to set this environment variables:

 - CI_SMTP_HOST
 - CI_SMTP_PORT
 - CI_SMTP_USER
 - CI_SMTP_PWD

Or hardcode the values in `src/application/config/email.php`

## Web Server

Just point the root of the document to the `src/public` folder. Please note that out of security concerns I usually move the `index.php` file from CodeIgniter which bootstraps the application to a different folder so we don't have to expose `system/` and `application/` folders on the webserver.

There is an included `htaccess.txt` file that you must rename to `.htaccess` if you want to have friendly URL's, that is, without the `index.php` in the URL.

This file of course should be in the document root of your webserver. The included file also exports the env vars so you can change them there if you don't want to export them system-wide.

Thats it.
