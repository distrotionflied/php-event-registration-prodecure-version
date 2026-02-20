<?php include 'header.php'; ?>
<?php if (empty($events)) : ?>
    <p>คุณยังไม่ได้สร้างกิจกรรมใดๆ</p>
<?php else : ?>
    <?php foreach ($events as $event) : ?>
        <div class="event-card">
            <h3><?= htmlspecialchars($event->name) ?></h3>
            <p><strong>ชื่อกิจกรรม:</strong> <?= htmlspecialchars($event->name) ?></p>
            <p><strong>รายละเอียด:</strong> <?= htmlspecialchars($event->description) ?></p>
            <p><strong>เวลาเริ่ม:</strong> <?= htmlspecialchars($event->event_start) ?></p>
            <p><strong>เวลาจบ:</strong> <?= htmlspecialchars($event->event_end) ?></p>
            <a href="/events/<?= $event->id ?>">ดูรายละเอียด</a>
        </div>
        <?php endforeach; ?>
<?php endif; ?>