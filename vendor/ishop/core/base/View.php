<?php


namespace ishop\base;


class View
{
    public $route;
    public $controller;
    public $model;
    public $view;
    public $prefix;
    public $data = [];
    public $meta = [];
    public $layout;

    public function __construct($route, $layout = '', $view = '', $meta)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $view;
        $this->prefix = $route['prefix'];
        $this->meta = $meta;
        if ($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }
    }

    public function render($data)
    {
        if (is_array($data)) {
            extract($data);
        }
       $viewFile = APP . "/views/{$this->prefix}{$this->controller}/{$this->view}.php";

       if (!is_file($viewFile)) {
           throw new \Exception("Не найден вид $viewFile", 500);
       }
       ob_start();
       require_once $viewFile;
       $content = ob_get_clean();
       $meta = $this->getMeta();

       if ($this->layout !== false) {
           $layoutFile = APP. "/views/layouts/{$this->layout}.php";
           if (!is_file($layoutFile)) {
               throw new \Exception("Не найден файл: {$layoutFile}");
           }
           require_once $layoutFile;
       }
    }

    public function getMeta()
    {
        $html = '<title>' . $this->meta['title'] . '</title>' . PHP_EOL;
        $html .= '<meta name = "description" content="' . $this->meta['description'] . '">' . PHP_EOL;
        $html .= '<meta name = "keywords" content="' . $this->meta['keywords'] . '"> ' . PHP_EOL;

        return $html;
    }
}