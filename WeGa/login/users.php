<?php
header("Content-Type: application/json");
include '../database.php';

$requestMethod = $_SERVER["REQUEST_METHOD"];
$userId = isset($_GET['id']) ? intval($_GET['id']) : null;

switch ($requestMethod) {
    case 'GET':
        if ($userId) {
            getUser($userId);
        } else {
            getAllUsers();
        }
        break;
    case 'POST':
        createUser();
        break;
    case 'PUT':
        if ($userId) {
            updateUser($userId);
        } else {
            echo json_encode(["message" => "User ID missing"]);
        }
        break;
    case 'DELETE':
        if ($userId) {
            deleteUser($userId);
        } else {
            echo json_encode(["message" => "User ID missing"]);
        }
        break;
    default:
        echo json_encode(["message" => "Method not allowed"]);
        break;
}

function getAllUsers()
{
    global $conn;
    $sql = "SELECT * FROM registration";
    $result = $conn->query($sql);
    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    echo json_encode($users);
}

function getUser($id)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM registration WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    echo json_encode($result->fetch_assoc());
}

function createUser()
{
    global $conn;
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $conn->prepare("INSERT INTO registration (username, email, password, rol) VALUES (?, ?, ?, 'user')");
    $stmt->bind_param("sss", $data['username'], $data['email'], $data['password']);
    if ($stmt->execute()) {
        echo json_encode(["message" => "User created"]);
    } else {
        echo json_encode(["message" => "Error creating user"]);
    }
}

function updateUser($id)
{
    global $conn;
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $conn->prepare("UPDATE registration SET username = ?, email = ?, password = ? WHERE id = ?");
    $stmt->bind_param("sssi", $data['username'], $data['email'], $data['password'], $id);
    if ($stmt->execute()) {
        echo json_encode(["message" => "User updated"]);
    } else {
        echo json_encode(["message" => "Error updating user"]);
    }
}

function deleteUser($id)
{
    global $conn;
    $stmt = $conn->prepare("DELETE FROM registration WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo json_encode(["message" => "User deleted"]);
    } else {
        echo json_encode(["message" => "Error deleting user"]);
    }
}

$conn->close();
