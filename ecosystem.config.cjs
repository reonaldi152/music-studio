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
