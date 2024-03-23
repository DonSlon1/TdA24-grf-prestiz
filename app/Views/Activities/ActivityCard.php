<div class="card" <?= ($item['hidden'] ?? '') ?'style="display:none"': '' ?> <?php echo ($_COOKIE['theme'] ?? '') == 'disabled' ? 'dark-mode' : '' ?>>
    <div>
        <h3>
            <?= htmlspecialchars($activity['activityName']) ?>
        </h3>

        <div class="info">
            <div class="icon-line">
                <div class="icon-txt">
                    <img class="group-icon small-icon" src="\icon\TdA_ikony\SVG\TdA_ikony_konverzace_black.svg" alt="TdA_ikony_konverzace_black.svg">
                    <p><?= htmlspecialchars($activity['classStructure']) ?></p>
                </div>

                <div class="icon-txt">
                    <img class="group-icon small-icon" src="\icon\TdA_ikony\SVG\TdA_ikony_napad_black.svg" alt="TdA_ikony_konverzace_black.svg">
                    <p><?= implode(', ', array_map('htmlspecialchars', $activity['edLevel'] ?? [])) ?></p>
                </div>

                <div class="icon-txt">
                    <img class="clock small-icon" src="\icon\custom\clock_black.svg" alt="clock">
                    <p><?= htmlspecialchars($activity['lengthMin']) ?> min</p> <p>-</p> <p><?= htmlspecialchars($activity['lengthMax']) ?> min</p>
                </div>
            </div>

            <div class="bio">
                <?= htmlspecialchars($activity['description']) ?>
            </div>
        </div>
    </div>
    <a class="medium button right-align" href="aktivita/<?= $activity['uuid'] ?>"> Zjistit více</a>
</div>