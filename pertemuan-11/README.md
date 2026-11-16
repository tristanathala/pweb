## Cara Menjalankan

1. Import `database/db_ppdb_smk.sql` lewat phpMyAdmin atau terminal.
   ```bash
   mysql -u dbdev -p < database/db_ppdb_smk.sql
   ```
2. Salin `config/database.example.php` menjadi `config/database.php` lalu isi username dan password MySQL.
3. Jalankan server PHP dari folder ini.
   ```bash
   php -S localhost:8000
   ```
4. Buka `http://localhost:8000` di browser.
