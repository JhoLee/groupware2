<Form action="/index.php/topic/add" method="post" class="span10">
    <?= validation_errors() ?>
    <input type="text" name="title" placeholder="Title" class="span10"/>
    <textarea name="description" placeholder="Description" class="span10" rows="15"></textarea>
    <button type="submit" class="btn">submit</button>
</Form>