<?php

namespace App\Admin\Controllers;

use App\Admin\Charts\CatNumber;
use App\Admin\Charts\NewUsers;
use App\Admin\Metrics\Examples;
use App\Http\Controllers\Controller;
use Dcat\Admin\Http\Controllers\Dashboard;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->header('Dashboard')
            ->description('Description...')
            ->body(function (Row $row) {
                $row->column(6, function (Column $column) {
                    $column->row(Dashboard::title());
                    $column->row(new Examples\Tickets());
                });

                $row->column(6, function (Column $column) {
                    $column->row(function (Row $row) {
                        $row->column(6, new NewUsers());
                        $row->column(6, new Examples\NewDevices());
                    });

                    $column->row(new CatNumber());
                    $column->row(new Examples\ProductOrders());
                });
            });
    }
}
