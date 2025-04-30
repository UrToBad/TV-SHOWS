<?php
class resultBox
{
    public static function render(string $title, string $tags): void
    { ?>
        <div class="result_box">
            <div class="result_box_title">Title</div>
            <div class="result_box_content"></div>
            <div class="result_box_tags">Tags</div>
        </div>
        <?php
    }
}
