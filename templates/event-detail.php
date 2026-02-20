<?php echo TEMPLATES_DIR; ?>

<h1><?= htmlspecialchars($event->name) ?></h1>

<p><?= nl2br(htmlspecialchars($event->description)) ?></p>

<p>
    <strong>Start:</strong> <?= htmlspecialchars($event->event_start) ?><br>
    <strong>End:</strong> <?= htmlspecialchars($event->event_end) ?>
</p>

<hr>

<a href="/events/<?= $event->id ?>/edit">✏ Edit</a>
|
<a href="/events">⬅ Back to Events</a>
