<?php

namespace App\Admin\Charts;

use App\Models\User;
use Carbon\Carbon;
use Dcat\Admin\Widgets\Metrics\Line;
use Illuminate\Http\Request;

class NewUsers extends Line
{
    /**
     * 初始化卡片内容
     *
     * @return void
     */
    protected function init()
    {
        parent::init();

        $this->title('New Users');
        $this->dropdown([
            '7' => 'Last 7 Days',
            '30' => 'Last Month',
            '365' => 'Last Year',
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
        $days = $request->get('option', '7');
        // Todo: 慢查询优化
        $query = User::selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') as date, count(id) as num")
            ->where('created_at', '>=', Carbon::now()->addDays(-$days))
            ->groupBy('date');
        $data = $query->get();
        $this->withContent($data->sum('num'));
        // 图表数据
        $this->withChart($data->pluck('num')->toArray());
    }

    /**
     * 设置图表数据.
     *
     * @param array $data
     *
     * @return $this
     */
    public function withChart(array $data)
    {
        return $this->chart([
            'series' => [
                [
                    'name' => $this->title,
                    'data' => $data,
                ],
            ],
        ]);
    }

    /**
     * 设置卡片内容.
     *
     * @param string $content
     *
     * @return $this
     */
    public function withContent($content)
    {
        return $this->content(
            <<<HTML
<div class="d-flex justify-content-between align-items-center mt-1" style="margin-bottom: 2px">
    <h2 class="ml-1 font-lg-1">{$content}</h2>
    <span class="mb-0 mr-1 text-80">{$this->title}</span>
</div>
HTML
        );
    }
}
