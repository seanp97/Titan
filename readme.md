
# Welcome to Titan!

To get started, git clone the Titan project, making sure the .htaccess file is in your project.

With the base project of titan, there will be 3 pages, Home, About, Contact which are in the views folder, and are routed in the routes.php file. All the routing will happen in routes.php.

Titan comes with a lot of functions which simplifies writing PHP. All the base code lives in titan.php and can be modified to your liking.

# Getting started

Titan uses MYSQL as the database choice. To get started, head over to the titan.php file and within the constructor, change the database connection settings. These will be aligned to your database. After the connection settings have changed, you will be already connected!

    static function Connect() {
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db = '';

        $mysqli = new mysqli($host, $user, $pass, $db);

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        return $mysqli;
    }


The 3 PHP files in the views folder are just boilerplate files, these files can be renamed and rerouted to any URL.
Within home.php inside the views folder, we have some PHP code at the top of the file.

	<?php 
	    require 'header.php';
	    require './titan.php';
	    Titan::Title("Home Page");
	?>

We are bringing in the header & titan PHP file. We can use Titan functions by calling Titan::


# Titan Routing

To use routing in titan, head over to routes.php, and in the routes array, we can set what path we want our PHP file to run. E.G. the home path - "/" will run our home.php file in the views folder.

	Router::get('/', 'views/home.php');
	Router::get('/about', 'views/about.php');
	Router::get('/contact', 'views/contact.php');

NOTE: 

"views/" does not have to be added in as the get function will check for both. The following example will also work.

	Router::get('/', 'home.php');
	Router::get('/about', 'about.php');
	Router::get('/contact', 'contact.php');

    
# Titan Title

To change the title of our web page, inside your PHP file call the title function and pass in the title as a string.

	Titan::Title("Home Page");

# Titan Database Functions

**Select**

To get data from our database, we can use the select function, our below statement gets all the data from our persons table.

	Titan::Select("SELECT * FROM person_table");

We can assign this to a variable.

	$person_data = Titan::Select("SELECT * FROM person_table");
	
**Outputting the data**

Now we can check if there is data and then do logic based on the outcome.

	if($person_data) {
	    echo "There is person data";
	}
	else {
	    echo "No person data exists";
	}


**As an example, if our person table had first_name & last_name column. We can then for loop over our data and output the result onto the page.**

	if($person_data) {
	    foreach($person_data as $person) {
		echo $person["first_name"] . " " . $person["last_name"];
	    }
	}
	else {
	    echo "No person data exists";
	}


**GetAll**

	$person_data = Titan::GetAll("person_table");

This will get all the columns from the table, the table being the passed in argument.


**SQL**

In the SQL function, we can write an SQL query which will not return any data. E.G. we wanted to drop, insert, update ETC...

	Titan::SQL("DROP  TABLE  person_table");


**InsertInto**

The insert function will insert into a table, with the column names and values passed in.

	Titan::InsertInto("person_table", "first_name, last_name", "'John', 'Doe'");


# Titan Web Request Functions

In Titan, there are a few functions to check what sort of request is happening - GET, POST, PUT, DELETE & PATCH.

If we want to check what the request is, we can write:

	if(Titan::GetRequest()) {
	    echo "Get Request";
	}
	
	if(Titan::PostRequest()) {
	    echo "Post Request";
	}
	
	if(Titan::PutRequest()) {
	    echo "Put Request";
	}
	
	if(Titan::DeleteRequest()) {
	    echo "Delete Request";
	}
	
	if(Titan::PatchRequest()) {
	    echo "Patch Request";
	}


# Titan JSON Functions

**JSONShow**

If we want to output JSON, for example our person table, we can query our table, then output the result in a JSON format.


	$person_data = Titan::GetAll("person_table");
	
	if($person_data) {
	    Titan::JSONShow($person_data);
	}

Here we are getting all the data from our person table, checking if there is data then outputting the data in a JSON format.


**GetJSON**

If we wanted to get JSON data from a server, we can use the GetJSON function. I will be using the json placeholder API as an example. - https://jsonplaceholder.typicode.com

	$api_todos = Titan::GetJSON("https://jsonplaceholder.typicode.com/todos");

	if($api_todos) {
	    foreach($api_todos as $todo) {
	        echo $todo["title"];
	        echo $todo["completed"];
	    }
	}


# Titan Query String Function

**QueryString**

To grab a query string from our url, we can use the QueryString function.

Lets say we have a server on **http://localhost/API/person**

As an example we want to get the id of a specific person in our table.

 **http://localhost/API/person?id=1**

	$personID = Titan::QueryString("id");

This will give us the value of 1. We can then do additional logic like selecting data where the id = 1.


# Titan Redirect Function

**Redirect**

To easily redirect to a URL, we can call the redirect function.

	Titan::Redirect("https://www.youtube.com/");

This will redirect the page to YouTube


# Titan Email Function

**ValidEmail**

To check whether an email is valid, we can use the ValidEmail function.

	if(Titan::ValidEmail("john.doe@mail.com")) {
	    echo "Is valid email address";
	}
	else {
	    echo "Invalid email address";
	}


# Titan Cookie Function

**GetCookie**

To get the cookie, we will use the GetCookie function.

	$cookie = Titan::GetCookie("my_cookie");


# Titan Submit

**IsSubmit**

To check whether isset($_POST['submit']).

	if(Titan::IsSubmit()) {
	    echo "Is submission";
	}
	else {
	    echo "No submission";
	}



# Titan File Upload

**FileUpload**

home.php in views folder

	<form action="./controllers/upload.php" method="POST" enctype="multipart/form-data">
	  Select image to upload:
	  <input type="file" name="fileToUpload" />
	  <input type="submit" value="Upload Image" name="submit" />
	</form>
	

upload.php file in controllers folder

	if(Titan::IsSubmit()) {
	    $uploadStatus = Titan::FileUpload("fileToUpload", array("jpg", "jpeg"), 100);
	    echo $uploadStatus;
	}

Here we are getting the uploaded image file value which we pass in as the first argument. Second argument is the accepted file types as an array. The last argument is the file size in MB - (100MB) in the example.

If successful, the function will return the filename and extension.

**Please note**

The folder will need permission to upload files. Open terminal in the uploads file and run "sudo chmod -R 777 ."

php.ini will also need editing on localhost:

post_max_size=200M - 200MB
upload_max_filesize=200M - 200MB
