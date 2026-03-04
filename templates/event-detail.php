<?php include 'header.php'; ?>
<main class="flex-grow py-12 px-4 sm:px-8 flex flex-col items-center">
    <div class="bg-white p-8 sm:p-10 rounded-xl shadow-lg w-full max-w-3xl border border-gray-100">
        <?php 
        $images = getImagesByEventId($event['id']); 
        if (!empty($images)) : 
        ?>
            <div class="w-full mb-8 overflow-hidden rounded-xl shadow-md border border-gray-100">
                <img src="<?= htmlspecialchars($images[0]) ?>" 
                     alt="<?= htmlspecialchars($event['name']) ?>" 
                     class="w-full h-auto max-h-[400px] object-cover">
            </div>
        <?php endif; ?> 

        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-6"><?= htmlspecialchars($event['name']) ?></h1>

        <p class="text-gray-700 leading-relaxed mb-8 bg-gray-50 p-6 rounded-lg border border-gray-100 text-base sm:text-lg">
            <?= nl2br(htmlspecialchars($event['description'])) ?>
        </p>

        <p class="bg-blue-50 border border-blue-200 p-5 rounded-lg mb-8 text-blue-900 shadow-sm leading-loose">
            <strong class="text-blue-700">📅 Start:</strong> <?= htmlspecialchars($event['event_start']) ?><br>
            <strong class="text-blue-700">🏁 End:</strong> <?= htmlspecialchars($event['event_end']) ?>
        </p>

        <?php
            if(isset($alert)) {
            echo '<div class="bg-green-100 mb-6 border border-green-300 rounded-lg w-full">';
            echo '<p class="text-md text-green-500 font-medium mt-4 mb-4 text-center">' . htmlspecialchars($alert) . '</p>';
            echo '</div>';
        }

        ?>

        <hr class="border-t border-gray-200 my-8">

        <div class="flex flex-wrap items-center">
            <?php 
            if ($userId != NULL && $event != NULL) :
                // 1. เช็คว่าเป็นเจ้าของไหม
                $isCreator = ($userId == $event['creator_id']);
                    if ($isCreator): ?>
                        <a href="/events/<?= $event['id'] ?>/edit" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2.5 px-6 rounded-lg shadow-sm transition-colors no-underline mr-3 mb-3">✏ Edit</a>

                        <a href="/events/<?= $event['id'] ?>/participants" class="inline-block bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2.5 px-6 rounded-lg shadow-sm transition-colors no-underline mr-3 mb-3">👥 Participants</a>

                        <a href="/events/<?= $event['id'] ?>/statistics" class="inline-block bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2.5 px-6 rounded-lg shadow-sm transition-colors no-underline mr-3 mb-3">📊 Statistics</a>

                        <a href="/events/<?= $event['id'] ?>/delete-event"
                            onclick="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบกิจกรรมนี้? การกระทำนี้ไม่สามารถย้อนกลับได้');"
                            class="inline-block bg-red-500 hover:bg-red-600 text-white font-bold py-2.5 px-6 rounded-lg shadow-sm transition-colors no-underline mr-3 mb-3">🗑 Delete</a>
                        <?php endif; ?>
            <?php endif; ?>

            <a href="/events" class="inline-block bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2.5 px-6 rounded-lg border border-gray-300 shadow-sm transition-colors no-underline mb-3">⬅ Back to Events</a>
        </div>

    </div>
</main>
<?php include 'footer.php'; ?>