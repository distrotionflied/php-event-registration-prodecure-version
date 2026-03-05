<<<<<<< HEAD
<?php
    $userId = $_SESSION['user_id'];
    
    $events = getEventsByCreatorId($userId);
    
    renderView('my-events', ['title' => 'My Events', 'events' => $events]);
<<<<<<< HEAD
?>
=======
?>
>>>>>>> 003a1b17be90afd36e252cd621471063a0a6e3a9
=======
    <?php
        creatorcheck($event['creator_id'], '/events');
        $userId = $_SESSION['user_id'];
        $events = getEventsByCreatorId($userId);
        renderView('my-events', ['title' => 'My Events', 'events' => $events]);
>>>>>>> c94fb1a7902d2d4277cf18985386ddcbaa4e221a
