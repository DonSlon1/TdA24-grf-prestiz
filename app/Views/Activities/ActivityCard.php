
    <div class="card" <?= ($item['hidden'] ?? '') ?'style="display:none"': '' ?> <?php echo ($_COOKIE['theme'] ?? '') == 'disabled' ? 'dark-mode' : '' ?>>
        <div>
            <h3>
                Jméno aktivity
            </h3>

            <div class="info">
                <div class="icon-line">
                    <div class="icon-txt">
                        <img class="group-icon small-icon" src="\icon\TdA_ikony\SVG\TdA_ikony_konverzace_black.svg" alt="TdA_ikony_konverzace_black.svg">
                        <p>Velikost skupiny</p>
                    </div>

                    <div class="icon-txt">
                        <img class="group-icon small-icon" src="\icon\TdA_ikony\SVG\TdA_ikony_napad_black.svg" alt="TdA_ikony_konverzace_black.svg">
                        <p>úroveň vzdělání</p>
                    </div>

                    <div class="icon-txt">
                        <img class="clock small-icon" src="\icon\custom\clock_black.svg" alt="clock">
                        <p>min doba</p> <p>-</p> <p>max doba</p>
                    </div>
                </div>

                <div class="bio">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium consectetur cupiditate deleniti distinctio, doloribus earum enim eos eveniet explicabo id ipsam itaque iusto maiores modi nesciunt quam quo recusandae rem, sed temporibus ut voluptates. At commodi est minus modi praesentium quos, velit. Delectus eius modi sed unde ut voluptate.
                </div>
            </div>
        </div>
        <a class="medium button right-align" href="aktivita"> Zjistit více</a>
    </div>
