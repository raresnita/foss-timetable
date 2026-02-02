# FOSS Timetable

<img width="1919" height="1079" alt="Captură de ecran 2026-02-02 125638" src="https://github.com/user-attachments/assets/4e1f752d-77c0-43ad-b43a-ed53490c397e" />

## Short description
FOSS Timetable is a Laravel-based demonstrative application for managing school timetables.
It's essentially a rewrite of my bachelor thesis project, but free of any university-specific data.

The app allows students to view their current and upcoming classes and receive notifications from professors, while showcasing common Laravel features in a practical context.

###  Things demoed
This project serves as a showcase for modern Laravel features and best practices in building data-driven applications.
* Complex Scheduling Logic: Utilizing Carbon to handle real-time comparisons, allowing the app to dynamically display the "Current Class" and "Next Class" based on the system's timezone.
* Role-Based Notifications: A native implementation of Laravel Notifications, enabling professors to broadcast alerts to specific student groups via database or mail channels.
* Modular UI with Blade: Built using Blade Components for a DRY (Don't Repeat Yourself) approach to UI elements like timetable slots and navigation bars.
* Robust Data Architecture: A structured relational database (see diagram below) handling many-to-many relationships between students, groups, and courses.
* Seeders & Factories: Automated generation of massive, realistic datasets for testing different timetable densities.
* Secure Authentication: Out-of-the-box user authentication and authorization gates to ensure students and professors have distinct access levels.

### Tools used:
- Laravel 12
- PHP 8.2
- TailwindCSS 4.1

### Database diagram
<img width="916" height="903" alt="database sqlite" src="https://github.com/user-attachments/assets/3acd9fae-8c20-4ca1-8f1b-4e572a9875eb" />
