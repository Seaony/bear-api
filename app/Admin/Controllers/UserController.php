<?php

namespace App\Admin\Controllers;

use App\Admin\Renderable\EggTable;
use App\Admin\Repositories\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class UserController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new User(), function (Grid $grid) {
            $grid->model()->withCount(['eggs'])->orderBy('id', 'desc');
            $grid->column('id')->sortable()->filter(
                Grid\Column\Filter\Equal::make()
            );
            $grid->column('open_id')->filter(
                Grid\Column\Filter\Equal::make()
            );
            // 可以在闭包内返回异步加载类的实例
            $grid->column('eggs_count')->sortable()->expand(function () {
                return EggTable::make()->simple();
            });
            $grid->column('created_at')->sortable();
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new User(), function (Show $show) {
            $show->field('id');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new User(), function (Form $form) {
            $form->display('id');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
