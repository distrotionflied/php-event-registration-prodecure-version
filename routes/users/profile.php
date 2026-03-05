<<<<<<< HEAD
<?php
declare(strict_types=1);
$userId = $_SESSION['user_id'];
$userProfile = getUserProfileDetails($userId);
=======
<?php
declare(strict_types=1);
$userId = $_SESSION['user_id'];
$userProfile = getUserProfileDetails($userId);
>>>>>>> c94fb1a7902d2d4277cf18985386ddcbaa4e221a
renderView('profile', ['title' => 'My Profile', 'user' => $userProfile]);