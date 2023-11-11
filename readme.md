  

#  Welcome to Titan!


To get started, git clone the Titan project, making sure the .htaccess file is in your project.


With the base project of titan, there will be 3 pages, Home, About, Contact which are in the views folder, and are routed in the routes.php file. All the routing will happen in routes.php.

  
Titan comes with a lot of functions which simplifies writing PHP. All the base code lives in titan.php and can be modified to your liking.


#  Getting started

  

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

		Title("Home Page");
		
	?>


We are bringing in the header & titan PHP file. We can use Titan functions by calling Titan::

  
#  Routing

  
To use routing in titan, head over to routes.php, and in the routes array, we can set what path we want our PHP file to run. E.G. the home path - "/" will run our home.php file in the views folder.

	Route::get('/', 'views/Home/home.php');
	Route::get('/about', 'views/About/about.php');
	Route::get('/contact', 'views/Contact/contact.php');

NOTE:

"views/" does not have to be added in the argument as the get function will check for both. The following example will also work.

	Route::path('/', 'Home/home.php');
	Route::path('/about', 'About/about.php');
	Route::path('/contact', 'Contact/contact.php');

  
We can also call functions from our controllers folder. Here we are using the get function. We are then calling the view function to use our home.php file in the views folder.

// Routes
  
	Route::get("/", function() {
		view("Home/home.php");
	});


// .php extension does not need to be added. Below will also work


	Route::get("/", function() {
		view("Home/home");
	});

  
Alternatively we can call our index function in our Home controller. In the index function we are also calling the view function to display the home.php file which is in the views folder.

	Route::get("/", function() {
		Home::index();
	});

  
// HomeController.php in controllers folder

	<?php

	require_once './titan.php';
	require_once './view-loader.php';

	class Home {
		static function index() {
			view("Home/home.php");
		}
	}


We can also use the post method on the Route class when a post request is made to the home path.

	Route::post("/", function() {
		echo "Hello World";
	});

#  Route Request Methods

  
	Route::get("/", function() {
		echo "GET Request";
	});

	Route::post("/", function() {
		echo "POST Request";
	});

	Route::put("/", function() {
		echo "PUT Request";
	});

	Route::patch("/", function() {
		echo "PATCH Request";
	});

	Route::delete("/", function() {
		echo "DELETE Request";
	});


#  Status codes

To set status codes we can use the following methods.


	Status200(); // Set OK
	Status301(); // Set permanent redirect
	Status302(); // Set temporary redirect
	Status400(); // Set bad request
	Status401(); // Set unauthorized Error
	Status403(); // Set forbidden
	Status404(); // Set not found
	Status500(); // Set internal server error

Or a custom Status can be called using Status($status_code, $message) - E.G.

	Status(404, 'Custom 404');


#  Title
  
To change the title of our web page, inside your PHP file call the title function and pass in the title as a string.

	Title("Home Page");

 
#  Post Value

To get the post value we can use the PostValue() function. The function is wrapped inside mysql_real_escape_string function.

  
	$email = PostValue("email"); // $_POST["email"];
	$password = PostValue("password"); // $_POST["password"];
  

#  Titan Database Functions


**Select**


To get data from our database, we can use the select function, our below statement gets all the data from our persons table.

We first create an instance of the Titan class

	$db = new Titan();

	$db->select("*")->from("Person")->get();
  
 
 If we want specific values we can pass in the table fields instead E.G.

	  $db->select("first_name, last_name")->from("Person")->get();
  
If we are retrieving date we add on the ->get() at the end of our statement


**All**

If we are getting all the data from a table, use the all method, passing in the table

	$db->all("Person")->get();


**Stored Procedure**
If we have a stored procedure which gets all the data from Person table, we can call the stored procedure like so. NOTE - you do not need ->get() at the end of the statement

	$db->stored_proc('GetAllPersons()');
  

#  Web Request Functions


In Titan, there are a few functions to check what sort of request is happening - GET, POST, PUT, DELETE & PATCH.

If we want to check what the request is, we can write:


	if(GetRequest()) {
		echo "Get Request";
	}

	if(PostRequest()) {
		echo "Post Request";
	}

	if(PutRequest()) {
		echo "Put Request";
	}

	if(DeleteRequest()) {
		echo "Delete Request";
	}

	if(PatchRequest()) {
		echo "Patch Request";
	}
  

#  JSON Functions


**JSONShow**


If we want to output JSON, for example our person table, we can query our table, then output the result in a JSON format.


	$db->all("Person")->get();

	if($person_data) {
		JSONShow($person_data);
	}


Here we are getting all the data from our person table, checking if there is data then outputting the data in a JSON format.

  

**GetJSON**

  

If we wanted to get JSON data from a server, we can use the GetJSON function. I will be using the json placeholder API as an example. - https://jsonplaceholder.typicode.com

  
	$api_todos = GetJSON("https://jsonplaceholder.typicode.com/todos");
 
	if($api_todos) {
		foreach($api_todos as $todo) {
			echo $todo["title"];
			echo $todo["completed"];
		}
	}


#  Query String Function

  

**QueryString**

  

To grab a query string from our url, we can use the QueryString function.


Lets say we have a server on **http://localhost/API/person**

As an example we want to get the id of a specific person in our table.

  
**http://localhost/API/person?id=1**

  
	$personID = QueryString("id");

  

This will give us the value of 1. We can then do additional logic like selecting data where the id = 1.


#  Redirect Function


**Redirect**


To easily redirect to a URL, we can call the redirect function.

	Redirect("https://www.youtube.com/");


This will redirect the page to YouTube


#  Email Function

 
**ValidEmail**

  

To check whether an email is valid, we can use the ValidEmail function.

	if(ValidEmail("john.doe@mail.com")) {
		echo "Is valid email address";
	}

#  Cookie Function

 

**GetCookie**

To get the cookie, we will use the GetCookie function.


	$cookie = GetCookie("my_cookie");
