<?php
    class JoinEventController
    {
        private JoinEventRepository $joinEventRepo;
        private EventRepository $eventRepo;

        public function __construct(joinEventRepository $joinEventRepo, EventRepository $eventRepo)
        {
            $this->joinEventRepo = $joinEventRepo;
            $this->eventRepo = $eventRepo;
        }

        public function join(int $eventId): void
        {
            requireAuth();
            $userId = $_SESSION['user_id'];
            $this->joinEventRepo->joinEvent($userId, $eventId);
            header("Location: /events/$eventId");
            exit();
        }
    }