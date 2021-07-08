<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Egg;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Widgets\Card;

class EggController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Egg(['user']), function (Grid $grid) {
            $grid->model()->orderBy('id', 'desc');
            $grid->column('id')->sortable();
            $grid->column('female_name')->filter(
                Grid\Column\Filter\Equal::make()
            );
            $grid->column('female_avatar')->image('', 40, 40);
            $grid->column('male_name')->filter(
                Grid\Column\Filter\Equal::make()
            );
            $grid->column('male_avatar')->image('', 40, 40);
            $grid->column('is_break')->display(function ($value) {
                return $value == 1 ? '已破壳': '未破壳';
            })->dot([
                1 => 'success'
            ])->filter(
                Grid\Column\Filter\In::make([
                    0 => '未破壳',
                    1 => '已破壳',
                ])
            );;
            $grid->column('cat_number');
            $grid->column('user.open_id')->display('详情') // 设置按钮名称
            ->expand(function () {
                $card = new Card('用户open_id', $this->user->open_id);
                return "<div style='padding:10px 10px 0'>$card</div>";
            })->filter(Grid\Column\Filter\Equal::make());
            $grid->column('created_at')->sortable()->filter(
                Grid\Column\Filter\Between::make()->datetime()
            );

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
        return Show::make($id, new Egg(), function (Show $show) {
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
        return Form::make(new Egg(), function (Form $form) {
            $form->display('id');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
