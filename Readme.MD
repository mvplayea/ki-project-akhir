# Employee Salary Management System Documentation

## Business Analysis

### Business Goals

- Provide a digital system for employees (_Karyawan_) to **view their salary history** securely and conveniently.
- Allow administrators to **manage employee data** and **input salary records** accurately.
- Minimize errors in salary reporting and enhance HR operational transparency.

### Target Users

- **Karyawan (Employees)**: View only their salary data.
- **Admin (HR or Payroll Staff)**: Manage employees and salaries.
- _(Optional)_: **Super Admin** for advanced role/permissions and audit tracking.

---

## Functional Requirements

### Authentication

- Login system for Admin and Karyawan
- Role-based access control

### Karyawan Module

- Admin can create, update, and delete employee records
- Karyawan can view only their personal profile

### Salary Module

- Admin can create, update, and delete salary records for each employee
- Salary includes:
  - Basic Salary (`gaji_pokok`)
  - Allowance (`tunjangan`)
  - Deductions (`potongan`)
  - Total (`total_gaji`)
  - Pay period (`periode`)
- Karyawan can view salary history (read-only)

---

## Non-Functional Requirements

- The system must be responsive and mobile-friendly.
- Data must be encrypted and protected against unauthorized access.
- Admin actions should be auditable (loggable in future phase).
- The app should handle at least 100 concurrent users.

---

## ️ System Architecture

- **Frontend**: FilamentPHP (Admin Panel for both roles)
- **Backend**: Laravel 10+
- **Database**: MySQL / MariaDB
- **Auth**: Laravel Sanctum or default authentication
- **Deployment**: Shared hosting or VPS (Apache/Nginx)

---

## ️ Database Design

### `users`

| Column     | Type     | Note                  |
| ---------- | -------- | --------------------- |
| id         | BIGINT   | Primary Key           |
| name       | STRING   |                       |
| email      | STRING   | Unique                |
| password   | STRING   | Hashed                |
| role       | ENUM     | ['admin', 'karyawan'] |
| timestamps | DATETIME |                       |

### `karyawans`

| Column        | Type     | Note                 |
| ------------- | -------- | -------------------- |
| id            | BIGINT   | PK                   |
| user_id       | FK       | to `users.id`        |
| nama          | STRING   | Full name            |
| nip           | STRING   | Employee ID (unique) |
| jabatan       | STRING   | Job title            |
| email         | STRING   | Unique               |
| tanggal_masuk | DATE     | Date of hire         |
| status_kerja  | ENUM     | ['Tetap', 'Kontrak'] |
| timestamps    | DATETIME |                      |

### `gajis`

| Column        | Type     | Note              |
| ------------- | -------- | ----------------- |
| id            | BIGINT   | PK                |
| karyawan_id   | FK       | to `karyawans.id` |
| periode       | STRING   | e.g., '2025-06'   |
| gaji_pokok    | BIGINT   | Basic salary      |
| tunjangan     | BIGINT   | Allowances        |
| potongan      | BIGINT   | Deductions        |
| total_gaji    | BIGINT   | Calculated total  |
| tanggal_input | DATE     | Input timestamp   |
| timestamps    | DATETIME |                   |

---

## ️ Laravel Technical Implementation

### Models

- `User` (default Laravel model, extended with role)
- `Karyawan`
- `Gaji`

### Filament Resources

- `KaryawanResource`:
  - Admin access only
  - Form fields: nama, nip, jabatan, email, tanggal_masuk, status_kerja
  - Table view with filters & actions
- `GajiResource`:
  - Admin access only
  - Form fields: karyawan_id, periode, gaji_pokok, tunjangan, potongan, total_gaji, tanggal_input
  - Table view with monetary formatting

### Access Control

| Action                   | Admin | Karyawan |
| ------------------------ | ----- | -------- |
| View employee data       | ✅    | ❌       |
| View own salary          | ❌    | ✅       |
| View all salaries        | ✅    | ❌       |
| Add/edit/delete salary   | ✅    | ❌       |
| Add/edit/delete employee | ✅    | ❌       |

---

## MVP Scope

### Admin Capabilities

- CRUD for `Karyawan` and `Gaji`
- Filter & search capabilities in tables
- Data validation & uniqueness on NIP, email

### Karyawan Capabilities

- View personal salary history (via dedicated Filament panel or relation)

---

## Future Improvements

- Auto-calculate `total_gaji` using `gaji_pokok + tunjangan - potongan`
- Role-based panel access (Filament Panel for `karyawan`)
- PDF export or print feature for salary slips
- Notifications on salary input
- Audit log for changes
- Monthly scheduler for payroll batch upload

---

## Folder Structure (Relevant Parts)
