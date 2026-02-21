<?php include 'header.php'; ?>

<?php if (empty($events)) : ?>
    <div class="no-data">
        <p>คุณยังไม่ได้สร้างกิจกรรมใดๆ</p>
    </div>
<?php else : ?>
    <div class="event-grid">
        <?php foreach ($events as $event) : ?>
            <div class="event-card">
                <h3><?= htmlspecialchars($event['event_name'] ?? 'ไม่มีชื่อกิจกรรม') ?></h3>
                
                <p><strong>รายละเอียด:</strong> 
                    <?= htmlspecialchars($event['event_description'] ?? $event['description'] ?? 'ไม่มีรายละเอียด') ?>
                </p>
                
                <p><strong>เวลาเริ่ม:</strong> 
                    <?= htmlspecialchars($event['event_start'] ?? '-') ?>
                </p>
                
                <p><strong>เวลาจบ:</strong> 
                    <?= htmlspecialchars($event['event_end'] ?? '-') ?>
                </p>
                
                <a href="/events/<?= $event['event_id'] ?>/detail" class="btn">ดูรายละเอียด</a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>