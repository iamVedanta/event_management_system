<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sponsorName = $_POST['sponsorName'];
    $contact = $_POST['contact'];
    $phone = $_POST['phone'];
    $eventID = $_POST['eventID'];

    $sql = "INSERT INTO Sponsor (SponsorName, Contact, Phone, EventID) VALUES ('$sponsorName', '$contact', '$phone', '$eventID')";

    if ($conn->query($sql) === TRUE) {
        echo "New sponsor added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
