<?php
class resultBox
{
    public static function render(string $title, array $tags): void
    { ?>
        <div class="result_box">
            <div class="result_box_title"><?php $title?></div>
            <div class="result_box_content"></div>
            <div class="result_box_tags"><?php $tags?></div>
        </div>
        <?php
    }
}
