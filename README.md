# PHP MVC Framework

A custom PHP MVC framework built from scratch for learning, 
experimentation, and complete architectural control.

The project currently includes a working blog system, 
comment system, validation layer, flash messaging, 
CSRF protection, authentication foundation, 
and a custom routing engine without relying on a 
third-party framework.

## Current Features

### Core Framework

- Custom MVC architecture
- Custom Router with dynamic route parameters
- Autoloading system
- Base Controller class
- PDO database abstraction layer
- Prepared statements for SQL safety
- View rendering with layout support

### Security

- CSRF protection
- Password hashing support
- Input validation layer
- Session-based authentication foundation

### Blog System

- Create posts
- Read posts
- Update posts
- Delete posts
- Post detail pages

### Comment System

- Add comments to blog posts
- Comment validation
- Flash success messages
- Validation error handling
- Sticky form inputs after validation failures

### User Experience

- Flash messaging system
- Layout system
- Reusable partials
- Asset pipeline for CSS, JavaScript, and images

### Authentication (Current Status)

Completed:

- Users database table
- UserModel
- AuthController
- Login page
- Authentication routes

In Progress:

- User registration
- Login/logout testing
- Route protection
- Authorization middleware

---

## Architecture Overview

The application follows a traditional MVC architecture.

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










