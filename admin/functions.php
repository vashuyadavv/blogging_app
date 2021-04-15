<?php 

    function escape($string){
        global $con;
        $con->real_escape_string(trim($string));
    }

    function users_online(){

        if (isset($_GET['onlineusers'])) {       
            global $con;
                if (!$con) {
                    session_start();
                    include"../includes/config.php";        
                    // ini_set('display_errors', '1');
                    // ini_set('display_startup_errors', '1');
                    // error_reporting(E_ALL);
                    
                    $session=session_id();
                    //echo"$session";
                    //die();
                    $time=time();
                    $time_out_in_seconds=03;

                    $time_out= $time - $time_out_in_seconds;
                    $sql="SELECT * FROM users_online WHERE session = '$session'";
                    $send_query=$con->query($sql);
                    $count=$send_query->num_rows;

                    if ($count == NULL || $count == 0) {
                        $insert_query=$con->query("INSERT INTO users_online(session, time) VALUES('$session', '$time') ");
                    }else{
                        $update_query=$con->query("UPDATE users_online SET time = '$time' WHERE session = '$session' ");
                    }

                    $users_online_query=$con->query("SELECT * FROM users_online WHERE time > '$time_out' ");
                    //print_r($users_online_query);
                    echo $count_user=$users_online_query->num_rows;
                    //var_dump($count_user);
                } 
        } //get request isset
    }
    users_online();
    function confirmQuery($result) {
        global $con;
        if (!$result) {
			die("Query FAILED" . $con->error);
		}
    }
	function insert_categories() {
		global $con;
        if(isset($_POST["cat_title"])) {
            $cat_title = $_POST["cat_title"];
            if ($cat_title == "" || empty($cat_title)) {
                echo"This field should not be empty";
            }else{
                $sql = "INSERT INTO categories(cat_title) VALUES('$cat_title')";
                $create_category_query = $con->query($sql);
                if (!$create_category_query) {
                    die("Query FAILED" . $con->error);
                }
            }
        }
	}

    function findAllCategories() {
        global $con;
        $sql = "SELECT * FROM categories";
            $select_categories_query = $con->query($sql);

        while ($row = $select_categories_query->fetch_assoc()) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo"<tr>";
            echo "<td>{$cat_id}</td>";
            echo "<td>{$cat_title}</td>";
            echo "<td><a href = 'categories.php?delete={$cat_id}'>Delete</a></td>";
            echo "<td><a href = 'categories.php?update={$cat_id}'>Update</a></td>";
            echo "</tr>";
        }
    }

    function delete_categories(){
        global $con;
        if (isset($_GET['delete'])) {
            $cat_delete_id=$_GET['delete'];
            $sql = "DELETE FROM categories WHERE cat_id = {$cat_delete_id}";
            $delete_query=$con->query($sql);
            header("Location: categories.php");
        }
    }
?>