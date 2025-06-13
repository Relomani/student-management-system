# Admin Guide

## Configuration

All configuration is handled automatically:
- `db.php` will create the `student_db` and `students` table if they do not exist.
- Change database settings in `db.php` if needed:
```php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "student_db";
