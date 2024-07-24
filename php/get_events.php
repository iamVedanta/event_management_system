<?php
include 'db.php';

header('Content-Type: application/json');

$sql = "SELECT EventID, EventName, EventDate, Location FROM Event";
$result = $conn->query($sql);

$events = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

echo json_encode($events);

$conn->close();
?>
