<ul class="list">
    <?php foreach ($answers as $answer): ?>
        <li>
            <?= $answer->title ?> - <?= is_null($answer->votes_count) ? 0 : $answer->votes_count ?>&nbsp;голосов
        </li>
    <?php endforeach; ?>
</ul>