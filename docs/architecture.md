# Architecture Overview

## Request Lifecycle

1. Request enters /public/index.php
2. Router parses URL
3. Matching route is found
4. Controller is executed
5. View is rendered
6. Response is returned

## Core Components

### Router.php
Responsible for:
- Registering routes
- Matching URLs
- Dispatching controllers

### Controller.php
Base controller that:
- Loads views
- Shares common logic

### Autoloader.php
Automatically loads classes without manual includes

## Design Philosophy

- Keep core minimal
- Separate concerns (MVC)
- Avoid framework bloat
- Build security intentionally, not accidentally
