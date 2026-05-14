# Panduan Deploy Music Studio ke VPS

> **Domain:** `music-studio.miftadigital.cloud`  
> **Stack:** PHP 8.4, MySQL, Nginx, PM2, Composer, Certbot

---

## Prasyarat Server

Pastikan VPS sudah terinstall:

- [ ] PHP 8.4 + extension (cli, fpm, mysql, mbstring, xml, bcmath, curl, zip, gd, intl)
- [ ] MySQL / MariaDB
- [ ] Nginx
- [ ] Composer
- [ ] Node.js & NPM (untuk build asset)
- [ ] PM2
- [ ] Certbot (Let's Encrypt)
- [ ] Git

### Cek versi yang terinstall

```bash
php -v
mysql --version
nginx -v
composer -v
node -v
npm -v
pm2 -v
certbot --version
```

---

## 1. Konfigurasi Database MySQL

Login ke MySQL:

```bash
sudo mysql -u root -p
```

Buat database dan user:

```sql
CREATE DATABASE music_studio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'music_studio_user'@'localhost' IDENTIFIED BY 'PASSWORD_YANG_KUAT';
GRANT ALL PRIVILEGES ON music_studio.* TO 'music_studio_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

---

## 2. Clone Project ke Server

```bash
cd /var/www
sudo git clone https://github.com/username/music-studio.git music-studio
sudo chown -R $USER:$USER /var/www/music-studio
cd music-studio
```

> Ganti `https://github.com/username/music-studio.git` dengan URL repository kamu.

---

## 3. Install Dependency

### PHP Dependency (Composer)

```bash
composer install --no-dev --optimize-autoloader
```

### Node.js Dependency & Build Asset

```bash
npm ci
npm run build
```

---

## 4. Konfigurasi Environment

```bash
cp .env.example .env
nano .env
```

Ubah konfigurasi berikut:

```env
APP_NAME="Music Studio"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://music-studio.miftadigital.cloud

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=music_studio
DB_USERNAME=music_studio_user
DB_PASSWORD=PASSWORD_YANG_KUAT

QUEUE_CONNECTION=database
SESSION_DRIVER=database
CACHE_DRIVER=file
```

Generate app key:

```bash
php artisan key:generate
```

---

## 5. Setup Aplikasi Laravel

```bash
# Optimasi route, config, view
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Jalankan migration
php artisan migrate --force

# Jalankan seeder (jika ada)
php artisan db:seed --force

# Storage link
php artisan storage:link
```

---

## 6. Setup Permission

```bash
# Set ownership ke www-data (user nginx/php-fpm)
sudo chown -R www-data:www-data /var/www/music-studio

# Permission direktori storage dan bootstrap/cache
sudo chmod -R 775 /var/www/music-studio/storage
sudo chmod -R 775 /var/www/music-studio/bootstrap/cache
```

---

## 7. Konfigurasi PHP-FPM Pool (Opsional tapi Direkomendasikan)

Buat pool khusus aplikasi:

```bash
sudo nano /etc/php/8.4/fpm/pool.d/music-studio.conf
```

Isi:

```ini
[music-studio]
user = www-data
group = www-data
listen = /run/php/php8.4-fpm-music-studio.sock
listen.owner = www-data
listen.group = www-data
listen.mode = 0660
pm = dynamic
pm.max_children = 10
pm.start_servers = 2
pm.min_spare_servers = 1
pm.max_spare_servers = 3
pm.max_requests = 500
chdir = /
```

Restart PHP-FPM:

```bash
sudo systemctl restart php8.4-fpm
```

---

## 8. Konfigurasi Nginx

Buat konfigurasi server block:

```bash
sudo nano /etc/nginx/sites-available/music-studio
```

Isi dengan:

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name music-studio.miftadigital.cloud;
    root /var/www/music-studio/public;

    index index.php index.html;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.4-fpm-music-studio.sock;
        # Jika tidak pakai pool khusus, gunakan:
        # fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;

        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;

    gzip on;
    gzip_vary on;
    gzip_proxied any;
    gzip_comp_level 6;
    gzip_types text/plain text/css text/xml application/json application/javascript application/rss+xml application/atom+xml image/svg+xml;
}
```

Aktifkan site:

```bash
sudo ln -s /etc/nginx/sites-available/music-studio /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

---

## 9. Setup SSL dengan Certbot (Let's Encrypt)

```bash
sudo certbot --nginx -d music-studio.miftadigital.cloud
```

Ikuti instruksi:
- Masukkan email
- Setuju Terms of Service
- Pilih apakah redirect HTTP ke HTTPS (disarankan: Yes)

Certbot akan otomatis mengubah konfigurasi Nginx untuk HTTPS.

### Test auto-renewal

```bash
sudo certbot renew --dry-run
```

---

## 10. Setup Queue Worker dengan PM2

Buat file konfigurasi PM2:

```bash
nano /var/www/music-studio/ecosystem.config.js
```

Isi:

