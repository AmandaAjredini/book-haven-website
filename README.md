# Amanda's Book Haven
A dynamic library web application where users can search &amp; reserve books.

The aim of this project is to develop a book reservation web site using PHP and MySQL database. The application will allow users to search for and reserve library books. Specifically, the application will enable the following:

# Requirements
Login - The user must identify themselves to the system in order to use the system and throughout the whole site. If they have not previously used the system, they must register their details.

Registration - This allows a user to enter their details on the system. The registration process validates that all details are entered. Mobile phone numbers should be numeric and 10 characters in length. Password should be six characters and have a password confirmation function. The system ensures that each user can be identified using a unique username.

Search for a book: The system allows the user to search in a number of ways:

- by book title and/or author (including partial search on both)
- by book category description in a dropdown menu (book category should retrieved from database
The results of the search displays as a list from which the user can then reserve a book if available. If the book is already reserved, the user is not allowed to reserve the book.

Reserve a book – The system allows a user to reserve a book provided that no-one else has reserved the book yet. The reservation functionality will capture the date on which the reservation was made.

View reserved books – the system allows the user to see a list of the book(s) currently reserved by that user. User should be able to remove the reservation as well

Maximum 5 results per page when displaying search results or reservation results (pagination).

CSS is used to make the web pages look more presentable and user-friendly.

# Instructions
This project was created using XAMMP 8.2.12-0

Download this repository into XAMMP/htdocs

Run XAMMP and start MySQL Database and Apache Web Server

On web browser go to address http://localhost/CA/index.php
