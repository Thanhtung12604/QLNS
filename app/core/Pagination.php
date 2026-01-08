<?php

class Pagination
{
    private $totalRecords;
    private $perPage;
    private $currentPage;
    private $totalPages;

    public function __construct($totalRecords, $perPage = 20, $currentPage = 1)
    {
        $this->totalRecords = (int)$totalRecords;
        $this->perPage = (int)$perPage;
        $this->currentPage = max(1, (int)$currentPage);
        $this->totalPages = ceil($this->totalRecords / $this->perPage);

        // Ensure current page doesn't exceed total pages
        if ($this->currentPage > $this->totalPages && $this->totalPages > 0) {
            $this->currentPage = $this->totalPages;
        }
    }

    public function getOffset()
    {
        return ($this->currentPage - 1) * $this->perPage;
    }

    public function getLimit()
    {
        return $this->perPage;
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function getTotalPages()
    {
        return $this->totalPages;
    }

    public function getTotalRecords()
    {
        return $this->totalRecords;
    }

    public function getPerPage()
    {
        return $this->perPage;
    }

    public function hasPages()
    {
        return $this->totalPages > 1;
    }

    public function hasPrevious()
    {
        return $this->currentPage > 1;
    }

    public function hasNext()
    {
        return $this->currentPage < $this->totalPages;
    }

    public function getPreviousPage()
    {
        return max(1, $this->currentPage - 1);
    }

    public function getNextPage()
    {
        return min($this->totalPages, $this->currentPage + 1);
    }

    public function getPageNumbers($adjacents = 2)
    {
        $pages = [];

        if ($this->totalPages <= 7) {
            // Show all pages if total is small
            for ($i = 1; $i <= $this->totalPages; $i++) {
                $pages[] = $i;
            }
        } else {
            // Always show first page
            $pages[] = 1;

            $start = max(2, $this->currentPage - $adjacents);
            $end = min($this->totalPages - 1, $this->currentPage + $adjacents);

            if ($start > 2) {
                $pages[] = '...';
            }

            for ($i = $start; $i <= $end; $i++) {
                $pages[] = $i;
            }

            if ($end < $this->totalPages - 1) {
                $pages[] = '...';
            }

            // Always show last page
            if ($this->totalPages > 1) {
                $pages[] = $this->totalPages;
            }
        }

        return $pages;
    }

    public function getStartRecord()
    {
        if ($this->totalRecords == 0) return 0;
        return $this->getOffset() + 1;
    }

    public function getEndRecord()
    {
        $end = $this->getOffset() + $this->perPage;
        return min($end, $this->totalRecords);
    }

    public function render($baseUrl, $params = [])
    {
        if (!$this->hasPages()) {
            return '';
        }

        $html = '<nav aria-label="Page navigation"><ul class="pagination m-0">';

        // Previous button
        if ($this->hasPrevious()) {
            $url = $this->buildUrl($baseUrl, $this->getPreviousPage(), $params);
            $html .= '<li class="page-item"><a class="page-link" href="' . $url . '"><i class="ti ti-chevron-left"></i></a></li>';
        } else {
            $html .= '<li class="page-item disabled"><span class="page-link"><i class="ti ti-chevron-left"></i></span></li>';
        }

        // Page numbers
        foreach ($this->getPageNumbers() as $page) {
            if ($page === '...') {
                $html .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
            } else {
                $url = $this->buildUrl($baseUrl, $page, $params);
                $active = ($page == $this->currentPage) ? 'active' : '';
                $html .= '<li class="page-item ' . $active . '"><a class="page-link" href="' . $url . '">' . $page . '</a></li>';
            }
        }

        // Next button
        if ($this->hasNext()) {
            $url = $this->buildUrl($baseUrl, $this->getNextPage(), $params);
            $html .= '<li class="page-item"><a class="page-link" href="' . $url . '"><i class="ti ti-chevron-right"></i></a></li>';
        } else {
            $html .= '<li class="page-item disabled"><span class="page-link"><i class="ti ti-chevron-right"></i></span></li>';
        }

        $html .= '</ul></nav>';

        return $html;
    }

    public function renderInfo()
    {
        if ($this->totalRecords == 0) {
            return 'Không có dữ liệu';
        }
        return 'Hiển thị ' . $this->getStartRecord() . ' - ' . $this->getEndRecord() . ' / ' . $this->totalRecords . ' bản ghi';
    }

    private function buildUrl($baseUrl, $page, $params)
    {
        $params['page'] = $page;
        $queryString = http_build_query($params);
        $separator = (strpos($baseUrl, '?') !== false) ? '&' : '?';
        return $baseUrl . $separator . $queryString;
    }
}
