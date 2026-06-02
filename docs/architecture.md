# Architecture Overview

This project is a custom PHP MVC framework built without 
external frameworks. It is designed to be simple, extensible, 
and progressively upgraded into a full-featured web application.

---

# Request Lifecycle

Every request follows this flow:

```text
Browser
→ public/index.php
→ Router
→ Controller
→ Model
→ Database
→ Controller (response data)
→ View
→ Layout (main.php)
→ Browser

---

# Core Architecture Layers

## 1. Entry Point

### public/index.php
- Starts session
- Loads Autoloader
- Registers Router
- Defines routes
- Dispatches request

---

## 2. Routing Layer

### Router (app/core/Router.php)

Responsibilities:
- Register GET/POST routes
- Match URL patterns
- Support dynamic parameters (/post/{id})
- Dispatch controller methods

---

## 3. Controller Layer

### Base Controller (app/core/Controller.php)

Responsibilities:
- View rendering
- Flash messaging
- CSRF protection
- Session helpers

Rules:
- No SQL queries here
- No direct output (echo/print discouraged)
- No validation logic (handled by Validator)

---

## 4. Validation Layer

### Validator (app/core/Validator.php)

Responsibilities:
- Required fields validation
- Email validation
- Minimum length validation
- Collect field errors

Used by controllers BEFORE calling models.

---

## 5. Model Layer

### Purpose:
- Database communication only
- Return raw data arrays
- Use PDO prepared statements

### Models:
- PostModel
- CommentModel
- UserModel

Rules:
- No HTTP logic
- No sessions
- No rendering

---

## 6. Database Layer

### Database (app/core/Database.php)

Responsibilities:
- PDO connection
- Prepared statements
- Safe query execution

Methods:
- query()
- fetch()
- fetchAll()
- execute()

---

## 7. View Layer

### Structure:
- layouts/ → main layout wrapper
- partials/ → reusable UI components
- module views → posts/, auth/, etc.

Rules:
- Display only
- Escape output (htmlspecialchars)
- No business logic

---

## 8. Layout System

### main.php

This is the ONLY file that defines:

- HTML structure
- `<head>` section
- `<body>` section
- CSS loading
- Content injection via `$content`

It includes:
- header.php (navigation only)
- footer.php

---

## 9. Flash Messaging System

Stored in session:

- Success messages
- Error messages
- One-time display (auto-cleared)

Flow:
- Controller sets flash
- View renders via partials/flash.php

---

## 10. Authentication System (Current State)

### Implemented:
- UserModel
- AuthController
- Login system
- Password hashing (password_hash / password_verify)
- Session-based login state

### In Progress:
- User registration
- Login/logout completion flow
- Auth-protected routes
- User ownership features

---

# Database Schema

## posts
```text
id
title
content
created_at
```

## comments
```text
id
post_id
name
comment
created_at
```

## users
```text
id
name
email
password (hashed)
created_at
```

---

# Design Principles

This framework follows strict separation of concerns:

- Controllers → request flow only
- Models → database only
- Views → presentation only
- Core → shared system services

No external frameworks are used to ensure full understanding of MVC internals.

---

# Current Stability Status

The system is currently stable with:

- Blog CRUD system
- Comment system
- Flash messaging
- CSRF protection
- Validation layer
- Layout system
- Authentication foundation

---

# Next Milestone

Authentication completion:

- User registration system
- Login/logout finalization
- Auth middleware (route protection)
- User-linked content (posts/comments ownership)
```


