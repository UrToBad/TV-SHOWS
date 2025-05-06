<?php
class resultBox
{
    public static function render(int $id, ?string $title = NULL, ?array $tags = NULL, ?string $bg_path = NULL, string $type = "series", ?string $bot_content = NULL): void
    {
        $tagprint = "";
        if ($tags != NULL) {
            $tagNames = array_map(fn($tag) => htmlspecialchars($tag->getNom()), $tags);
            $tagprint = implode(", ", $tagNames);
        }
        
        { ?>
            <link rel="stylesheet" href="style/resultbox.css">
            <?php
                if (session_status() === PHP_SESSION_NONE) session_start();
                $deleteIcon = !empty($_SESSION['connecte']) ? "<span class='delete-icon' data-id='$id' data-type='$type'>🗑️</span>" : ""; ?>
            <div class="result_box" data-id="<?php echo $id; ?>" data-type="<?php echo $type; ?>">
                <div class="result_box_title"><?php echo $title?></div>
                <div class="result_box_content" style="background-image: url('<?php echo htmlspecialchars($bg_path); ?>');"></div>
                <div class="result_box_tags"><?php echo $tagprint, $bot_content, $deleteIcon?></div>
            </div>
            <?php
        }
    }
}