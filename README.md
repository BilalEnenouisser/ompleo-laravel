# OMPLEO - Job Recruitment Platform

OMPLEO is a comprehensive job recruitment platform built with Laravel, designed to connect candidates with recruiters and streamline the hiring process.

## Features

### For Candidates
- **Profile Management**: Complete profile with skills, experience, education, and languages
- **Job Search**: Browse and filter job opportunities
- **Application Tracking**: Track application status and manage applications
- **Interview Management**: View interview details, including date, time, location, and meeting links
- **Rich Notifications**: Receive styled notifications with images and formatted content
- **Profile Completion**: Track profile completion percentage with visual indicators

### For Recruiters
- **Candidate Search**: Advanced search and filter candidates by skills, location, experience
- **Interview Scheduling**: Schedule and manage interviews with calendar view
- **Application Management**: Review and manage candidate applications
- **Company Profile**: Manage company information and branding
- **Reports & Analytics**: View statistics and reports on job postings and candidates
- **Notification System**: Send rich content notifications to candidates

### For Administrators
- **User Management**: Manage candidates, recruiters, and admin users
- **Company Management**: View and manage all companies on the platform
- **Notification Management**: Create and send rich content notifications with visual editor
- **Payment Tracking**: Monitor subscription payments and transactions
- **Blog Management**: Create and manage blog posts
- **System Dashboard**: Overview of platform statistics and activities

## Technologies

- **Backend**: Laravel (PHP)
- **Frontend**: Blade Templates, Tailwind CSS
- **JavaScript**: Vanilla JS, FullCalendar.js
- **Database**: MySQL/PostgreSQL
- **Storage**: Laravel File Storage

## Installation

1. **Clone the repository**
```bash
git clone <repository-url>
cd ompleo-laravel
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure database**
Edit `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ompleo
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. **Run migrations**
```bash
php artisan migrate
php artisan db:seed
```

6. **Build assets**
```bash
npm run build
# Or for development:
npm run dev
```

7. **Start the server**
```bash
php artisan serve
```

Visit `http://127.0.0.1:8000` in your browser.

## Key Features Implemented

### Mobile Responsiveness
- Fully responsive design across all dashboard pages
- Mobile-optimized filters and tables with horizontal scrolling
- Adaptive layouts for candidate, recruiter, and admin views

### Notification System
- Rich content notifications with images, styled text, buttons, and icons
- Visual notification editor with canvas-based preview
- Interview details displayed in notifications
- Real-time notification badge updates

### Profile Management
- Dynamic profile completion tracking
- Section-based profile editing
- Skills, experience, education, and languages management

### Interview Management
- Calendar view with FullCalendar.js integration
- Custom-styled calendar with status-based colors
- Interview details with notification read status
- Mobile-responsive calendar interface

## User Roles

- **Candidate**: Job seekers who can apply to positions and manage their profiles
- **Recruiter**: Companies/HR who post jobs and manage candidates
- **Admin**: Platform administrators with full system access

## Routes

Key routes include:
- `/candidate/dashboard` - Candidate dashboard
- `/recruiter/dashboard` - Recruiter dashboard
- `/admin/dashboard` - Admin dashboard
- `/candidate/profile` - Profile management
- `/recruiter/candidates` - Candidate search
- `/recruiter/interviews` - Interview management
- `/admin/notifications` - Notification management

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
