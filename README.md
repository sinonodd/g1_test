<img width="1398" alt="image" src="https://github.com/user-attachments/assets/881aec11-26d3-4495-95c8-a2dfb401db9d" />
<img width="1400" alt="image" src="https://github.com/user-attachments/assets/5e683337-8be5-4411-b954-a17ea45ae672" />







## Overview
This project is built using **Laravel** and **Vue.js** to create a robust system for managing `chantiers` (projects). It features user authentication, dynamic progress tracking, and comprehensive testing with **Pest PHP**.

## Features Checklist

- [x] **Project Setup:**
  - Installed Laravel framework.
  - Integrated Vue.js for frontend development.

- [x] **Authentication:**
  - Developed login functionality for both frontend and backend.

- [x] **Chantiers Management:**
  - Implemented listing of `chantiers`.
  - Enabled dynamic updates to chantier columns.
  - Automatically calculates progress values (`preparation_avancement`, `closure_avancement`, `global_avancement`) based on column updates.

- [x] **Dynamic Progress Tracking:**
  - Progress is dynamically updated as chantier columns are modified.

- [x] **Testing:**
  - Wrote comprehensive tests using **Pest PHP** for:
    - Listing chantiers.
    - Updating chantier columns.

## Project Structure

### Backend
- **Framework:** Laravel
- **API Routes:** Defined in `routes/api.php`.
- **Database:** Utilizes migrations and seeders for structure and initial data population.

### Frontend
- **Framework:** Vue.js
- **Styling:** Tailwind CSS for responsive and modern design.
- **Dynamic Components:** Built tables with grouped headers and dynamic select inputs.

## How to Set Up

1. **Clone the Repository:**
   ```bash
   git clone <repository-url>
   cd <repository-folder>
   ```

2. **Install Dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup:**
   Copy the `.env.example` file to `.env` and configure the database and other environment variables.

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Run Migrations and Seeders:**
   ```bash
   php artisan migrate --seed
   ```

5. **Start Development Servers:**
   - Backend:
     ```bash
     php artisan serve
     ```
   - Frontend:
     ```bash
     npm run dev
     ```

## Testing
To run tests, use the following command:
```bash
php artisan test
```

Tests include:
- API endpoint tests for `chantiers`.
- Dynamic progress calculation validation.

## Future Improvements
- Add detailed error handling.
- Implement user roles and permissions.
- Enhance UI/UX for chantier management.

## Contributing
Feel free to submit issues or pull requests to improve the project further!

