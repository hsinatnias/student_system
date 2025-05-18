<?php
namespace Home\Solid\Helpers\View;

class View {
    public static function render(string $path, array $data = []): void {
        if (strpos($path, '..') !== false) {
            throw new \Exception("Invalid view path.");
        }

        
        [$module, $viewName] = explode('/', $path, 2);

        $baseDir = dirname(__DIR__, 2); 
        $viewFile = "{$baseDir}/{$module}/Views/{$viewName}.php";

        if (!file_exists($viewFile)) {
            throw new \Exception("View file [$viewFile] not found.");
        }

        extract($data);
        include $viewFile;
    }
}
