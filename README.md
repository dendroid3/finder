# FINDER CONTRIBUTION GUIDE
## PROJECT DESIGN
The project is styled using an MVC architecture [Read Here](https://www.geeksforgeeks.org/system-design/mvc-architecture-system-design/) heavily inspired Laravel [Read Here](https://laravel.com/)
Think of this system as five portfolio building systems combined into one. The main separation is in the UI (views).
Ideally, each member should have created all the pages required by the user allowing them to pick the design they like.

## PROJECT STRUCTURE

### Entry File
The App's entry point is public/index.php
    This file requires the app\App.php file which acts as the .htaccess file in apache servers or config files in nginx, it directs traffic the the right php file.
    The public/index.php file also requires the routes/web.php which maps the requested url to the proper controller function.

### Controllers Directory
This directory contains the controllers. Controllers are where we put the app's CRUD functions.
Each controller should have only FOUR public functions (store/create, view/read, update, delete), any additional function should be private.
We are 5, we have 5 sections on our portfolio, each member will get one section to write the CRUD functions for that.
The five sections are:
    1. Authentication & Links -> Wanjohi
    2. About -> Alfred
    3. Services -> Eric
    4. References -> Ryan
    5. Contacts -> Victor

### Views Directory
This directory has the pages that the user will see.
In the directory we have 
    #### layouts directory
        This directory contains the, guess... LAYOUTS!
        In this directory, each member should create the following .php pages in their respective directories:
            - register.php -> the form's action should be '/register'
            - login.php -> the form's action should be '/login'
    #### templates directory
        This directory contains the templates that we already created. 
        Just add your file to your respective directory.
        I have already created the directories already.
        1 -> Alfred
        2 -> Eric
        3 -> Denis
        4 -> Ryan
        5 -> Victor

## WHAT TO DO:
A. 
1. Fork the repository (star it first here just cause you were raised right!)
2. Clone the repo to your local machine in the folder 'xampp/htdocs', we agreed we were all using xampp, no?
3. Go to the file 'database/run_migrations.php' and change the values of 'database_user' and 'database_password' to your local mysql-server values
4. On your database (On the xampp GUI, click admin on the mysql row after both the web and db servers are ON) create a table named 'finder'
5. Run the run_migration.php file, on the project's base directory run 'php database/run_migrations.php'
6. Navigate to the project on your browser 
NOW THE PROJECT RUNS, WHAT NOW?

B. 
1. Create a new branch named the number assigned to you, so Alfred you'll name yours 1, Eric name yours 2, and so on.
2. Go to 'views/templates/your_number' and dump your code for your portfolio there.
3. Commit, push and create a pull request. I will merge your request but only if you don't push to the master branch so step one is critical.

C.
1. Go to 'views/layouts/your_number' and dump your register.php and login.php there.
2. Commit, push, create pull request.

### Then What?
In our next presentation on Monday, I will only talk about the structure of our project and the way we each have and plan to contribute to the project.
Hopefully, we will all have done what we have been assigned to do here so that the next order of business then becomes:
1. Normalizing the db - I will do that and share my process with you.
2. Writing the CRUD for each of the sections as assigned i.e writing the controllers
3. Writing the JS to call those endpoints - We'll be accessing the CRUD's written using an API model so that we can justify it as "This way it is possible for someone to use our backend on their own custom design portfolios.
4. On the final week, we'll just be putting the pieces together, we'll do this when physically together ndio tulemewe pamoja.

# MERRY CHRISTMAS AND A HAPPY NEW YEAR FRIENDS!!