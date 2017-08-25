<div class="col-lg-5">
    <div class="oprosnik-block">
        <h5 class="h5 title"><?= \yii\helpers\StringHelper::truncate($poll->title, 40) ?></h5>
        <div class="oprosnik-content">
            <?php if ($poll->isUserVote()): ?>
                <?= $this->render('@app/views/about/inc/answers', ['answers' => $answers,'poll' => $poll]); ?>
            <?php else: ?>
                <?= $this->render('@app/views/about/inc/questions', ['answers' => $answers,'poll' => $poll]); ?>
            <?php endif; ?>
        </div>
    </div>
</div>