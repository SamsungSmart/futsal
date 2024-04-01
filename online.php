<?php
include 'db.php'; // Include database connection script

// Check if all required parameters are set in the POST request
if (isset($_POST['rev_date'], $_POST['rev_time'], $_POST['name'], $_POST['address'], $_POST['email'], $_POST['phone'], $_POST['hours'], $_POST['price'])) {
    
    // Retrieve POST parameters
    $date = $_POST['rev_date'];
    $time = $_POST['rev_time'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $hours = $_POST['hours'];
    $price = $_POST['price'];

    // Check if the email already exists in the reservations table
    if (checkExistingReservationByEmail($conn, $email)) {
        $message = "Email already exists. Please use a different email.";
    } 
    elseif (checkExistingReservations($conn, $date, $time)) {
        $message = "Place already reserved for the selected date and time.";
    } else {
        // Perform reservation logic
        $sql = "INSERT INTO reservations (rev_date, rev_time, name, address, email, phone, hours, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssiii", $date, $time, $name, $address, $email, $phone, $hours, $price);
        
        if ($stmt->execute()) {
            // Reservation successful, redirect to view_reservations.php
            header("Location: reservation_contains.php?date=".$date."&name=".$name."&time=".$time."&address= Chamati, Kathmandu"."&confirmation=".$phone."&hours=".$hours."&price=".$price);
            exit(); // Ensure that no further code is executed after the header
        } else {
            $message = "Error: Unable to process the reservation. Please try again later.";
        }
    }
} else {
    $message = "Invalid request";
}

// Send JSON response
echo json_encode(['message' => $message]);

// Function to check if there are existing reservations for the given date and time
function checkExistingReservations($conn, $date, $time) {
    $sql = "SELECT * FROM reservations WHERE rev_date = ? AND rev_time = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $date, $time);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

// Function to check if the email already exists in the reservations table
function checkExistingReservationByEmail($conn, $email) {
    $sql = "SELECT * FROM reservations WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}
?>
<script>
    // Display popup notification
    var message = <?php echo json_encode($message); ?>;
    if (message) {
        alert(message);
    }
</script>
