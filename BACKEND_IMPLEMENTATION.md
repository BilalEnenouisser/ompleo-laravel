# Laravel Backend Implementation - OMPLEO Platform

## Overview

This document provides comprehensive documentation for the Laravel backend implementation of the OMPLEO job recruitment platform. The backend includes secure database operations, REST API, role-based access control, and file management with MySQL database.

## Database Schema

### Core Entities

#### 1. Users Table
```sql
- id (Primary Key)
- name (string)
- email (string, unique)
- password (hashed)
- user_type (enum: candidate, recruiter, admin)
- email_verified_at (timestamp)
- created_at, updated_at
```

#### 2. Companies Table
```sql
- id (Primary Key)
- name (string)
- slug (string, unique)
- description (text, nullable)
- logo (string, nullable)
- website (string, nullable)
- size (string, nullable)
- industry (string, nullable)
- location (string, nullable)
- is_active (boolean, default: true)
- created_at, updated_at
```

#### 3. Jobs Table
```sql
- id (Primary Key)
- company_id (Foreign Key -> companies.id)
- recruiter_id (Foreign Key -> users.id)
- title (string)
- slug (string, unique)
- description (text)
- requirements (JSON, nullable)
- benefits (JSON, nullable)
- salary_min (decimal, nullable)
- salary_max (decimal, nullable)
- location (string)
- type (enum: CDI, CDD, Freelance, Stage)
- experience_level (string, nullable)
- tags (JSON, nullable)
- status (enum: draft, published, closed)
- application_deadline (date, nullable)
- created_at, updated_at
```

#### 4. Applications Table
```sql
- id (Primary Key)
- job_id (Foreign Key -> jobs.id)
- candidate_id (Foreign Key -> users.id)
- cover_letter (text, nullable)
- resume_path (string, nullable)
- status (enum: pending, reviewed, shortlisted, rejected, accepted)
- applied_at (timestamp)
- reviewed_at (timestamp, nullable)
- created_at, updated_at
```

#### 5. Candidate Profiles Table
```sql
- id (Primary Key)
- user_id (Foreign Key -> users.id)
- phone (string, nullable)
- address (text, nullable)
- city (string, nullable)
- date_of_birth (date, nullable)
- bio (text, nullable)
- skills (JSON, nullable)
- experience (JSON, nullable)
- education (JSON, nullable)
- resume_path (string, nullable)
- avatar (string, nullable)
- linkedin_url (string, nullable)
- portfolio_url (string, nullable)
- created_at, updated_at
```

#### 6. Recruiter Profiles Table
```sql
- id (Primary Key)
- user_id (Foreign Key -> users.id)
- company_id (Foreign Key -> companies.id)
- position (string, nullable)
- phone (string, nullable)
- created_at, updated_at
```

## Model Relationships

### User Model
```php
// Relationships
hasOne(CandidateProfile::class)
hasOne(RecruiterProfile::class)
hasMany(Application::class, 'candidate_id') // as candidate
hasMany(Job::class, 'recruiter_id') // as recruiter

// Helper methods
isAdmin() -> bool
isRecruiter() -> bool
isCandidate() -> bool
```

### Company Model
```php
// Relationships
hasMany(Job::class)
hasMany(RecruiterProfile::class)
hasManyThrough(Application::class, Job::class)

// Scopes
scopeActive($query)
```

### Job Model
```php
// Relationships
belongsTo(Company::class)
belongsTo(User::class, 'recruiter_id')
hasMany(Application::class)

// Scopes
scopePublished($query)
scopeActive($query)
scopeByLocation($query, $location)
scopeByType($query, $type)
```

### Application Model
```php
// Relationships
belongsTo(Job::class)
belongsTo(User::class, 'candidate_id')

// Scopes
scopePending($query)
scopeReviewed($query)
scopeByStatus($query, $status)

// Methods
markAsReviewed()
updateStatus($status)
```

## Security Implementation

### 1. Middleware

#### CheckUserType Middleware
```php
// Usage: middleware('check.user.type:admin,recruiter')
// Ensures user has specific role(s)
```

