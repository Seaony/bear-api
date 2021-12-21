<?php

namespace App\Admin\Charts;

use App\Models\Egg;
use Carbon\Carbon;
use Dcat\Admin\Admin;
use Dcat\Admin\Widgets\Metrics\Bar;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CatNumber extends Bar
{
    /**
     * 初始化卡片内容
     */
    protected function init()
    {
        parent::init();

        $color = Admin::color();

        $dark35 = $color->dark35();

        // 卡片内容宽度
        $this->contentWidth(5, 7);
        // 标题
        $this->title('生产小猫数量分布');
        // 设置下拉选项
        $this->dropdown([
            'all' => 'All',
            '30' => 'Last Month',
        ]);
    }

    /**
     * 处理请求
     *
     * @param Request $request
     *
     * @return mixed|void
     */
    public function handle(Request $request)
    {
        $days = $request->get('option', 'all');
        // Todo: 慢查询优化
        $query = Egg::selectRaw('cat_number, count(*) as count')->whereNotNull('cat_number');
        if ($days !== 'all') {
            $query = $query->where('cracked_at', '>=', Carbon::now()->addDays(-$days));
        }
        $data = $query->groupBy('cat_number')->get();
        $result = $data->pluck('count', 'cat_number')->toArray();

        // 图表数据
        $this->withChart([
            [
                'name' => '数量',
                'data' => array_values($result),
            ],
        ], array_keys($result));

        // 卡片内容
        arsort($result);
        $maxNum = array_key_first($result);
        $maxCount = $result[$maxNum];
        $this->withContent("众数:{$maxNum}", "共{$maxCount}条");
    }

    /**
     * 设置图表数据.
     *
     * @param array $data
     * @param array $xaxis
     *
     * @return $this
     */
    public function withChart(array $data, array $xaxis)
    {
        return $this->chart([
            'series' => $data,
            'xaxis.categories' => $xaxis
        ]);
    }

    /**
     * 设置卡片内容.
     *
     * @param string $title
     * @param string $value
     * @param string $style
     *
     * @return $this
     */
    public function withContent($title, $value, $style = 'success')
    {
        // 根据选项显示
        $label = strtolower(
            $this->dropdown[request()->option] ?? 'last 7 days'
        );

        $minHeight = '183px';

        return $this->content(
            <<<HTML
<div class="d-flex p-1 flex-column justify-content-between" style="padding-top: 0;width: 100%;height: 100%;min-height: {$minHeight}">
    <div class="text-left">
        <h1 class="font-lg-2 mt-2 mb-0">{$title}</h1>
        <h5 class="font-medium-2" style="margin-top: 10px;">
            <span class="text-{$style}">{$value} </span>
            <span>in {$label}</span>
        </h5>
    </div>

    <a href="#" class="btn btn-primary shadow waves-effect waves-light">View Details <i class="feather icon-chevrons-right"></i></a>
</div>
HTML
        );
    }
}
