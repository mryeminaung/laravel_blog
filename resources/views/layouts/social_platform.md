a user -> many comments, many blogs, one category
users
username
email
password
bio
profile_img

a blog -> one user, many comments
blogs
title
slug
intro
body
blog_img
user_id

a comment -> one blog, one user
comments
content
user_id

a category -> many blogs
categories
name

Posts and Comments
enable users to CRUD blogs
leave comments on blogs
implement like system for posts

User Authentication
user registration, login
user profiles
username
bio
profile pictures

Frontend => React
dynamic and responsive UI
implement react router
state management libraries like Redux or Context API

Backend => Laravel
develop a RESTful API, for CRUD operations
for users, blogs, comments
use laravel sanctum for API authentication
implement resource controler to handle data

File and Mail Service
amazon S3 to store photos
mailgun for email functionalities

Search and Filter
search users, posts and comments
filter blogs based on categories or tags
