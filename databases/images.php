<?php
    function saveImage($eventId, $imagePath)
    {
        global $connection;
        $sql = "INSERT INTO images (event_id, image_path) VALUES (?, ?)";
        $stmt = $connection->prepare($sql);
        if (!$stmt) {
            throw new Exception($connection->error);
        }
        $stmt->bind_param("is", $eventId, $imagePath);

        return $stmt->execute();
    }

    function getImagesByEventId($eventId)
    {
        global $connection;
        $sql = "SELECT image_path FROM images WHERE event_id = ?";
        $stmt = $connection->prepare($sql);
        if (!$stmt) {
            throw new Exception($connection->error);
        }
        $stmt->bind_param("i", $eventId);
        $stmt->execute();
        $result = $stmt->get_result();

        $images = [];
        while ($row = $result->fetch_assoc()) {
            $images[] = htmlspecialchars($row['image_path'], ENT_QUOTES, 'UTF-8');
        }

        return $images;
    }

    function deleteImagesByEventId($eventId)
    {
        global $connection;
        $sql = "DELETE FROM images WHERE event_id = ?";
        $stmt = $connection->prepare($sql);
        if (!$stmt) {
            throw new Exception($connection->error);
        }
        $stmt->bind_param("i", $eventId);

        return $stmt->execute();
    }

