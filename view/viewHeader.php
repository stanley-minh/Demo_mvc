<?php
class ViewHeader
{
    private ?string $buffer = null;

    public function __construct(
        private ?string $title = "Mon Super Site",
        private ?string $linkScript = ''
    ) {}

    public function launchBuffer(): self
    {
        ob_start();
        ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($this->title ?? '') ?></title>
    <link rel="stylesheet" href="./public/src/css/style.css">
    <?php if (!empty($this->linkScript)): ?>
    <script src="<?= htmlspecialchars($this->linkScript) ?>" defer></script>
    <?php endif; ?>
</head>
<body>
    <header>
        <nav>
            <a href="<?= htmlspecialchars($_ENV['utilisateurs'] ?? '#') ?>">Utilisateurs</a>
            <a href="<?= htmlspecialchars($_ENV['articles'] ?? '#') ?>">Articles</a>
        </nav>
    </header>
        <?php
        $this->buffer = ob_get_clean();
        return $this;
    }

    public function display(): void
    {
        echo $this->buffer ?? '';
    }
}