<?php
include 'db.php';

header('Content-Type: application/json');

$eventID = isset($_GET['eventID']) ? (int)$_GET['eventID'] : 0;

$response = array(
    'organizers' => array(),
    'sponsors' => array(),
    'participants' => array(),
    'venue' => array()
);

if ($eventID) {
    // Fetch organizers
    $sql = "SELECT OrganizerName FROM Organizer WHERE OrganizerID IN (SELECT OrganizerID FROM Event WHERE EventID = ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $eventID);
    $stmt->execute();
    $result = $stmt->get_result();
    $response['organizers'] = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    // Fetch sponsors
    $sql = "SELECT SponsorName FROM Sponsor WHERE EventID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $eventID);
    $stmt->execute();
    $result = $stmt->get_result();
    $response['sponsors'] = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    // Fetch participants
    $sql = "SELECT ParticipantName FROM Participant WHERE EventID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $eventID);
    $stmt->execute();
    $result = $stmt->get_result();
    $response['participants'] = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    // Fetch venue
    $sql = "SELECT VenueName, Address FROM Venue WHERE EventID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $eventID);
    $stmt->execute();
    $result = $stmt->get_result();
    $response['venue'] = $result->fetch_assoc();
    $stmt->close();
}

echo json_encode($response);

$conn->close();
?>
