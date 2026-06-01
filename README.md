# PHP MVC Framework

This is a custom PHP MVC-style framework
built from scratch for learning and full control
over backend architecture, featuring a
fully functional blog system with CRUD operations,
CSRF protection, and a custom router.

## What it does right now

- Custom MVC architecture (no framework dependency)
- Custom Router with dynamic parameter support
- Full CRUD for blog posts
- CSRF protection for all state-changing requests
- PDO-based database layer with prepared statements
- Separation autoloading support

## Architecture Overview
The application follows a simplified MVC pattern:

## Project Structure

```
app/
|--- core/		# Framework core (Router, DB, Controller, Autoloader)
|--- controllers/	# Application controllers
|--- models/		# Data models (e.g., PostModel)
|--- views/		# UI templates
|     |___ posts/	
|--- config/		# Database configuration

public
|___ index.php		# Entry point

vendor/			# Composer dependencies (ignored in git)
```

## Active Development
The next phase of this project is focused on
improving user experience and moving toward a
more polished, framework-like structure.

### In progress
- Flash messaging system (success/error feedback after actions)

### Next UI improvements
- Basic layout styling using CSS
- Cleaner form design for create/edit pages
- Improved navigation and post listing UI

### Future UI direction
- Responsive layout (mobile-friendly)
- Reusable layout components
- Optional frontend styling framework integration (minimal, not heavy framework dependence)
