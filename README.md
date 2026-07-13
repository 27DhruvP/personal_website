# Personal Portfolio & Blog

A personal portfolio website with an integrated blog system, built as coursework for ECS417U (Web Technologies) and doubling as my personal portfolio site.

<!-- 📸 Add screenshots here once available, e.g.:
![Homepage](images/screenshot-home.png)
![Blog](images/screenshot-blog.png)
-->

## About

This site showcases my background, skills, and projects, alongside a fully custom-built blog with role-based access control, comments, and an admin post editor — all built from scratch in PHP without a framework.

## Tech Stack

- **Frontend:** HTML5, CSS3, JavaScript
- **Backend:** PHP (procedural, session-based auth)
- **Database:** MySQL (via MySQLi)
- **Environment:** XAMPP (Apache + MySQL)

## Features

- **Portfolio pages** — About, Education, Skills, and Projects, each with dedicated styling
- **Blog system** with role-based access control:
  - Visitors can read all posts
  - Logged-in users (`user` or `admin` role) can comment
  - Only admins can delete posts and comments
- **Custom-sorted post feed** — blog posts are sorted most-recent-first using a hand-implemented merge sort in PHP (not SQL `ORDER BY`) as part of the assessment criteria
- **Post preview system** — admins can preview a post before publishing
- **Session-based login/logout** with secure password hashing (`password_hash` / `password_verify`)
- **Shared navigation** via a reusable `nav_header.php` include across all pages

## Project Structure

```
├── index.php              # Homepage
├── portfolio.php          # About/portfolio page
├── education.php          # Education page
├── skills.php              # Skills page
├── projects.php           # Projects page
├── viewBlog.php           # Blog feed (merge sort, comments, RBAC)
├── addPost.php            # Admin: create new blog post
├── addEntry.php           # Add blog entry/comment logic
├── previewPost.php        # Admin: preview post before publishing
├── login.php / loginProcess.php / logout.php   # Auth
├── nav_header.php         # Shared navigation
├── db_connect.php         # MySQLi database connection
├── css/                   # Stylesheets (one per page + shared reset/nav)
├── js/                    # Client-side JS (addEntry.js)
└── images/                 # Site images
```

## Running Locally

This project requires a local PHP + MySQL environment (e.g. [XAMPP](https://www.apachefriends.org/)).

1. Clone the repo into your `htdocs` folder:
   ```bash
   git clone https://github.com/27DhruvP/personal_website.git
   ```
2. Start Apache and MySQL in the XAMPP control panel.
3. Create a database named `portfolio_blog` and import the schema (tables: `users`, `blog_posts`, and comments — see `db_connect.php` for connection details).
4. Visit `http://localhost/personal_website/` in your browser.

> **Note:** Default local dev credentials are used in `db_connect.php` (`root` with no password), matching XAMPP's default MySQL setup. Update these if your environment differs.

## Author

**Dhruv Patel**