```javascript
module.exports = {
  apps: [
    {
      name: 'music-studio-queue',
      script: 'artisan',
      args: 'queue:work --sleep=3 --tries=3 --max-time=3600',
      interpreter: 'php',
      cwd: '/var/www/music-studio',
      instances: 1,
      autorestart: true,
      watch: false,
      max_memory_restart: '512M',
      env: {
        APP_ENV: 'production',
      },
      log_date_format: 'YYYY-MM-DD HH:mm:ss Z',
      error_file: '/var/www/music-studio/storage/logs/queue-error.log',
      out_file: '/var/www/music-studio/storage/logs/queue-out.log',
      merge_logs: true,
    },
    {
      name: 'music-studio-schedule',
      script: 'artisan',
      args: 'schedule:work',
      interpreter: 'php',
      cwd: '/var/www/music-studio',
      instances: 1,
      autorestart: true,
      watch: false,
      env: {
        APP_ENV: 'production',
      },
      log_date_format: 'YYYY-MM-DD HH:mm:ss Z',
      error_file: '/var/www/music-studio/storage/logs/schedule-error.log',
      out_file: '/var/www/music-studio/storage/logs/schedule-out.log',
      merge_logs: true,
    },
  ],
};
```

Jalankan dengan PM2:

```bash
cd /var/www/music-studio
pm2 start ecosystem.config.js
pm2 save
pm2 startup
```

> Jalankan perintah yang dioutputkan oleh `pm2 startup` untuk mengaktifkan auto-start saat boot.

### Perintah PM2 yang sering digunakan

```bash
pm2 status                    # Cek status semua proses
pm2 logs music-studio-queue   # Lihat log queue worker
pm2 logs music-studio-schedule # Lihat log scheduler
pm2 restart music-studio-queue # Restart queue worker
pm2 stop all                 # Hentikan semua proses
pm2 delete all               # Hapus semua proses dari list
```

---

## 11. Konfigurasi Scheduler (Cron)

PM2 sudah menangani scheduler dengan `schedule:work`. Namun jika ingin pakai cron tradisional sebagai alternatif:

```bash
crontab -e
```

Tambahkan:

```cron
* * * * * cd /var/www/music-studio && php artisan schedule:run >> /dev/null 2>&1
```

> Jika sudah pakai PM2 untuk schedule:work, **tidak perlu** tambahkan cron ini.

---

## 12. Konfigurasi Firewall (UFW)

```bash
sudo ufw allow OpenSSH
sudo ufw allow 'Nginx Full'
sudo ufw enable
sudo ufw status
```

---

## 13. Maintenance & Update

### Update Aplikasi

```bash
cd /var/www/music-studio

# Pull update
git pull origin main

# Install dependency
composer install --no-dev --optimize-autoloader
npm ci && npm run build

# Jalankan migration
php artisan migrate --force

# Clear dan cache ulang
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Restart PM2 workers
pm2 restart all

# Reload nginx (jika ada perubahan konfigurasi)
sudo systemctl reload nginx
```

### Backup Database

```bash
mysqldump -u music_studio_user -p music_studio > backup_$(date +%Y%m%d_%H%M%S).sql
```

---

## Troubleshooting

### Permission denied pada storage

```bash
sudo chown -R www-data:www-data /var/www/music-studio/storage
sudo chmod -R 775 /var/www/music-studio/storage
sudo chmod -R 775 /var/www/music-studio/bootstrap/cache
```

### 502 Bad Gateway

- Cek status PHP-FPM: `sudo systemctl status php8.4-fpm`
- Cek socket path di Nginx dan PHP-FPM pool apakah sama
- Cek log: `sudo tail -f /var/log/nginx/error.log`

### Queue tidak berjalan

```bash
pm2 logs music-studio-queue
# atau manual test
php artisan queue:work --verbose
```

### SSL tidak valid / expired

```bash
sudo certbot renew --dry-run
sudo certbot renew
sudo systemctl reload nginx
```

---

## Struktur File Penting

```
/var/www/music-studio/
├── .env                          # Konfigurasi environment
├── ecosystem.config.js           # Konfigurasi PM2
├── storage/logs/                 # Log aplikasi
│   ├── laravel.log
│   ├── queue-error.log
│   ├── queue-out.log
│   ├── schedule-error.log
│   └── schedule-out.log
└── public/                       # Document root nginx
```

---

## Referensi Perintah Cepat

| Aksi | Perintah |
|------|----------|
| Restart PHP-FPM | `sudo systemctl restart php8.4-fpm` |
| Reload Nginx | `sudo systemctl reload nginx` |
| Status Nginx | `sudo systemctl status nginx` |
| Status PM2 | `pm2 status` |
| Log Laravel | `tail -f storage/logs/laravel.log` |
| Log Nginx | `sudo tail -f /var/log/nginx/error.log` |

---

> **Catatan:** Ganti semua placeholder seperti `PASSWORD_YANG_KUAT`, `username/repo.git`, dan path socket PHP-FPM sesuai dengan konfigurasi server kamu.
