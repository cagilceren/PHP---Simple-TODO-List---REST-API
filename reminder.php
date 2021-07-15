<?php
include_once 'connection.php';
/**
 * This is a reminder REST API service which can get, update and delete the user's TODO list.
 * User Stories:
 *      1) The user can add a new reminder.
 *      2) The user can delete an existing reminder.
 *      3) The user can update an existing reminder.
 *      4) The user can list the existing reminders.
 */


try {
    header('Content-Type: application/json');
    $pathInfo = $_SERVER['PATH_INFO'];
    $id = str_replace('/','',$pathInfo);
    if (isset($id) && $id!='' && is_numeric($id) != TRUE)
        throw new Exception("The ID of the desired reminder should be given as an integer");    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        post();
    }
    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        put($id);
    } 
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {        
        if( $pathInfo != "/")
            get($id);
        else
            getAll(); //If no PATH_INFO is given.
    }
    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        delete($id);
    }    
} catch(Exception $e) {
    $error = new stdClass();
    $error->message = $e->getMessage();
    header("HTTP/1.1 500 Internal Server Error!");
    echo json_encode($error);
}


function post() {
    $mysqlConnection = connect();
    $postData = json_decode(file_get_contents('php://input'), true);
    $title = $postData['title'];
    $date = $postData['date'];
    $stmt = $mysqlConnection->prepare("INSERT INTO Reminder (Title,Date) VALUES(?,?)");
    $stmt->bind_param("ss", $title, $date);
    if ($stmt->execute() != TRUE) {
        throw new Exception("SQL query is not successfull.");
    } else {
        $insertedId = $mysqlConnection->insert_id;
        $result = $mysqlConnection->query("SELECT * FROM Reminder WHERE id = ".$insertedId);
        if ($result != TRUE) {   
            throw new Exception("SQL query is not successfull.");
        }
        $insertedData = $result->fetch_assoc();
        echo json_encode($insertedData);
    }
    
}


function put($id) {
    $mysqlConnection = connect();
    $putData = json_decode(file_get_contents('php://input'), true);
    $title = $putData['title'];
    $date = $putData['date'];
    $stmt = $mysqlConnection->prepare("UPDATE Reminder SET title = ?, date = ? WHERE id = ?");
    $stmt->bind_param("ssi", $title, $date, $id);
    if ($stmt->execute() != TRUE) {
        throw new Exception("SQL query is not successfull.");
    }
    get($id);
    
}


function get($id) {
    $mysqlConnection = connect();    
    $stmt = $mysqlConnection->prepare("SELECT * FROM Reminder WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute() != TRUE) {
        throw new Exception("SQL query is not successfull.");
    }
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();        
        $data = new stdClass();
        $data->title = $row['Title'];
        $data->date = $row['Date'];
        echo json_encode($data);
    } elseif (is_numeric($id) != TRUE) {
        throw new Exception("The ID of the desired reminder should be given as an integer");        
    } else {
        throw new Exception("There is no existing reminder with the given ID.");
    }
}


function getAll() {
    $mysqlConnection = connect();
    $sql = "SELECT * FROM Reminder";
    $result = $mysqlConnection->query($sql);
    if ($result != TRUE) {
        throw new Exception("SQL query is not successfull.");
    }
    if ($result->num_rows > 0) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);        
        $dataArray = [];
        foreach ($rows as $row){
            $data = new stdClass();
            $data->title = $row['Title'];
            $data->date = $row['Date'];
            $dataArray[] = $data;
        }
        echo json_encode($dataArray);
    } else {
        throw new Exception("There is no existing reminder.");
    }
}


function delete($id) {
    $mysqlConnection = connect();   
    $result = $mysqlConnection->query("SELECT id FROM Reminder WHERE id = ".$id);
    if ($result != TRUE) {
        throw new Exception("SQL query is not successfull.");
    }
    $reminder = $result->fetch_all(MYSQLI_ASSOC);
    if (sizeof($reminder) > 0) {
        $stmt = $mysqlConnection->prepare("DELETE FROM Reminder WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute() != TRUE)
            throw new Exception("SQL query is not successfull.");
    } elseif (sizeof($reminder) <= 0){
        throw new Exception("The reminder of the given ID does not exist.");
    } else {
        throw new Exception("There is no reminder exists.");
    }
}

?>