# PHP MVC Framework

A custom PHP MVC framework built from scratch for learning, 
experimentation, and complete architectural control.

The project currently includes a working blog system, 
comment system, validation layer, flash messaging, 
CSRF protection, authentication foundation, 
and a custom routing engine without relying on a 
third-party framework.

---

### Core Framework

- Custom MVC architecture
- Custom Router with dynamic route parameters
- Autoloading system
- Base Controller class
- PDO database abstraction layer
- Prepared statements for SQL safety
- View rendering with layout support

---

### Security

- CSRF protection
- Password hashing support
- Input validation layer
- Session-based authentication
- Role-based access control (RBAC)
- Centralized authorization system

---

### Authorization (RBAC System - Phase 2 Complete)

- Centralized authorization logic in Controller.php
- Owner vs Admin permission system
- authorizeOwnerOrAdmin() helper for secure resource access
- No permission logic inside views or models
- View content injection ($user, $isAdmin, $isAuthenticated)
- Ownership validation via database records (user_id)

---

### Blog System

- Create posts
- Read posts
- Update posts
- Delete posts
- Post detail pages

---

### Comment System

- Add comments to blog posts
- Comment validation system
- Flash messaging system
- Validation error handling with session persistence
- Form state persistence after validation errors 
- Ownership-based comment permissions (RBAC)

---

### User Experience

- Flash messaging system
- Layout system
- Reusable partials
- Asset pipeline for CSS, JavaScript, and images

---

### Authentication (Current Status)

#### Completed:

- Users database table
- UserModel
- AuthController
- Authentication routes
- User registration system
- Password hashing (secure storage)
- Auto-login after registration
- User creation in database

---

#### Current State

Authentication system is fully implemented with session-based login/logout,
including role-based access control (RBAC) and centralized authorization.

The framework now includes:

- Session-based authentication (login/logout)
- Role-based access control (RBAC)
- Centralized authorization in Controller layer
- Ownership-based access control for resources
- Admin override permissions

---

## Architecture Overview

The application follows a traditional MVC architecture.

---

### Request Flow

Browser  
→ public/index.php  
→ Router  
→ Controller  
→ Model  
→ Database  
→ View  
→ Layout  
→ Browser  

Authorization Flow (RBAC)
-> isAuthenticated()
-> authorizeOwnerOrAdmin(resource)
-> Model executes safe operation
-> View renders using injected context ($user, $isAdmin)

---

## Project Structure

```text
app/
├── controllers/
├── core/
│   ├── Autoloader.php
│   ├── Controller.php
│   ├── Database.php
│   ├── Router.php
│   ├── Validator.php
│   ├── Request.php
│   └── Session.php
│
├── models/
│   ├── PostModel.php
│   ├── CommentModel.php
│   └── UserModel.php
│
├── views/
│   ├── layouts/
│   ├── partials/
│   ├── posts/
│   ├── auth/
│   └── errors/

config/
└── database.php

public/
├── index.php
└── assets/
    ├── css/
    ├── js/
    └── img/
```

---

## Database Tables

Current Tables

- posts
- comments
- users

---

## Development Roadmap

### Current Milestone

Authentication System

- Registration
- Login verification
- Logout
- Session management
- Route protection

---

### Planned Features

- User-owned posts
- User-owned comments
- Image uploads for posts
- Pagination
- Authorization roles
- Admin dashboard
- Search functionality

---

## Design Philosophy

This project intentionally avoids large frameworks in 
order to understand and implement the underlying concepts manually:

- Routing
- Controllers
- Models
- Views
- Validation
- Authentication
- Sessions
- Security

The goal is a clean, extensible MVC architecture that can 
continue growing without major rewrites.










