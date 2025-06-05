<?php
namespace App\Core;

class View
{
    public static function render(string $viewPath, array $data = []): void
    {
        extract($data); // Ex : $title, $content
        ob_start();
        require __DIR__ . '/../Views/' . $viewPath . '.php';
        $content = ob_get_clean();
        require __DIR__ . '/../Views/layout.php';
    }
}