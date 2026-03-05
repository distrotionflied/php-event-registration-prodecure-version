<<<<<<< HEAD
<?php
    function creatorcheck($eventCreatorId , $location): void {
         if ($_SESSION['user_id'] !== $eventCreatorId) {
            header("Location: $location");
            exit;
        }
=======
<?php
    function creatorcheck($eventCreatorId , $location): void {
         if ($_SESSION['user_id'] !== $eventCreatorId) {
            header("Location: $location");
            exit;
        }
>>>>>>> c94fb1a7902d2d4277cf18985386ddcbaa4e221a
    }