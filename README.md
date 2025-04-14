
## 📌 Task Allocator Pro (TAP)

**Task Allocator Pro** is a full-featured web-based task management system that enables streamlined project coordination, task assignment, and team collaboration. Built using PHP, HTML, and pure CSS, the system is tailored for small-to-medium teams and supports distinct user roles with role-based functionality.

---

## 🧠 Overview

**TAP** provides an intuitive interface for managing tasks, assigning team members, tracking progress, and ensuring accountability across all stages of project execution. The application includes a robust registration and authentication system, multi-step form handling, secure session management, and real-time progress updates.

---

## 🚀 Key Features

### 👨‍💼 Manager Dashboard
- Add and manage projects with detailed metadata and document uploads.
- Assign project leaders to unassigned projects.

### 🧑‍💼 Project Leader Panel
- Create and define tasks within managed projects.
- Assign team members to tasks with role definitions and effort distribution.
- View and manage team contributions per task.

### 👥 Team Member Portal
- View assigned tasks and confirm participation.
- Update task progress with a visual range slider.
- Change task statuses (Pending, In Progress, Completed).

### 🔐 Common Features for All Users
- Multi-step user registration with validation and session tracking.
- Secure login/logout functionality with dynamic menus.
- User profile with display picture and role-specific details.
- Advanced task search and filtering.

---

## 🧩 System Modules

- **User Registration & Authentication** (with 3-step onboarding)
- **Project & Task Management** (with full CRUD operations)
- **Team Member Assignment & Role Management**
- **Task Progress Updates with Real-Time Feedback**
- **Search & Filters** (by ID, status, priority, project, and date)
- **Role-Based Access Control**
- **Responsive UI/UX** (built with CSS Grid & Flexbox)

---

## 🛠️ Tech Stack

- **Backend:** PHP (PDO, prepared statements)
- **Frontend:** HTML5, CSS3 (external only, no frameworks)
- **Database:** MySQL
- **Security:** Input validation, session management, user roles
- **Design Patterns:** Modular PHP scripts, MVC-inspired logic separation

---

## 🎨 UI Highlights

- Clean and consistent layout with:
  - Header (title, user links)
  - Sidebar (role-based navigation)
  - Main content area (dynamic updates)
  - Footer (info and contact)
- Zebra-striped tables with sorting & hover effects
- Form validations with inline feedback
- Navigation link states (active/inactive, hover animations)
- Document previews and interactive elements (buttons, sliders, dropdowns)

---

## 🧪 Testing & Sample Users

The system includes preloaded users for demonstration purposes, with different roles and access levels. The database is seeded with sample projects, tasks, users, and documents to simulate a real working environment.

---

## 🧱 Database Architecture

- Relational MySQL schema with:
  - Users table (linked to roles)
  - Projects and documents
  - Tasks and their assignment
  - Progress tracking and updates
- Fully normalized and indexed for performance
- All SQL operations performed using PDO with named parameter binding for enhanced security

---

## 📂 Project Structure

```
project/
│
├── css/
│   └── style.css
├── scripts/
│   ├── db.php.inc
│   └── *.php
├── images/
```



## 💡 What Makes This Project Stand Out

- Built entirely without frameworks to showcase core web development skills.
- Emphasizes security and clean code practices (prepared statements, session handling).
- Modular and extensible — easy to scale or integrate with APIs.
- Demonstrates ability to translate real-world requirements into a functional web solution.
