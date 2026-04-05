# Library Management System v2.0 (LMS)

A professional-grade, automated library management solution built on the Laravel framework. Designed for efficiency, fair use, and rich user interaction.

## 🚀 Technologies Used
- **Backend**: Laravel (PHP)
- **Database**: MySQL
- **Frontend**: Bootstrap 5, Blade Templates, Bootstrap Icons
- **Date Management**: Carbon

---

## 📅 Key Features & Business Logic

### 1. Unified Inventory Management
- **Hierarchical Categories**: Organize books by genres with dynamic slugs.
- **Author Profiles**: Comprehensive author management including biographies and publication links.

### 2. Intelligent Book Issuance
- **Default Period**: Books are issued for exactly **1 Month**.
- **Grace Period**: A **3-day** window post-due-date where no fines are accrued.
- **Daily Overdue Penalty**: **10 per day** fine starting from day 4 overdue.
- **Cooldown Policy**: After returning a book, a student must wait **30 days** before they can issue the same title again.

### 3. Renewal Workflow
- **Student Requests**: Students can request a renewal directly from their dashboard.
- **Admin Approval**: Admins must approve or reject renewal requests (1-time limit per book).
- **Grace Block**: Extensions cannot be requested if the book is already overdue.

### 4. Advanced Reservation & Waitlist
- **Waitlist Logic**: Students can "Reserve" out-of-stock books.
- **"Ready for Pickup" Handshake**: When a book is returned, if there's a reservation, the book is **locked** for the next student in line for **3 days**.
- **Admin Notifications**: The dashboard alerts admins when reserved books are ready for collection.

---

## 👥 User Roles

### **Admin (admin@example.com / 123456)**
- Full CRUD for Students, Books, Authors, and Categories.
- Issue and Return books.
- Manage Fines (Mark as Paid).
- Approve/Decline Renewal Requests.
- View global Waitlist and Reservation statuses.

### **Student (user role)**
- Browse the library inventory.
- Track their active book issues and due dates.
- Request book renewals.
- Reserve books that are out of stock.
- View their own penalty history.

---

## 🛠️ Installation Guide

1.  **Clone the Repository**:
    ```bash
    git clone [repository-url]
    cd library-management
    ```

2.  **Install Dependencies**:
    ```bash
    composer install
    npm install && npm run build
    ```

3.  **Environment Setup**:
    - Copy `.env.example` to `.env`.
    - Configure your MySQL database settings.
    - Generate APP_KEY: `php artisan key:generate`.

4.  **Database Migrations**:
    ```bash
    php artisan migrate --seed
    ```

5.  **Run Locally**:
    ```bash
    php artisan serve
    ```

---

## 🏛️ MVC Architecture Highlights
- **Models**: `Book`, `Student`, `Author`, `Category`, `BookIssue`, `Fine`, `BookReservation`.
- **Controllers**: Segmented logic for `IssueController`, `FineController`, and `ReservationController`.
- **UI Architecture**: Modular `layout/app.blade.php` with dynamic sidebar and stat components.

---

*Documentation compiled on: March 29, 2026*
