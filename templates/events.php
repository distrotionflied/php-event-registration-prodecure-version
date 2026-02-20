<h1><?= htmlspecialchars($title) ?></h1>

<a href="/events/create" style="display:inline-block;margin-bottom:15px;">
    ➕ Create Event
</a>

<?php if (empty($events)) : ?>
    <p>No events found.</p>
<?php else : ?>
    <ul>
        <?php foreach ($events as $event) : ?>
            <li style="margin-bottom:10px;">
                <strong>
                    <a href="/events/<?= $event->event_id ?>">
                        <?= htmlspecialchars($event->name) ?>
                    </a>
                </strong>
                <br>
                <small>
                    <?= htmlspecialchars($event->event_start) ?> 
                    - 
                    <?= htmlspecialchars($event->event_end) ?>
                </small>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
