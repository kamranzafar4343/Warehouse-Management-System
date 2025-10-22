# Warehouse Management System

This is a Warehouse Management System (WMS) built using PHP and MySQL. The system allows for the efficient management of work orders, items, branches, departments, and clients. It includes user authentication, role-based access control, data tracking, and task management. The system is designed to improve the organization and management of warehouse operations.

## Features

### 1. **User Authentication**
- **Login/Logout**: Secure user login and session management.
- **Role-based Access**: Differentiates access for admins and regular users (e.g., Labour).

### 2. **Dashboard**
- **Key Metrics**: Displays the number of companies, branches, and departments in the warehouse.
- **Dynamic Data**: Data is fetched from the database and displayed in a modern dashboard layout.

### 3. **Work Order Management**
- **Work Orders**: Admins can create, update, and manage work orders such as Delivery, Pickup, Perm Out, and Destroy.
- **Task Assignment**: Work orders can be assigned to specific tasks and users, with real-time updates.
- **Status Tracking**: Track the status of work orders and tasks.

### 4. **Client and Branch Management**
- **Clients**: Manage clients by adding and updating company details.
- **Branches**: Manage warehouse branches associated with each client.

### 5. **Item and Barcode Management**
- **Barcode Generation**: Generate barcodes for items using image processing libraries.
- **Item Management**: Add, update, and display items in the warehouse with related metadata.

### 6. **Database Interaction**
- **MySQL Database**: Uses a MySQL database to store and manage all data related to work orders, tasks, clients, items, and more.
- **SQL Queries**: Utilizes `SELECT`, `INSERT`, and `UPDATE` queries to ensure data integrity and real-time updates.

### 7. **User Interface**
- **Responsive UI**: Built with Bootstrap to ensure the interface is responsive and works across all devices (desktop and mobile).
- **DataTables**: Interactive tables with sorting, pagination, and export options (CSV, Excel, PDF).

### 8. **File Upload and Validation**
- **File Uploads**: Users can upload files (e.g., images) with validation for size and type.
- **Client-Side Validation**: Ensures that files meet the required conditions before submission.

### 9. **Export and Reporting**
- **Export Options**: Users can export data to CSV, Excel, or PDF formats.
- **DataTables Integration**: Tables have built-in export options, search functionality, and sorting features.

### 10. **Alerts and Notifications**
- **User Alerts**: Notifications are displayed on the UI for successful actions (e.g., task assignment or file upload).

## Technologies Used
- **PHP**: Server-side scripting for dynamic content.
- **MySQL**: Database management system for storing warehouse data.
- **Bootstrap 5**: For responsive and modern UI components.
- **JavaScript/jQuery**: For client-side interactivity and validation.
- **DataTables**: For interactive tables with search and export functionality.

## Installation

### Prerequisites
Make sure you have the following installed:
- PHP 7.4 or higher
- MySQL
- Composer (for managing PHP dependencies)
- Web server (e.g., Apache or Nginx)

### Steps
1. **Clone the Repository**:
   ```bash
   git clone https://github.com/yourusername/warehouse-management.git
   cd warehouse-management
