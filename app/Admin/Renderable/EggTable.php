<?php


namespace App\Admin\Renderable;


use App\Models\Egg;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\LazyRenderable;

class EggTable extends LazyRenderable
{
    public function grid(): Grid
    {
        return Grid::make(new Egg(), function (Grid $grid) {
            $grid->model()->where('user_id', $this->key);
            $grid->column('id');
            $grid->column('female_name');
            $grid->column('female_avatar')->image('', 40, 40);
            $grid->column('male_name');
            $grid->column('male_avatar');
            $grid->column('is_break');
            $grid->column('cat_number');
            $grid->column('created_at')->sortable();
            $grid->paginate(10);
            $grid->disableActions();
            $grid->disableRowSelector();
        });
    }
}
