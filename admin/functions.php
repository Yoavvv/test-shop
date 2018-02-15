<?php

// Redirect function   
function redirect($location) {

    return header("Location:" . $location);
}

// Prevent MYSQL Injection function
function escape($string) {

    global $connection;

    return mysqli_real_escape_string($connection, trim($string));
}


// Confirm query before request function
function confirmQuery($result) {

    global $connection;

      if(!$result) {

        die("QUERY FAILED . " . mysqli_error($connection));

    }

}

// Add categories function
function insertCategories() {

    global $connection;

     if(isset($_POST['submit'])) {

        $category_title = $_POST['category_title'];

        if($category_title == "" || empty($category_title)) {
            echo "This field should not be empty!!";
        } else {

            $query = "INSERT INTO categories(category_title) ";
            $query .= "VALUE('{$category_title}') ";

            $createCategoryQuery = mysqli_query($connection, $query);

            if(!$createCategoryQuery) {
                die('QUERY FAILED!! ' . mysqli_error($connection));
            }
        }
    }   
}

// Get, Read all categories function
function findAllCategories() {

    global $connection;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_categories)) {
        $category_id = $row['category_id'];
        $category_title = $row['category_title'];

        echo "<tr>";
        echo "<td>{$category_id}</td>";
        echo "<td>{$category_title}</td>";
        
        echo "<td><a rel='$category_id' href='javascript:void(0)' class='delete_link btn btn-danger'>Delete</a></td>";
        
        echo "<td><a class='btn btn-primary' href='categories.php?edit={$category_id}'>Edit</a></td>";
        echo "</tr>";   
    }
}

// Delete category function
function deleteCategories() {

    global $connection;

     if(isset($_GET['delete'])) {
        $categoryToDelete = $_GET['delete'];
        $query = "DELETE FROM categories WHERE category_id = {$categoryToDelete} ";
        $deleteQuery = mysqli_query($connection, $query);
        header("Location: categories.php");
    } 
}


// dynamic table count function
function recordCount($table) {

    global $connection;

    $query = "SELECT * FROM " . $table ;
    $select_all_courses = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select_all_courses);

    if(!$result == 0){

        confirmQuery($result);

    }

    return $result;

}

// Student count function
function studentsCount() {

    global $connection;

    $query = "SELECT * FROM users WHERE user_role  = 'student' ";
    $select_all_users = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select_all_users);

    if(!$result == 0){

        confirmQuery($result);

    }

    return $result;

}

// Manager count function
function managersCount() {

    global $connection;

    $query = "SELECT * FROM users WHERE user_role  = 'manager' ";
    $select_all_users = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select_all_users);

    if(!$result == 0){

        confirmQuery($result);

    }

    return $result;

}

// Check for email existance in DB function
function email_exist($email) {

global $connection;

$query = "SELECT user_email FROM users WHERE user_email = '$email' ";
$result = mysqli_query($connection, $query);
confirmQuery($result);

if(mysqli_num_rows($result) > 0) {

    return true;

} else {

    return false;
}

}

// Register user in DB function
function register_user($email, $password) {

    global $connection;

    $email    = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);


    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

    $query = "INSERT INTO users (user_email, user_password, user_role) ";
    $query .= "VALUES('{$email}', '{$password}', 'student') ";
    $register_user_query = mysqli_query($connection, $query);

    confirmQuery($register_user_query);
}

// Login user to DB & SESSION function
function login_user($email, $password) {

    global $connection;

    $email = trim($email);
    $password = trim($password);

    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE user_email = '{$email}' ";
    $select_user_query = mysqli_query($connection, $query);
    if(!$select_user_query) {

        die("QUERY FAILED . " . mysqli_error($connection));
    }

    while($row = mysqli_fetch_array($select_user_query)) {

        $db_user_id = $row['user_id'];
        $db_user_email = $row['user_email'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
        $db_user_phone = $row['user_phone'];
        $db_user_image = $row['user_image'];
    }

    if(password_verify($password, $db_user_password)) {

        $_SESSION['email'] = $db_user_email;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        $_SESSION['user_phone'] = $db_user_phone;
        $_SESSION['user_image'] = $db_user_image;

        redirect("/cms/admin"); 

    } else {

        redirect("/cms/index.php"); 
    }
}

?>