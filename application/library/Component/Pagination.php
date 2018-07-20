<?php

namespace Component;

/**
 * Description of Pagination
 *
 * @author Sgenmi
 * @date 2016-11-15
 * @Email 150560159@qq.com
 */

class Pagination
{
    private $page = 1;
    private $page_total = 0;
    private $limit = 15;
    private $adjacents = 1;
    private $page_url = "";
    private $lastpage = 1;
    public function __construct( $page = 1, $page_total = 0, $limit = 15, $targetpage = "/", $pagestring = "?page=", $adjacents = 1 )
    {
        $this->page = $page ? $page : $this->page;
        $this->page_total = $page_total ? $page_total : $this->page_total;
        $this->limit = $limit ? $limit : $this->limit;
        $targetpage = $targetpage ? $targetpage : "/";
        $this->page_url = $targetpage . $pagestring;
        $this->adjacents = $adjacents ? $adjacents : $this->adjacents;
    }
    public function display()
    {
        $this->lastpage = ceil( $this->page_total / $this->limit );
        $pagination = "";
        if ($this->lastpage > 1)
        {
            $pagination .= $this->prev();
            //pages	
            if ($this->lastpage < 7 + ($this->adjacents * 2))
            {
                for ($i = 1; $i <= $this->lastpage; $i++)
                {
                    if ($i == $this->page)
                    {
                        $pagination .= "<span class='item current'>$i</span>";
                    } else
                    {
                        $pagination .= "<a class='item' href='javascript:void(0);' _href=\"" . $this->page_url . $i . "\">$i</a>";
                    }
                }
            } elseif ($this->lastpage >= 7 + ($this->adjacents * 2))
            {
                if ($this->page < 1 + ($this->adjacents * 3))
                {
                    for ($i = 1; $i < 4 + ($this->adjacents * 2); $i++)
                    {
                        if ($i == $this->page)
                        {
                            $pagination .= "<span class='item current'>$i</span>";
                        } else
                        {
                            $pagination .= "<a class='item' href='javascript:void(0);' _href=\"" . $this->page_url . $i . "\">$i</a>";
                        }
                    }
                    $pagination .= $this->end();
                } elseif ($this->lastpage - ($this->adjacents * 2) > $this->page && $this->page > ($this->adjacents * 2))
                {
                    $pagination .=$this->start();
                    for ($i = $this->page - $this->adjacents; $i <= $this->page + $this->adjacents; $i++)
                    {
                        if ($i == $this->page)
                            $pagination .= "<span class='item current'>$i</span>";
                        else
                            $pagination .= "<a class='item' href='javascript:void(0);' _href=\"" . $this->page_url . $i . "\">$i</a>";
                    }
                    $pagination .= $this->end();
                }
                //close to end; only hide early pages
                else
                {
                    $pagination .=$this->start();
                    for ($i = $this->lastpage - (1 + ($this->adjacents * 3)); $i <= $this->lastpage; $i++)
                    {
                        if ($i == $this->page)
                            $pagination .= "<span class='item current'>$i</span>";
                        else
                            $pagination .= "<a class='item' href='javascript:void(0);' _href=\"" . $this->page_url . $i . "\">$i</a>";
                    }
                }
            }
            //next button
            if ($this->page < $i - 1)
                $pagination .= "<a class='item' href='javascript:void(0);' data-page=\"".($this->page+1)."\"  _href=\"" . $this->page_url . ($this->page + 1) . "\">下一页</a>";
            else
                $pagination .= "<span class='item disabled'>下一页</span>";
            $pagination .= "</div>\n";
        }
        return $pagination;
    }
    private function prev()
    {
        $prev_html = "";
        $prev_html .= "<div class=\"pagination\" >";
        if ($this->page > 1)
        {
            $prev_html .= "<a class='item' href='javascript:void(0);' data-page=\"".($this->page-1)."\"  _href=\"" . $this->page_url . ($this->page - 1) . "\">上一页</a>";
        } else
        {
            $prev_html .= "<span class='item disabled'>上一页</span>";
        }
        return $prev_html;
    }
    private function start()
    {
        $start_html = "";
        $start_html .= "<a class='item' href='javascript:void(0);' _href=\"" . $this->page_url . "1\">1</a>";
        $start_html .= "<a class='item' href='javascript:void(0);' _href=\"" . $this->page_url . "2\">2</a>";
        $start_html .= "<span class='item spaces' >...</span>";
        return $start_html;
    }
    private function end()
    {
        $end_html = "";
        $_page = $this->lastpage - 1; //最后一页的前一页
        $end_html .=" <span class='item spaces'>...</span>";
        $end_html .= "<a class='item' href='javascript:void(0);' _href=\"" . $this->page_url . $_page . "\">" . $_page . "</a>";
        $end_html .= "<a class='item' href='javascript:void(0);' _href=\"" . $this->page_url . $this->lastpage . "\">" . $this->lastpage . "</a>";
        return $end_html;
    }
}