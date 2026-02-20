<?php
    class UserController
    {
        private $userRepo;

        public function __construct($userRepo)
        {
            $this->userRepo = $userRepo;
        }

        public function index(): void
        {
            $users = $this->userRepo->getUsersById(1); // ตัวอย่างการดึงข้อมูลผู้ใช้ด้วย ID 1
            renderView('users', ['title' => 'Users', 'users' => $users]);
        }
    }