Hostel Management System
A responsive, web-based admin dashboard designed to streamline and automate hostel operations. This system allows administrators to easily manage room allocations, register new students, track room occupancy, and monitor monthly revenue.

🚀 Features
Secure Authentication: Admin login, registration, and password management with encrypted passwords.

Dashboard Overview: Real-time statistics displaying total registered students and available rooms.

Room Management: Add, edit, delete, and view room details including capacity (seater) and monthly fees.

Student Management: Register new students, allocate rooms, edit details, and remove records.

Search Functionality: Quickly find students by name, registration number, or room number.

Automated Reports:

Occupancy Report: Track available vs. occupied beds across all rooms.

Revenue Report: Monitor highest, lowest, average, and total monthly fee collections.

Modern UI: Fully responsive design utilizing Bootstrap 5, custom CSS, and Font Awesome icons.

🛠️ Technologies Used
Frontend: HTML5, CSS3, Bootstrap 5, JavaScript, jQuery, Font Awesome

Backend: PHP (PDO for database interactions)

Database: MySQL

Architecture: Modular file structure (separated includes for headers, footers, and database configs)

📁 Folder Structure
Plaintext
hostel_management/
│
├── assets/                 # CSS, JS, and Image assets (Bootstrap, jQuery)
├── Authentication/         # PHP scripts for login, logout, registration, and password changes
├── config/                 # Database connection (dbcon.php) and Session auth (auth.php)
├── dashboard/              # Main admin dashboard overview
├── includes/               # Reusable UI components (header.php, footer.php, nav.php)
├── reports/                # Revenue and Occupancy reporting scripts
├── rooms/                  # CRUD operations for Rooms
├── students/               # CRUD operations for Students
│
├── login.php               # Admin login page
├── registration.php        # Admin registration page
├── change_password.php     # Password update page
├── search.php              # Global search results page
└── README.md               # Project documentation

Run the Application
Open your web browser and navigate to:
(http://localhost/php-class4/Hostel_Management_System/)

Register a new admin account to get started!

👤 Author
Pallab Sarkar
