<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $participantName = $_POST['participantName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $eventID = $_POST['eventID'];

    $sql = "INSERT INTO Participant (ParticipantName, Email, Phone, EventID) VALUES ('$participantName', '$email', '$phone', '$eventID')";

    if ($conn->query($sql) === TRUE) {
        echo "New participant added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
