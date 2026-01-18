# 🚗 Parking Management System

A role-based Parking Management System built using **PHP & MySQL** that allows admins to manage vehicles, parking slots, and parking operations (entry & exit) with secure authentication and real-world business logic.

This project was developed as part of an internship / academic project with a strong focus on **backend logic, database design, and security best practices**.

---

## ✨ Features

### 🔐 Authentication & Security
- Unified login system for **Admin** and **User**
- Role-based access control (RBAC)
- Secure password storage using `password_hash()` and `password_verify()`
- Session-based authentication
- Logout functionality

### 🅿️ Parking Management
- Manual parking slot selection (real-life scenario)
- Vehicle entry with validation
- Vehicle exit with slot release
- Prevention of double parking (one vehicle = one active parking)
- Parking history preserved (no data loss)

### 🧱 Master Data Management (Admin)
- Manage Parking Slots (Add / View / Status)
- Manage Vehicles (Add / View / Deactivate)
- Vehicles linked to users using foreign keys

### 📊 Reports
- Currently parked vehicles
- Parking history with entry & exit timestamps
- Slot-wise vehicle allocation

---

## 🛠️ Tech Stack

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP (Core PHP)
- **Database:** MySQL
- **Server:** Apache (XAMPP)
- **Authentication:** PHP Sessions
- **Security:** Bcrypt password hashing

---

## 🗂️ Project Structure

