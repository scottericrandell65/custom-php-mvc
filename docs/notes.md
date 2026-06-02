# Development Notes

This file tracks real-time architectural decisions, 
progress, and upcoming work for the custom PHP MVC framework.

---

## 🟢 Current Status (Stable System)

The core framework is now stable and functional with:

- Custom MVC architecture implemented
- Router with dynamic parameters working
- PDO database abstraction layer complete
- Validator system implemented
- Flash messaging system working
- CSRF protection implemented
- Layout system (main.php) finalized
- Comments system working
- Blog CRUD system complete
- Authentication foundation implemented

---

## Recently Completed Work

### Authentication Foundation
- Created UserModel
- Created AuthController
- Implemented login system
- Added password hashing (password_hash / password_verify)
- Session-based authentication state established
- Login page integrated into MVC system

### UI/UX Layer
- Asset pipeline created (public/assets)
- Header/footer partial system finalized
- Flash message partial fixed and working
- Form validation UX improved (field-level errors)
- Layout system normalized (no duplicate HTML structure)

---

## Current Work Phase

### Authentication Completion Phase

Next required steps:

- User registration system
- Login/logout flow finalization
- Session cleanup improvements
- Auth guard system (protect routes)
- User identity integration into posts/comments

---

## Architectural Decisions (Finalized)

### MVC Rules
- Controllers: request flow only (NO SQL, NO echo)
- Models: database layer only
- Views: presentation only
- Core: shared system services only

---

### Validation Strategy
- Centralized Validator class
- Controllers delegate all validation
- No inline validation logic in controllers

---

### Session Strategy
- Native PHP sessions used
- Flash messages stored in session and auto-cleared
- Authentication state stored in session (user_id, user_name)

---

### Routing Strategy
- Simple flat route definitions
- Dynamic parameters supported via `{id}` syntax
- No route groups (for now — simplicity first)

---

## Rejected Ideas (For Now)

- No heavy dependency injection container
- No framework-level ORM
- No route grouping system (yet)
- No service container abstraction

Reason: keep framework understandable and debuggable

---

## Future Enhancements (Backlog)

### Medium Priority
- User registration system
- Password reset system
- Route protection middleware
- Pagination for posts/comments
- Post ownership (user_id foreign key)

### High Priority (Next Phase)
- Admin role system
- Image uploads for posts
- Basic search functionality
- Improved error pages (404/403/500)

---

### Long-Term Ideas
- API layer (REST endpoints)
- JSON response mode
- Frontend separation (optional SPA-style integration)
- Simple caching layer

---

## Design Philosophy

This framework prioritizes:

- Simplicity over abstraction
- Readability over complexity
- Manual control over automation
- Clear MVC separation
- Progressive enhancement (no rewrites)

The goal is a framework that can grow without requiring architectural replacement.

---

## Next Milestone

Complete authentication system:

- Registration flow
- Login/logout completion
- Route protection middleware
- User-linked content ownership


