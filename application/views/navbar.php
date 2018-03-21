<div role="navigation" class="span12">
    <ul class="nav nav-pills">
        <?php foreach ($navbar["main"] AS $c => $cat) { ?>
            <?php if ($category == $cat["key"]) { ?>
                <li role="presentation" class="active">
                    <a href="#"><?= $cat['value'] ?></a>
                </li>
            <?php } else { ?>
                <li role="presentation" class="">
                    <a href="/index.php/transaction/<?= $cat['key'] ?>"><?= $cat['value'] ?></a>
                </li>
            <?php } ?>
        <?php } ?>
    </ul>
</div>
<br>
<div role="navigation" class="span12">
    <ul class="nav nav-tabs ">
        <?php foreach ($navbar["sub"][$category] AS $s => $sec) { ?>
            <?php if ($section == $sec["key"]) { ?>
                <li role="presentation" class="active">
                    <a href="#"><?= $sec['value'] ?></a>
                </li>
            <?php } else { ?>
                <li role="presentation" class="">
                    <a href="/index.php/transaction/<?= $category ?>/<?= $sec['key'] ?>"><?= $sec['value'] ?></a>
                </li>
            <?php } ?>
        <?php } ?>
    </ul>
</div>
<div class="row-fluid"><br></div>

