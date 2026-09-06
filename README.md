# Simple Blog Platform

A basic blogging platform using PHP, HTML, jQuery, AJAX, JSON, Bootstrap, CSS, and MySQL.

## Install Process

1. Create a MySQL database named `blog_db` and import `database.sql`.
2. Update the database settings in `config.php`.
3. Serve the project with a PHP web server, for example:

```sh
php -S localhost:8000
```

4. Open `http://localhost:8000` to view the blog.
5. Open `http://localhost:8000/admin/login.php` to manage posts.

## Admin Login

The database setup creates one admin account:

- Username: `admin`
- Password: `admin123`

Change the password after the first login using **Change Password** in the admin area.

## Admin Features

The public page can only view posts. The admin area allows the logged-in administrator to:

- Add posts
- Edit posts
- Delete posts
- Change the admin password
- Log out

The post handler checks the PHP session, so hiding the buttons on the page is not the only protection.
