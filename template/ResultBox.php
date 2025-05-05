<?php
class resultBox
{
    public static function render(int $id, ?string $title = NULL, ?array $tags = NULL, ?string $bg_path = NULL, string $type = "series", ?string $bot_content = NULL): void
    {
        $tagprint = "";
        if ($tags != NULL) {
            foreach ($tags as $tag) {
                $tagprint .= htmlspecialchars($tag->getNom()) . ", ";
            }
        }
        
        { ?>
            <link rel="stylesheet" href="style/resultbox.css">
            <div class="result_box" data-id="<?php echo $id; ?>" data-type="<?php echo $type; ?>">
                <div class="result_box_title"><?php echo $title?></div>
                <div class="result_box_content" style="background-image: url('<?php echo htmlspecialchars($bg_path); ?>');"></div>
                <div class="result_box_tags"><?php echo $tagprint, $bot_content?></div>
            </div>
            <?php
        }
    }
}