# QSat-Opt Setup Instructions

## Quick Start Guide

### Step 1: Clone or Navigate to Project
```bash
cd D:\santosh\brahmcs.co.in\code\QSat-Opt
```

### Step 2: Setup MySQL Database
```bash
# Open MySQL Command Line or MySQL Workbench
mysql -u root -p

# Execute the schema
source sql/schema.sql

# Or if you're already in MySQL:
USE qsatopt;
```

### Step 3: Setup Laravel Application
```bash
cd laravel_app

# Install Composer dependencies
composer install

# Copy environment file
copy .env.example .env

# Edit .env file and update these lines:
# DB_DATABASE=qsatopt
# DB_USERNAME=root
# DB_PASSWORD=your_mysql_password

# Generate application key
php artisan key:generate

# Test the server
php artisan serve
```

**Laravel will be available at:** http://localhost:8000

### Step 4: Setup Python Flask Service
```bash
cd python_service

# Create virtual environment
python -m venv venv

# Activate virtual environment
venv\Scripts\activate

# Install dependencies
pip install -r requirements.txt

# Edit config.json with your MySQL credentials:
{
  "host": "127.0.0.1",
  "user": "root",
  "password": "your_mysql_password",
  "database": "qsatopt"
}

# Start Flask service
python optimizer_service.py
```

**Flask service will run on:** http://localhost:5005

### Step 5: Add Sample Data (Optional)
```sql
-- Connect to MySQL
USE qsatopt;

-- Add sample satellite
INSERT INTO satellites (name, tle_line1, tle_line2) VALUES 
('ISS (ZARYA)', 
 '1 25544U 98067A   23001.00000000  .00016717  00000-0  10270-3 0  9001',
 '2 25544  51.6400 339.5000 0001234  45.6789  89.0123 15.54225995123456');

-- Add sample passes
INSERT INTO passes (sat_id, start_time, end_time, elevation, duration) VALUES
(1, '2025-11-03 10:00:00', '2025-11-03 10:10:00', 45.5, 600),
(1, '2025-11-03 12:30:00', '2025-11-03 12:38:00', 68.2, 480),
(1, '2025-11-03 15:15:00', '2025-11-03 15:22:00', 52.8, 420);
```

### Step 6: Access the Application
1. Open your browser
2. Go to http://localhost:8000
3. You should see the QSat-Opt dashboard
4. Click "🚀 Optimize" on any satellite to run the quantum optimization

---

## Troubleshooting

### Laravel Not Starting
- Make sure PHP 8.1+ is installed: `php --version`
- Check if port 8000 is available
- Run: `php artisan config:clear`

### Python Service Errors
- Ensure Python 3.9+ is installed: `python --version`
- Activate virtual environment: `venv\Scripts\activate`
- Reinstall dependencies: `pip install -r requirements.txt`

### Database Connection Issues
- Verify MySQL is running
- Check credentials in both `.env` and `config.json`
- Test connection: `mysql -u root -p qsatopt`

### Qiskit Installation Issues
If Qiskit installation fails:
```bash
pip install --upgrade pip
pip install qiskit==0.45.0 --no-cache-dir
pip install qiskit-optimization==0.6.0 --no-cache-dir
```

---

## Running Both Services Together

### Terminal 1 (Laravel):
```bash
cd laravel_app
php artisan serve
```

### Terminal 2 (Python Flask):
```bash
cd python_service
venv\Scripts\activate
python optimizer_service.py
```

---

## Next Steps

1. ✅ Verify both services are running
2. ✅ Access dashboard at http://localhost:8000
3. ✅ Add satellites and passes to database
4. ✅ Run optimization and view results
5. 📚 Read full documentation in `docs/README.md`

---

**Happy Optimizing! 🚀🛰️**