#### CheckJobOwnership Middleware
```php
// Ensures user can only access their own jobs
// Admin: access all jobs
// Recruiter: access own jobs only
// Candidate: no access to job management
```

#### CheckApplicationOwnership Middleware
```php
// Ensures proper access to applications
// Admin: access all applications
// Recruiter: access applications for their jobs
// Candidate: access own applications only
```

### 2. Form Request Validation

#### StoreJobRequest
```php
- title: required|string|max:255
- description: required|string|min:50
- company_id: required|exists:companies,id
- location: required|string|max:255
- type: required|in:CDI,CDD,Freelance,Stage
- salary_min: nullable|numeric|min:0
- salary_max: nullable|numeric|min:0|gte:salary_min
- requirements: nullable|array
- benefits: nullable|array
- tags: nullable|array
- application_deadline: nullable|date|after:today
```

#### StoreApplicationRequest
```php
- job_id: required|exists:jobs,id
- cover_letter: nullable|string|max:2000
- resume: required|file|mimes:pdf,doc,docx|max:5120
```

### 3. Authorization Policies

#### JobPolicy
- **viewAny**: Anyone can view jobs list
- **view**: Published jobs (anyone), Draft/Closed (owner/admin)
- **create**: Recruiters and admins only
- **update**: Owner and admin only
- **delete**: Owner and admin only

#### ApplicationPolicy
- **view**: Candidate (own), Recruiter (job's applications), Admin (all)
- **create**: Candidates only
- **update**: Recruiter (job owner), Admin
- **delete**: Admin only

#### CompanyPolicy
- **viewAny**: Anyone
- **view**: Anyone
- **create**: Admin only
- **update**: Admin and company recruiters
- **delete**: Admin only

## API Endpoints

### Public API (No Authentication Required)

#### Jobs
```
GET /api/v1/jobs
- Query parameters: search, location, type, page
- Response: Paginated job list

GET /api/v1/jobs/{slug}
- Response: Single job details
```

#### Companies
```
GET /api/v1/companies
- Query parameters: search, industry, page
- Response: Paginated company list

GET /api/v1/companies/{slug}
- Response: Single company details with jobs
```

### Protected API (Sanctum Authentication Required)

#### Jobs Management
```
POST /api/v1/jobs
- Body: Job creation data
- Authorization: Recruiter/Admin

PUT /api/v1/jobs/{id}
- Body: Job update data
- Authorization: Job owner/Admin

DELETE /api/v1/jobs/{id}
- Authorization: Job owner/Admin
```

#### Applications
```
POST /api/v1/applications
- Body: Application data + resume file
- Authorization: Candidate

GET /api/v1/applications
- Query parameters: status, page
- Authorization: Candidate/Recruiter/Admin

PUT /api/v1/applications/{id}/status
- Body: {status: 'reviewed|shortlisted|rejected|accepted'}
- Authorization: Job owner/Admin
```

#### Profile Management
```
GET /api/v1/profile
- Response: User profile data
- Authorization: Authenticated user

PUT /api/v1/profile
- Body: Profile update data
- Authorization: Profile owner
```

## File Upload System

### File Types and Limits
- **Resumes**: PDF, DOC, DOCX (max 5MB)
- **Avatars**: JPG, PNG (max 2MB)
- **Company Logos**: JPG, PNG (max 2MB)

### Storage Structure
```
storage/app/public/
├── resumes/
│   └── {unique_filename}.pdf
├── avatars/
│   └── {unique_filename}.jpg
└── logos/
    └── {unique_filename}.png
```

### File Upload Service
```php
class FileUploadService
{
    public function uploadResume($file): string
    public function uploadAvatar($file): string
    public function uploadLogo($file): string
    public function deleteFile($path): bool
    public function generateUniqueFilename($originalName): string
}
```

## Environment Configuration

### Database Configuration (.env)
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ompleo
DB_USERNAME=root
DB_PASSWORD=

FILESYSTEM_DISK=public
MAX_FILE_UPLOAD_SIZE=5120

API_RATE_LIMIT=60
```

### Security Settings
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Sanctum Configuration
SANCTUM_STATEFUL_DOMAINS=yourdomain.com
```

## Setup Instructions

### 1. Database Setup
```bash
# Create database
mysql -u root -p
CREATE DATABASE ompleo;

# Run migrations
php artisan migrate

# Run seeders
php artisan db:seed
```

### 2. Storage Setup
```bash
# Create storage link
php artisan storage:link

# Set proper permissions
chmod -R 755 storage/
chmod -R 755 public/storage/
```

### 3. API Authentication Setup
```bash
# Install Sanctum (already included)
composer require laravel/sanctum

# Publish Sanctum configuration
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

## Security Best Practices Implemented

### 1. Authentication & Authorization
- ✅ Sanctum for API authentication
- ✅ Role-based access control (admin, recruiter, candidate)
- ✅ Policies for resource authorization
- ✅ Session management with CSRF protection

### 2. Input Validation
- ✅ Form Request classes for all inputs
- ✅ File upload validation (mime types, size limits)
- ✅ Sanitization of user inputs
- ✅ JSON validation for nested data

### 3. Database Security
- ✅ Parameterized queries (Eloquent ORM)
- ✅ Mass assignment protection (fillable/guarded)
- ✅ Foreign key constraints
- ✅ Soft deletes for sensitive data

### 4. File Upload Security
- ✅ Mime type validation
- ✅ File size restrictions
- ✅ Unique filename generation
- ✅ Storage outside web root

### 5. API Security
- ✅ Rate limiting (60 requests/minute)
- ✅ CORS configuration
- ✅ Token-based authentication
- ✅ Request validation

### 6. General Security
- ✅ HTTPS enforcement (production)
- ✅ CSRF protection
- ✅ XSS prevention
- ✅ SQL injection prevention
- ✅ Environment variable protection

## Sample API Requests

### Authentication
```bash
# Login
POST /api/v1/auth/login
{
    "email": "user@example.com",
    "password": "password"
}

# Response
{
    "token": "1|abc123...",
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "user@example.com",
        "user_type": "candidate"
    }
}
```

### Job Creation
```bash
# Create Job
POST /api/v1/jobs
Authorization: Bearer {token}
{
    "title": "Développeur Full Stack",
    "description": "Description du poste...",
    "company_id": 1,
    "location": "Alger",
    "type": "CDI",
    "salary_min": 80000,
    "salary_max": 120000,
    "requirements": ["React", "Node.js", "MongoDB"],
    "benefits": ["Assurance", "Formation"],
    "tags": ["Frontend", "Backend", "Full Stack"]
}
```

### Application Submission
```bash
# Submit Application
POST /api/v1/applications
Authorization: Bearer {token}
Content-Type: multipart/form-data

