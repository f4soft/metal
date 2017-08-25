<form action="" class="oprosnik-default-form oprosnik-form">
    <ul class="list">
        <?php foreach ($answers as $answer): ?>
            <li>
                <input type="radio" id="q-<?= $poll->id ?>-<?= $answer->id ?>"
                       value="<?= $answer->id ?>" class="radio-custom" name="poll">
                <label for="q-<?= $poll->id ?>-<?= $answer->id ?>" class="radio-custom-label">
                    <?= $answer->title ?>
                </label>
            </li>
        <?php endforeach; ?>
    </ul>
    <input type="text" name="email" id="email" class="input-text" placeholder="Введите ваш e-mail...">
    <textarea name="mess" id="mess" cols="30" rows="10" class="textarea"
              placeholder="Введите ваше сообщение"></textarea>
    <button type="submit" class="submit">Голосовать</button>
</form>