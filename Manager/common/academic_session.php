<?php include("connection.php");

function getCurrentAcademicSession($db) {
    $currentYear = date("Y");
    $currentMonth = date("m");

    // Determine the session based on month
    if ($currentMonth >= 6) {
        $sessionName = $currentYear . '-' . ($currentYear + 1);
    } else {
        $sessionName = ($currentYear - 1) . '-' . $currentYear;
    }

    // Check if this session already exists
    $query = "SELECT id FROM academic_sessions WHERE session_name = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $sessionName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        return $row['id']; // Return existing session ID
    } else {
        // Insert new session and mark as active
        $startDate = $currentYear . "-06-01"; // Assume session starts in June
        $endDate = ($currentYear + 1) . "-05-31"; // Ends in May next year

        // Deactivate all previous sessions
        $db->query("UPDATE academic_sessions SET status = 'inactive'");

        // Insert new session
        $insertQuery = "INSERT INTO academic_sessions (session_name, start_date, end_date, status) VALUES (?, ?, ?, 'active')";
        $stmt = $db->prepare($insertQuery);
        $stmt->bind_param("sss", $sessionName, $startDate, $endDate);
        $stmt->execute();

        return $stmt->insert_id; // Return new session ID
    }
}
?>
