<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Ad;
use App\Models\Poster;
use Carbon\Carbon;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class AdController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Ad(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('image')->image('', 100, 100);
            $grid->column('url');
            $grid->column('status')->display(function ($value) {
                return $value == \App\Models\Ad::STATUS_ONLINE ? '上线' : '下线';
            })->dot([
                \App\Models\Ad::STATUS_ONLINE => 'success',
                \App\Models\Ad::STATUS_OFFLINE => 'error',
            ]);
            $grid->column('display_times');
            $grid->column('display_interval');
            $grid->column('start_time');
            $grid->column('end_time');
            $grid->column('created_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
            });
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
        return Show::make($id, new Ad(), function (Show $show) {
            $show->field('id');
            $show->field('image')->image();
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
        return Form::make(new Ad(), function (Form $form) {
            $form->display('id');
            $form->text('title');
            $form->image('image')->removable()->autoUpload()->required()->uniqueName();
            $form->switch('status')->options([
                \App\Models\Ad::STATUS_ONLINE => '上线',
                \App\Models\Ad::STATUS_OFFLINE => '下线',
            ]);
            $form->number('display_times')->default(1);
            $form->number('display_interval')->placeholder('单位：天')->default(1);
            $form->datetime('start_time')->default(Carbon::now()->toDateTimeString());
            $form->datetime('end_time')->default(Carbon::now()->addWeek()->startOfDay()->toDateTimeString());
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
