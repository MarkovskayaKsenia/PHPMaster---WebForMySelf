<?php


namespace ishop\libs;


class Pagination
{
    public $currentPage;
    public $perPage;
    public $total;
    public $countPages;
    public $uri;

    public function __construct($page, $perPage, $total)
    {
        $this->perPage = $perPage;
        $this->total = $total;
        $this->countPages = $this->getCountPages();
        $this->currentPage = $this->getCurrentPage($page);
        $this->uri = $this->getParams();
    }

    public function getHtml()
    {
        $back = null; //назад
        $forward = null; //вперед
        $startPage = null; // в начало
        $endPage = null; // в перед
        $page2Left = null; // вторая страница слева
        $page1Left = null; // первая страница слева
        $page2Right = null; // вторая страница справа
        $page1Right = null; // вторая страница справа

        if ($this->currentPage > 1) {
            $back = "<li><a class='nav-link' href='{$this->uri}page=" . ($this->currentPage - 1) . "'>&lt;</a></li>";
        }

        if ($this->currentPage < $this->countPages) {
            $forward = "<li><a class='nav-link' href='{$this->uri}page=" . ($this->currentPage + 1) . "'>&gt;</a></li>";
        }

        if ($this->currentPage > 3) {
            $startPage = "<li><a class='nav-link' href='{$this->uri}page=1'>&laquo;</a></li>";
        }

        if ($this->currentPage < ($this->countPages - 2)) {
            $endPage = "<li><a class='nav-link' href='{$this->uri}page={$this->countPages}'>&raquo;</a></li>";
        }


        if ($this->currentPage - 2 > 0) {
            $page2Left = "<li><a class='nav-link' href='{$this->uri}page=" . ($this->currentPage - 2) . "'>" . ($this->currentPage - 2) . "</a></li>";
        }

        if ($this->currentPage - 1 > 0) {
            $page1Left = "<li><a class='nav-link' href='{$this->uri}page=" . ($this->currentPage - 1) . "'>" . ($this->currentPage - 1) . "</a></li>";
        }

        if ($this->currentPage + 1 <= $this->countPages) {
            $page1Right = "<li><a class='nav-link' href='{$this->uri}page=" . ($this->currentPage + 1) . "'>" . ($this->currentPage + 1) . "</a></li>";
        }

        if ($this->currentPage + 2 <= $this->countPages) {
            $page2Right = "<li><a class='nav-link' href='{$this->uri}page=" . ($this->currentPage + 2) . "'>" . ($this->currentPage + 2) . "</a></li>";
        }


        return '<ul class="pagination">' . $startPage.$back.$page2Left.$page1Left.
            '<li class="active"><a>'. $this->currentPage . '</a></li>'.
            $page1Right.$page2Right.$forward.$endPage . '</ul>' ;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getHtml();
    }


    public function getCountPages()
    {
        return ceil($this->total / $this->perPage) ?: 1;
    }

    public function getCurrentPage($page)
    {
        if (!$page || $page < 1) {
            $page = 1;
        }

        if ($page > $this->countPages) {
            $page = $this->countPages;
        }

        return $page;
    }

    public function getStart()
    {
        return ($this->currentPage - 1) * $this->perPage;
    }

    public function getParams()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $uri = $url[0] . '?';

        if (isset($url[1]) && $url[1] !== '') {
            $params = explode('&', $url[1]);
            foreach ($params as $param) {
                if (!preg_match('~page=~', $param)) {
                    $uri .= "{$param}&amp;";
                }
            }
        }
        return urldecode($uri);
    }

}