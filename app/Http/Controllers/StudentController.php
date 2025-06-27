<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterNumberRequest;
use Illuminate\Http\Request;
use App\Models\Student;
use IcehouseVentures\LaravelChartjs\Builder;
use Illuminate\Http\JsonResponse;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    private array $subjects = ['toan', 'ngu_van',  'ngoai_ngu', 'vat_li', 'hoa_hoc', 'sinh_hoc', 'lich_su', 'dia_li', 'gdcd'];
    private array $colors = [
        'rgba(38, 185, 154, 0.31)',
        'rgba(3, 88, 106, 0.3)',
        'rgba(255, 99, 132, 0.3)',
        'rgba(54, 162, 235, 0.3)',
        'rgba(255, 206, 86, 0.3)',
        'rgba(75, 192, 192, 0.3)',
        'rgba(153, 102, 255, 0.3)',
        'rgba(255, 159, 64, 0.3)',
        'rgba(0, 200, 83, 0.3)',
    ];
    //
    public function show(Request $req): JsonResponse
    {
        // $req->input('q');
        $sbd = $req->query('q');

        if (empty($sbd) || strlen($sbd) < 8 || strlen($sbd) > 8) {
            return response()->json(['message' => 'Số báo danh không hợp lệ (phải gồm 8 ký tự)'], 400);
        }

        $student = Student::where('sbd', $sbd)->first();

        if (!$student) {
            return response()->json(['message' => 'Không tìm thấy thí sinh'], 404);
        }
        return response()->json($student);
    }

    private function _scores(): array
    {
        $result = [];
        foreach ($this->subjects as $subject) {
            $result[] = "COUNT(CASE WHEN {$subject} >= 8 THEN 1 END) AS {$subject}_gt_8";
            $result[] = "COUNT(CASE WHEN {$subject} >= 6 AND {$subject} < 8 THEN 1 END) AS {$subject}_gte_6_lt_8";
            $result[] = "COUNT(CASE WHEN {$subject} >= 4 AND {$subject} < 6 THEN 1 END) AS {$subject}_gte_4_lt_6";
            $result[] = "COUNT(CASE WHEN {$subject} < 4 THEN 1 END) AS {$subject}_lt_4";
        }
        $query = DB::table('exam_scores')->selectRaw(implode(",\n", $result))->first();
        return (array)  $query;
    }

    private function _chartScore(): Builder
    {
        $data = $this->_scores();

        $borderColors = array_map(function ($color) {
            return str_replace('0.3', '1', $color);
        }, $this->colors);

        $i = 0;
        $datasets = [];

        foreach ($this->subjects as $subject) {
            $datasets[] = [
                'label' => ucfirst(str_replace('_', ' ', $subject)),
                'backgroundColor' => $this->colors[$i % count($this->colors)],
                'borderColor' => $borderColors[$i % count($borderColors)],
                'pointBorderColor' => $borderColors[$i % count($borderColors)],
                'pointBackgroundColor' => $this->colors[$i % count($this->colors)],
                'pointHoverBackgroundColor' => '#fff',
                'pointHoverBorderColor' => "rgba(220,220,220,1)",
                'fill' => false,
                'data' => [
                    $data["{$subject}_lt_4"],
                    $data["{$subject}_gte_4_lt_6"],
                    $data["{$subject}_gte_6_lt_8"],
                    $data["{$subject}_gt_8"],
                ],
            ];
            $i++;
        }

        $chartData = Chartjs::build()
            ->name('lineChart')
            ->type('line')
            ->size(['width' => 200, 'height' => 100])
            ->labels(['< 4 points', '6 points > && >= 4 points', '8 points > && >=6 points', '>=8 points'])
            ->datasets($datasets)->options([]);
        return $chartData;
    }

    public function chart()
    {
        $chart = $this->_chartScore();
        return view('dashboard', compact('chart'));
    }

    public function Top10A()
    {
        $top10 = Student::orderByRaw('(COALESCE(toan,0) + COALESCE(vat_li,0) + COALESCE(hoa_hoc,0)) DESC')
            ->limit(10)->get();
        return view('reports', compact('top10'));
    }
}
