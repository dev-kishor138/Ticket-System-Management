# Ticket-System-Management

The **Ticket-System-Management** is a web application built with Laravel to provide a streamlined interface for purchasing tickets, managing buses, routes, and users. The platform is designed to make ticket booking convenient and efficient for administrators and end users.

## Features

### User Authentication
- User Registration and Login.
- Role-based access for Admins and Users.

### Dashboard
- **Admin Dashboard:** View and manage purchases.
- **User Dashboard:** Personalized user information.

### Bus Management
- Add, edit, view, and delete bus records.

### Route Management
- Add, edit, view, and delete travel routes.

### Ticket Management
- Add, edit, view, and delete ticket details.

### Purchases
- Buy tickets with selected seats.
- Track purchase history.

## Technologies Used

- **Backend:** Laravel (PHP Framework)
- **Frontend:** Blade Templating, Bootstrap, jQuery, Toastr
- **Database:** MySQL
- **Version Control:** Git
- **Libraries:**
  - FontAwesome for icons.
  - SweetAlert for confirmations.

## Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/dev-kishor138/Ticket-System-Management.git
   cd Ticket-System-Management
2. **Install dependencies:**
   ```bash
   composer install
   npm install
3. **Setup environment variables:**
   ```bash
   Copy .env.example to .env.
   Configure database credentials and application settings.
4. **Setup environment variables:**
   ```bash
   php artisan migrate
5. **Start the development server:**
   ```bash
   php artisan serve

## Usage

 - Access the application at http://127.0.0.1:8000.
 - Register as a user or log in as an admin (use seeded credentials if applicable).
 - Explore dashboards and manage buses, routes, and tickets.

 ## API Endpoints

### Authentication
- **`POST /login`**: Log in as a user.
- **`POST /register`**: Register a new user.

### Bus Management
- **`GET /bus`**: List all buses.
- **`POST /bus/store`**: Add a new bus.
- **`POST /bus/update/{id}`**: Update bus details.
- **`GET /bus/delete/{id}`**: Delete a bus.

### Travel Route Management
- **`GET /travel-route`**: List all routes.
- **`POST /travel-route/store`**: Add a new route.
- **`POST /travel-route/update/{id}`**: Update route details.
- **`GET /travel-route/delete/{id}`**: Delete a route.

### Ticket Management
- **`GET /ticket`**: List all tickets.
- **`POST /ticket/store`**: Add a new ticket.
- **`POST /ticket/update/{id}`**: Update ticket details.
- **`GET /ticket/delete/{id}`**: Delete a ticket.

### Purchase Management
- **`POST /purchase/store`**: Purchase a ticket.


## Directory Structure

- **`app/Models`**: Eloquent models for database entities like `User`, `Bus`, `TravelRoute`, and `Tickets`.
- **`app/Http/Controllers`**: Controllers handling business logic for authentication, ticketing, and admin operations.
- **`resources/views`**: Blade templates for the frontend UI.
- **`database/migrations`**: Database schema definitions.
