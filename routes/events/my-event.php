<?php
    $userId = $_SESSION['user_id'];
    
    $events = getEventsByCreatorId($userId);
    
    renderView('my-events', ['title' => 'My Events', 'events' => $events]);
<<<<<<< HEAD
?>
=======
?>
>>>>>>> 003a1b17be90afd36e252cd621471063a0a6e3a9
