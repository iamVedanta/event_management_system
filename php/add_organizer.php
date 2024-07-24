<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $organizerName = $_POST['organizerName'];
    $contactNumber = $_POST['contactNumber'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $sql = "INSERT INTO Organizer (OrganizerName, ContactNumber, Email, Address) VALUES ('$organizerName', '$contactNumber', '$email', '$address')";

    if ($conn->query($sql) === TRUE) {
        echo "New organizer added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
