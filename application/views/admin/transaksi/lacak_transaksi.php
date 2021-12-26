<div class="col-md-7 mx-auto">
    <div class="card">
        <ul class="events">
            <?php foreach ($lacak as $lacak) : ?>
                <li>
                    <time class="col-6 text-right is-done" datetime="10:03"><?php echo date('d/m/Y', strtotime($lacak->date_updated)); ?><br> <?php echo date('H:i:s', strtotime($lacak->date_updated)); ?> WIB</time>
                    <span class="col-6 text-left"><strong><?php echo $lacak->provinsi_name; ?></strong> <?php echo $lacak->lacak_desc; ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>