{
    "job_id": 1,
    "cover_letter": "Lettre de motivation...",
    "resume": [file]
}
```

## Testing Strategy

### Unit Tests
- Model relationships and scopes
- File upload service
- Authentication helpers

### Feature Tests
- Controller actions
- API endpoints
- File upload functionality
- Authorization policies

### API Tests
- Authentication flow
- CRUD operations
- Error handling
- Rate limiting

## Performance Considerations

### Database Optimization
- Indexes on frequently queried columns
- Eager loading for relationships
- Query optimization with scopes

### File Storage
- Local storage for development
- Cloud storage (S3) for production
- CDN integration for static assets

### Caching Strategy
- Redis for session storage
- Query result caching
- API response caching

## Monitoring and Logging

### Application Logs
- Authentication attempts
- File uploads
- API requests
- Error tracking

### Security Monitoring
- Failed login attempts
- Suspicious file uploads
- Rate limit violations
- Unauthorized access attempts

## Deployment Checklist

### Production Environment
- [ ] Database configuration
- [ ] Storage permissions
- [ ] SSL certificate
- [ ] Environment variables
- [ ] API rate limiting
- [ ] File upload limits
- [ ] CORS configuration
- [ ] Security headers

### Backup Strategy
- [ ] Database backups
- [ ] File storage backups
- [ ] Configuration backups
- [ ] Automated backup schedule

---

**Last Updated**: October 2025
**Version**: 1.0
**Status**: Implementation Complete
