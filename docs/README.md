# QSat-Opt - Quantum Satellite Pass Optimization

**A hybrid Laravel + Python (Flask) application for optimizing satellite pass windows using quantum-inspired algorithms.**

---

## 🚀 Overview

QSat-Opt leverages quantum computing principles (via Qiskit QAOA) to optimize satellite communication windows, helping ground stations maximize their coverage and efficiency.

### Features
- 🛰️ Satellite TLE management
- 📊 Pass prediction & tracking
- 🧠 Quantum-inspired optimization using QAOA
- 📈 Priority scoring for optimal communication windows
- 🎨 Beautiful Bootstrap-based dashboard

---

## 🗂️ Project Structure

```
qsatopt/
│
├── laravel_app/                    # Laravel main application
│   ├── app/
│   │   ├── Http/Controllers/       # Controllers for web routes
│   │   │   ├── SatelliteController.php
│   │   │   └── OptimizationController.php
│   │   └── Models/                 # Eloquent models
│   │       ├── Satellite.php
│   │       ├── Pass.php
│   │       └── OptimizedWindow.php
│   ├── resources/views/            # Blade templates
│   │   ├── layouts/app.blade.php
│   │   └── dashboard.blade.php
│   ├── routes/web.php              # Web routes
│   └── .env.example                # Environment configuration template
│
├── python_service/                 # Flask microservice for AI/Quantum logic
│   ├── optimizer_service.py        # Main Flask application
│   ├── requirements.txt            # Python dependencies
│   └── config.json                 # Database configuration
│
├── sql/
│   └── schema.sql                  # MySQL database schema
│
└── docs/
    └── README.md                   # This file
```

---

## 🔧 Installation & Setup

### Prerequisites
- PHP 8.1+ with Composer
- Python 3.9+ with pip
- MySQL 5.7+ or MariaDB
- Apache/Nginx with mod_rewrite enabled

### 1. Database Setup

```bash
# Login to MySQL
mysql -u root -p

# Import schema
source sql/schema.sql

# Or manually execute
mysql -u root -p < sql/schema.sql
```

### 2. Laravel Setup

```bash
cd laravel_app

# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Update .env with your database credentials
# DB_DATABASE=qsatopt
# DB_USERNAME=root
# DB_PASSWORD=yourpassword

# Run migrations (if you have any)
php artisan migrate

# Start Laravel development server
php artisan serve
```

The Laravel app will be available at `http://localhost:8000`

### 3. Python Flask Service Setup

```bash
cd python_service

# Create virtual environment (recommended)
python -m venv venv

# Activate virtual environment
# On Windows:
venv\Scripts\activate
# On Linux/Mac:
source venv/bin/activate

# Install dependencies
pip install -r requirements.txt

# Update config.json with your database credentials
# {
#   "host": "127.0.0.1",
#   "user": "root",
#   "password": "yourpassword",
#   "database": "qsatopt"
# }

# Start Flask service
python optimizer_service.py
```

The Flask service will run on `http://localhost:5005`

---

## 📊 Database Schema

### Tables

#### `satellites`
- Stores satellite information and TLE (Two-Line Element) data
- Fields: id, name, tle_line1, tle_line2, last_updated

#### `passes`
- Predicted satellite passes over ground station
- Fields: id, sat_id, start_time, end_time, elevation, duration

#### `optimized_windows`
- Quantum-optimized communication windows
- Fields: id, sat_id, start_time, end_time, priority_score, created_at

---

## 🎯 Usage

1. **Add Satellites**: Insert satellite data into the `satellites` table with TLE information
2. **Predict Passes**: Populate the `passes` table with predicted satellite passes
3. **Optimize**: Click the "🚀 Optimize" button on the dashboard for any satellite
4. **View Results**: Optimized windows appear in the "Optimized Windows" section

### Sample Data Insertion

```sql
INSERT INTO satellites (name, tle_line1, tle_line2) VALUES 
('ISS', 
 '1 25544U 98067A   23001.00000000  .00016717  00000-0  10270-3 0  9001',
 '2 25544  51.6400 339.5000 0001234  45.6789  89.0123 15.54225995123456');

INSERT INTO passes (sat_id, start_time, end_time, elevation, duration) VALUES
(1, '2025-11-03 10:00:00', '2025-11-03 10:10:00', 45.5, 600),
(1, '2025-11-03 12:30:00', '2025-11-03 12:38:00', 68.2, 480),
(1, '2025-11-03 15:15:00', '2025-11-03 15:22:00', 52.8, 420);
```

---

## 🧠 Technology Stack

### Backend
- **Laravel 10+**: PHP framework for web application
- **Flask**: Python microservice for optimization algorithms
- **MySQL**: Relational database

### Optimization Engine
- **Qiskit**: IBM's quantum computing framework
- **QAOA**: Quantum Approximate Optimization Algorithm
- **Qiskit Optimization**: Quadratic programming solver

### Frontend
- **Blade Templates**: Laravel's templating engine
- **Bootstrap 5**: Modern CSS framework
- **Vanilla JavaScript**: No heavy frontend frameworks

---

## 🔄 API Endpoints

### Laravel Routes
- `GET /` - Dashboard (list satellites & optimized windows)
- `GET /optimize/{id}` - Trigger optimization for satellite

### Python Flask API
- `GET /optimize?sat_id={id}` - Run quantum optimization algorithm

---

## 🛠️ Configuration

### Laravel (.env)
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=qsatopt
DB_USERNAME=root
DB_PASSWORD=yourpassword

PYTHON_SERVICE_URL=http://127.0.0.1:5005
```

### Python (config.json)
```json
{
  "host": "127.0.0.1",
  "user": "root",
  "password": "yourpassword",
  "database": "qsatopt"
}
```

---

## 🐛 Troubleshooting

### Issue: Python service not connecting
- Ensure Flask is running on port 5005
- Check firewall settings
- Verify database credentials in `config.json`

### Issue: Database connection failed
- Verify MySQL is running
- Check credentials in `.env` and `config.json`
- Ensure database `qsatopt` exists

### Issue: Qiskit errors
- Update Qiskit: `pip install --upgrade qiskit qiskit-optimization`
- Check Python version (3.9+ required)

---

## 📝 Development Roadmap

- [ ] Add real-time TLE fetching from CelesTrak
- [ ] Implement ground station location management
- [ ] Add visualization for satellite passes
- [ ] Integrate real quantum hardware via IBM Quantum
- [ ] Add user authentication & multi-tenancy
- [ ] Export optimized schedules to CSV/PDF
- [ ] Add RESTful API for external integrations

---

## 📄 License

This project is open-source and available under the MIT License.

---

## 👥 Contributors

- Project Lead: Santosh
- Organization: brahmcs.co.in

---

## 🔗 Resources

- [Qiskit Documentation](https://qiskit.org/documentation/)
- [Laravel Documentation](https://laravel.com/docs)
- [Flask Documentation](https://flask.palletsprojects.com/)
- [TLE Format Guide](https://en.wikipedia.org/wiki/Two-line_element_set)

---

## 📧 Support

For issues, questions, or contributions, please contact the development team at brahmcs.co.in.

---

**Built with ❤️ using Quantum Computing & Modern Web Technologies**

