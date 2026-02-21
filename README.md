# Ironman Gym Automation System - Setup Instructions

This is a fully functional demo of a Gym Management System built with Core PHP and MySQL.

## 🚀 Features
- **Public Website**: Landing page, About, Membership, Contact, Lead Capture.
- **Admin Panel**: Dashboard stats, Member CRUD, Search, Auto-Expiry.
- **Auto Billing**: Generates printable PDF-style invoices.
- **Diet Plan Demo**: Simulated diet plan generation and WhatsApp sharing logic.
- **Lead Dashboard**: View and manage website enquiries.

## 🛠️ Local Setup
1. **Database Setup**:
   - Create a database named `ironman_gym` in your MySQL (e.g., via phpMyAdmin).
   - Import the `database.sql` file provided in the root directory.
   - Default Database User: `root`, Password: `` (empty).

2. **Configuration**:
   - Open `config.php` and update the database credentials if they differ from the defaults.

3. **Admin Access**:
   - URL: `http://your-local-url/ironman-gym-demo/admin/`
   - **Username**: `admin`
   - **Password**: `admin123`

## ☁️ cPanel Deployment
1. **Upload Files**: Zip the project folder and upload it to `public_html/gym` or your desired directory. Extract the files.
2. **Database**: Use "MySQL Database Wizard" in cPanel to create the database and user.
3. **Import SQL**: Open "phpMyAdmin", select your new database, and import `database.sql`.
4. **Update config.php**: Update the `DB_NAME`, `DB_USER`, and `DB_PASS` in `config.php` on the server.
5. **Set PHP Version**: Ensure your hosting is running PHP 7.4 or higher.

## 🎨 Theme
- **Theme**: Dark + Gold
- **CSS**: Vanilla CSS with Bootstrap 5
- **Icons**: Font Awesome 6

---
**Note**: This is a demo application. The WhatsApp feature uses `wa.me` links for demonstration without requiring commercial API keys.
