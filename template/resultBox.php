<?php
class resultBox
{
    public static function render(string $title, array $tags): void {
    $tagprint = "";
    foreach ($tags as $tag) {
        $tagprint . $tag->getNom();
    }
    { ?>
        <link rel="stylesheet" href="style/resultbox.css">
        <div class="result_box">
            <div class="result_box_title"><?php echo $title?></div>
            <div class="result_box_content"></div>
            <div class="result_box_tags"><?php echo $tagprint?></div>
        </div>
        <?php
    }
}
}