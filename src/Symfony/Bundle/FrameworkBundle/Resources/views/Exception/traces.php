<div class="block">
    <?php if ($count > 0): ?>
        <h3>
            <span><?php echo $count - $position + 1 ?>/<?php echo $count + 1 ?></span>
            <?php echo $manager->getName() ?>: <?php echo str_replace("\n", '<br />', htmlspecialchars($manager->getMessage(), ENT_QUOTES, $view->getCharset())) ?>
            <a href="#" onclick="toggle('traces_<?php echo $position ?>', 'traces'); return false;">&raquo;</a><br />
        </h3>
    <?php else: ?>
        <h3>Stack Trace</h3>
    <?php endif; ?>

    <a id="traces_link_<?php echo $position ?>"></a>
    <ul class="traces" id="traces_<?php echo $position ?>" style="display: <?php echo 0 === $position ? 'block' : 'none' ?>">
        <?php foreach ($manager->getTraces() as $i => $trace): ?>
            <li>
                <?php echo $view->render('FrameworkBundle:Exception:trace', array('prefix' => $position, 'i' => $i, 'trace' => $trace)) ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
