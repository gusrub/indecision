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

## Application

Once database is created there are certain environment variables that you need to set, mainly:

 - FB_ENCRYPTION_KEY
 - FB_DB_HOST
 - FB_DB_USER
 - FB_DB_PWD
 - FB_DB_NAME

These variables need to be set so that the `src/application/config/config.php` and `src/application/config/database.php` files can read them, otherwise you need to go to those files and hardcode the encryption key and database credentials which are not under source control for obvious reasons.

If you want to make use of the mailer feature you also need to set this environment variables:

 - FB_SMTP_HOST
 - FB_SMTP_PORT
 - FB_SMTP_USER
 - FB_SMTP_PWD

Or hardcode the values in `src/application/config/email.php`

## Web Server

Just point the root of the document to the `src/public` folder. Please note that out of security concerns I usually move the `index.php` file from CodeIgniter which bootstraps the application to a different folder so we don't have to expose `system/` and `application/` folders on the webserver.

If you are going to use the included `.htaccess` file and you are not using the root of the webserver (e.g. you are using an alias in apache or a subfolder) then you need to set the `RewriteBase` directive in it, so for instance, if you host the application in:

 > http://localhost/indecision

Then you need to set the rewrite base to that path like:

```
RewriteBase /indecision
```

And you will also need to change the `base_url` config option in `src/application/config/config.php` array value to have the relative path, so you would have something like:

```
$config['base_url'] = 'http://localhost/indecision';
```
If you don't want to use the htaccess file you need to set the index page in `src/application/config/config.php` as well:

```
$config['index_page'] = 'index.php';
```

Otherwise it must be left blank.

Thats it.