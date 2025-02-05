# Blogging System

## Introduction

This is a Laravel-based blogging system that allows users to create, edit, and manage blog posts. It includes authentication, comments, user interactions, and additional features such as post likes, dark mode, and user profiles.

## Features

### 1. Home Page

- Displays a list of all blog posts with pagination.
- Users can browse through published posts.
  
![image](https://github.com/user-attachments/assets/43de17f9-5f9e-4e80-aa20-592d3f588924)


### 2. Post Management

- Authenticated users can create, edit, update, and delete posts.
- Users can only manage their own posts.
  
![image](https://github.com/user-attachments/assets/42084353-83ff-4e11-abc7-39120f8be984)


### 3. Post Details

- View individual blog posts with author information.
- Displays formatted timestamps.
- Shows post views and interactions.

### 4. Authentication

- Uses Laravel UI for user login and registration.
- Ensures secure access to post management features.

### 5. Database Integration

- Stores blog posts using Laravel migrations.

### 6. Validation on Store & Update

- Title & description fields are required.
- Title must be unique and at least 3 characters long.
- Description must be at least 10 characters long.
- Ensures updating a post without changing the title still works.
- Displays error messages for failed validation attempts.

![image](https://github.com/user-attachments/assets/9afa5492-8c3d-4b66-aa2c-f5f31cb77fb4)


### 7. Formatting

- The "Created At" field is formatted using [Carbon](https://carbon.nesbot.com/docs/).

### 8. Seeding

- Uses PostSeeder & PostFactory to generate 500 posts.
- Run seeding via `php artisan db:seed`.

### 9. Pagination

- The Index page includes pagination with navigation links.
![image](https://github.com/user-attachments/assets/be319674-b820-4085-81ee-495e5705bd52)


### 10. Comments Section

- Authenticated users can comment on posts.

### 11. User Profiles & Avatars

- Each user has a profile page displaying their information and profile picture
- Users can upload an avatar.

### 12. Interactions

- Users can only view "read", comment on, like, and dislike posts.
- Users can manage their own posts "CRUD". they can Create, view, delete, edit, update, like and comment on their posts.

### 13. Post View Count & Likes

- Tracks and stores post Like counts.
- Users can like or dislike posts.

### 14. Dark Mode

- Includes a dark mode option for user convenience.

## Installation Guide

### 1. Clone the Repository

```bash
git clone https://github.com/Karim-Zeyada/Blogging-system.git
cd Blogging-system
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Configure Environment

- Copy the `.env.example` file to `.env` and update database credentials.

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Run Migrations & Seeding

```bash
php artisan migrate --seed
```

### 5. Serve the Application

```bash
php artisan serve
```

Visit `http://127.0.0.1:8000` to access the application.

## Contributing

Feel free to fork this repository and submit pull requests.


