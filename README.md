# Books Information CRUD using PDO

A simple and clean **CRUD (Create, Read, Update, Delete)** web application for managing books information built with **PHP** and **PDO**.

✨ **[Try the System Live Here!](https://books-info.kesug.com/)** ✨

### Features
- Full CRUD operations using **PDO** (Prepared Statements)
- Book cover image upload functionality
- Form validation using `empty()` function
- Responsive design with **Bootstrap 5**
- Clean and modern dark UI

### Technologies Used
- PHP 8
- PDO (MySQL)
- Bootstrap 5
- HTML & CSS

### Database Structure
- **Table Name**: `books`
- Fields: `id`, `title`, `author`, `genre`, `year_published`, `pages`, `image`, `created_at`

### Screenshots
![Books CRUD Dashboard](https://github.com/JLNerecina/AppDev_CRUD_Books-Info/blob/main/AppDev_Books_Info.png)  

### How to Run Locally
1. Clone the repository
2. Import the `books` table using the provided SQL
3. Place the project in your `htdocs` or Laragon `www` folder
4. Update `config.php` with your database name
5. Create an `uploads` folder and give it write permission
6. Run on `http://localhost/Lab9` (or your folder name)

### Requirements
- PHP 8+
- MySQL / MariaDB
- Web Server (XAMPP, Laragon, etc.)

---

**Made as a requirement for PHP CRUD Activity using PDO**
