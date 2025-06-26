# BNMExercises
# Branch Structure

This repository is organized into three main branches, each serving a specific purpose during the development process:

# master
- **Focus:** Basic HTML/CSS and Laravel backend setup.
- **Description:** This is the foundational branch containing the plain HTML/CSS layout for login, logout, and dashboard pages. It also includes the Laravel backend setup (routes, controllers, and API integration) without any Bootstrap styling or advanced UI enhancements.

# main
- **Focus:** UI enhancement using Bootstrap.
- **Description:** This branch builds on top of the `master` branch and applies **Bootstrap 5** styling to the login, logout, and dashboard pages. It's focused on improving the user interface while maintaining the core backend functionalities.

# hotels
- **Focus:** Hotel Management System (CRUD)
- **Description:** This branch implements a full **Hotel CRUD system** on top of the Bootstrap-styled dashboard. Features include:
  - Add, Edit, View, and Delete hotel entries
  - Display hotels using responsive **hotel cards**
  - **Pagination** to manage hotel listings
---
> 💡 **Tip:** You can switch between these branches using:
> ```bash
> git checkout branch-name
> ```
Each branch represents a progressive step in the project development, from layout → styling → advanced features.
