<?php

namespace App\Http\Livewire\PanchayatPayment;

use App\Models\District;
use App\Traits\WithExportToCsv;
use Livewire\Component;

class IndexCommissioner extends Component
{
    use WithExportToCsv;
    
    public $year;
    public $month;

    public function mount()
    {
        $this->year = date('Y');
        $this->month = date('n');
    }

    public function getMonthsProperty()
    {
        return config('freshman.paymentMonths');
    }

    public function export()
    {
        $data = $this->districtData();

        $results = [];
        foreach ($data as $result) {
            $results[] = [
                'District' => $result->name,
                'Schemes_Count' => $result->parent_schemes_count,
                'Handover_Schemes' => $result->parent_handover_schemes_count,
                'Payment_Month' => $this->month.'-'.$this->year,
                'Jalmitra_Payment' => $result->jalmitraPanchayatPayments,
                'Electricity_Payment' => $result->electricalPanchayatPayments,
                'Chemical_Payment' => $result->chemicalPanchayatPayments,
                'Maintenance_Payment' => $result->maintenancePanchayatPayments,
                'Other_Payment' => $result->otherPanchayatPayments,
            ];
        }

        if (count($results)) {
            return $this->exportToCsv($results, 'o_and_m_report_expense_'.$this->month.'-'.$this->year.'.csv');
        } else {
            $this->notify('Data not found', 'error');
            return redirect()->back();
        }
    }


    public function districtData()
    {
        $user = auth()->user();
        return District::query()
            ->withCount([
                'parentSchemes',
                'parentHandoverSchemes',
                'electricalPanchayatPayments AS electricalPanchayatPayments' => function ($query) {
                    $query->where('year', $this->year)
                        ->where('month', $this->month);
                },
                'chemicalPanchayatPayments AS chemicalPanchayatPayments' => function ($query) {
                    $query->where('year', $this->year)
                        ->where('month', $this->month);
                },
                'jalmitraPanchayatPayments AS jalmitraPanchayatPayments' => function ($query) {
                    $query->where('year', $this->year)
                        ->where('month', $this->month);
                },
                'maintenancePanchayatPayments AS maintenancePanchayatPayments' => function ($query) {
                    $query->where('year', $this->year)
                        ->where('month', $this->month);
                },
                'otherPanchayatPayments AS otherPanchayatPayments' => function ($query) {
                    $query->where('year', $this->year)
                        ->where('month', $this->month);
                },
            ])
            ->when($user->isDc() || $user->isCeoZp(),
                fn($query) => $query->whereIn('id', $user->districts()->pluck('district_id')))
            ->orderBy('name')    
            ->get();
    }

    public function render()
    {
        return view('livewire.panchayat-payment.index-commissioner', [
            'districts' => $this->districtData(),
        ]);
    }
}
