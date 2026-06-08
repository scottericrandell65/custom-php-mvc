# Development Notes

This file tracks real-time architectural decisions, 
progress, and upcoming work for the custom PHP MVC framework.

---

## Current Status (Stable System)

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

- User registration system implemented
- Login/logout system completed
- Password hashing and secure storage
- Auto-login after registration working
- Session-based authentication standardized
- Role-based access control (RBAC) implemented
- Admin vs user permission separation complete
- Ownership-based access control implemented

---

### Partially Completed

- Login flow exists but still being finalized for full consistency
- Logout functionality requires verification and cleanup confirmation
- Session-based authentication foundation is in place

---

### Next Step

- Finalize login/logout lifecycle
- Implement route protection (auth guards)
- Prepare user ownership model for posts/comments

---

## Authentication Architecture (FINALIZED)

- Session-based authentication system
- Centralized identity stored in Controller context
- Role system stored in session (user_role)
- Password hashing using PHP native functions
- Clean login/logout lifecycle

---

### UI/UX Layer
- Asset pipeline created (public/assets)
- Header/footer partial system finalized
- Flash message partial fixed and working
- Form validation UX improved (field-level errors)
- Layout system normalized (no duplicate HTML structure)

---

## Current Work Phase

### Phase 2 Complete: Authentication + RBAC

The system now includes:

- Full authentication lifecycle (register/login/logout)
- Session-based identity management
- Role-based access control (admin vs user)
- Ownership-based permissions (user_id checks)
- Centralized authorization helpers in Controller

### Status: STABLE

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
- Pagination for posts/comments
- Image uploads for posts
- Search functionality
- Improved error pages (404/403/500)

### High Priority
- Admin dashboard UI layer
- Post analytics (views/engagement tracking)
- Comment moderation tools

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

## Next Milestone (Phase 3)

### UI/UX Layer Enhancement

- Navigation and layout polish
- Admin vs user UI separation
- Button, spacing, and form styling system
- Flash message UI improvements
- Layout visual hierarchy improvements


