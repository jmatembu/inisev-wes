# Inisev WES API

WES - Website Email Subscription API, is a test project task by [https://inisev.com](Inisev). In this task I built a simple subscription platform (with only RESTful APIs with MySQL) in which users can subscribe to multiple websites. Whenever a new post is published on a particular website, all it's subscribers then receive an email with the post title and description in it. (no authentication of any kind was required).

The following were the minimum required features of the task:

- [x] Use PHP `7.*` or `8.*` 
- [x] Write migrations for the required tables.
- [x] Endpoint to create a "post" for a "particular website".
- [x] Endpoint to make a user subscribe to a "particular website" with all the tiny validations included in it.
- [x] Use of command to send email to the subscribers.
- [x] Use of queues to schedule sending in background.
- [x] No duplicate stories should get sent to subscribers.
- [x] Deploy the code on a public GitHub repository.

The following were optional features of the task:

- [x] Seeded data of the websites.
- [x] Open API documentation (or) **Postman collection demonstrating available APIs & their usage**.
- Use of contracts & services. _I used Action classes instead_
- [x] Use of caching wherever applicable.
- [x] Use of events/listeners.


### Setup Instructions
Okay there are really no special instructions for setting this up. So! If you are familiar with setting up a basic 
laravel project (`composer install` && `php artisan migrate`) then you can skip this section.

For the rest of us, here we go.

1. Start with cloning this repository by running 
   ```
   git clone git@github.com:jmatembu/inisev-wes.git
   ```
   
2. Change to the downloaded project folder by running 
   ```
   cd inisev-wes
   ```
   
3. Run 
   ```
   composer install
   ```
   
4. The **Inisev WES API** needs a database to work. So! Edit your `.env` file and specify the credentials to your database.
Then run 
   ```
   php artisan migrate --seed
   ```
   This will create the necessary tables and populate the database with demo data.
   

5. Finally, run 
   ```
   php artisan serve
   ``` 
   If you are using Valet, then you can access the project at `http://inisev-wes.test`.
   
### Postman Collection
To see available endpoints and quickly send requests, you will need to import the Postman Collection file available in
the root folder named: `inisev.postman_collection.json`.
