# Blogging System

## Introduction

This is a Laravel-based blogging system that allows users to create, edit, and manage blog posts. It includes authentication, comments, user interactions, and additional features such as post likes, dark mode, and user profiles.

## Features

### 1. Home Page

- Displays a list of all blog posts with pagination.
- Users can browse through published posts.
  ![home page](https://github.com/user-attachments/assets/4dcb4ec2-2c75-4b15-a77b-af7dbc7b1861)


### 2. Post Management

- Authenticated users can create, edit, update, and delete posts.
- Users can only manage their own posts.
  ![crud](https://github.com/user-attachments/assets/6bb25102-ddee-4393-abde-ff1a62bfaa6f)


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
  ![Screenshot (65)](https://github.com/user-attachments/assets/1176da0d-e18c-473a-8b20-82930bdca957)


### 7. Formatting

- The "Created At" field is formatted using [Carbon](https://carbon.nesbot.com/docs/).

### 8. Seeding

- Uses `PostSeeder` & `PostFactory` to generate 500 posts.
- Run seeding via `php artisan db:seed`.

### 9. Pagination

- The index page includes pagination with navigation links.
  ![image](https://github.com/user-attachments/assets/ae7daf3c-bd30-4d2a-8525-ea68849ef0e1)


### 10. Comments Section

- Authenticated users can comment on posts.

### 11. User Profiles & Avatars

- Each user has a profile page displaying their information and profile picture.
- Users can upload an avatar.
  ![image](https://github.com/user-attachments/assets/9821020e-cd8c-4c9f-9336-62b22f4b608a)


### 12. Interactions

- Users can read, comment on, like, and dislike posts.
- Users can manage their own posts (Create, Read, Update, Delete, Like, and Comment).

### 13. Post View Count & Likes

- Tracks and stores post like counts.
- Users can like or dislike posts.

### 14. Dark Mode

- Includes a dark mode option for user convenience.

## Demo

A video demo of the project will be available to showcase its features and functionality. [Watch the demo here](https://youtu.be/XEQxElapRo8)

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

