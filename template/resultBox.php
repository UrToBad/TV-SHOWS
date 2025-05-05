<?php
class resultBox
{
    public static function render(?string $title = NULL, ?array $tags = NULL, ?string $bg_path = NULL): void
    {
        $tagprint = "";
        if ($tags != NULL) {
            foreach ($tags as $tag) {
                $tagprint .= htmlspecialchars($tag->getNom()) . ", ";
            }
        }
        
        { ?>
            <link rel="stylesheet" href="style/resultbox.css">
            <div class="result_box">
                <div class="result_box_title"><?php echo $title?></div>
                <div class="result_box_content style="background-image: url(' <?php $bg_path ?> ');""></div>
                <div class="result_box_tags"><?php echo $tagprint?></div>
            </div>
            <?php
        }
    }
}