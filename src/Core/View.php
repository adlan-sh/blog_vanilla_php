<?php

declare(strict_types=1);

namespace App\Core;

use Smarty\Smarty;

class View
{
    private static ?Smarty $smarty = null;

    public static function init(array $config): void
    {
        $smarty = new Smarty();

        $smarty->setTemplateDir($config['template_dir']);
        $smarty->setCompileDir($config['compile_dir']);
        $smarty->setCacheDir($config['cache_dir']);

        $smarty->escape_html = true;

        self::$smarty = $smarty;
    }

    public static function render(string $template, array $vars = []): string
    {
        foreach ($vars as $k => $v) {
            self::$smarty->assign($k, $v);
        }

        return self::$smarty->fetch($template);
    }
}
