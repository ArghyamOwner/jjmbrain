<?php

namespace App\Http\Livewire\PanchayatPayment;

use App\Models\Panchayat;
use App\Models\PanchayatPayment;
use App\Traits\InteractsWithBanner;
use App\Traits\WithExportToCsv;
use Livewire\Component;

class Index extends Component
{
    use WithExportToCsv;
    use InteractsWithBanner;
    
    public $year;
    public $month;
    public $district;

    protected $queryString = [
        'district' => ['except' => ''],
    ];

    public function resetFilter()
    {
        $this->reset([
            'district',
        ]);
    }

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
        $data = $this->panchayatPaymentsData();

        $results = [];
        foreach ($data as $result) {
            $results[] = [
                'Scheme' => $result['scheme'],
                'District' => $result['district'],
                'Block' => $result['block'],
                'Panchayat' => $result['panchayat'],
                'Consumer_No' => $result['apdcl'],
                'Total FHTC' => $result['fhtc'],
                'Payment_Month' => $this->month.'-'.$this->year,
                // 'Chemical' => isset($result['Chemical_status']) ? $result['Chemical_status'] : '-',
                'Chemical_amount' => isset($result['Chemical_amount']) ? $result['Chemical_amount'] : '-',
                // 'Electricity_Bill' => isset($result['Electricity_Bill_status']) ? $result['Electricity_Bill_status'] : '-',
                'Electricity_Bill_amount' => isset($result['Electricity_Bill_amount']) ? $result['Electricity_Bill_amount'] : '-',
                // 'Jalmitra_Salary' => isset($result['Jalmitra_Salary_status']) ? $result['Jalmitra_Salary_status'] : '-',
                'Jalmitra_Salary_amount' => isset($result['Jalmitra_Salary_amount']) ? $result['Jalmitra_Salary_amount'] : '-',
                // 'Maintenance_Salary' => isset($result['Maintenance_status']) ? $result['Maintenance_status'] : '-',
                'Maintenance_Salary_amount' => isset($result['Maintenance_amount']) ? $result['Maintenance_amount'] : '-',
                // 'Other' => isset($result['Other_status']) ? $result['Other_status'] : '-',
                'Other_amount' => isset($result['Other_amount']) ? $result['Other_amount'] : '-',
            ];
        }

        if (count($results)) {
            return $this->exportToCsv($results, 'o_and_m_report_'.$result['district'].'_'.$this->month.'-'.$this->year.'.csv');
        } else {
            $this->notify('Data not found', 'error');
            return redirect()->back();
        }
    }

    public function panchayatPaymentsData()
    {
        $panchayats = [];
        $user = auth()->user();
        if (auth()->user()->isBlockUser()) {
            $panchayats = Panchayat::query()->whereIn('block_id', auth()->user()->blocks->pluck('id'))->pluck('id')->all();
        }

        $result = [];
        $schemePayments = PanchayatPayment::query()
            ->select('scheme_id', 'payment_date', 'month', 'year', 'amount_for', 'panchayat_id', 'amount_paid')
            ->with('scheme:id,name,consumer_no,planned_fhtc,district_id,work_status,operating_status', 'panchayat', 'scheme.district', 'scheme.blocks')
            ->when($this->month, fn($query) => $query->where('month', $this->month))
            ->when($this->year, fn($query) => $query->where('year', $this->year))
            ->when($user->isPanchayat(), function ($query) use ($user) {
                $query->where('panchayat_id', $user->panchayat_id);
            })
            ->when($user->isBlockUser(), function ($query) use ($panchayats) {
                $query->whereIn('panchayat_id', $panchayats);
            })
            ->when($user->isCeoZp() || $user->isDc(), function ($query) use ($user) {
                $query->whereIn('district_id', $user->districts->pluck('id')->all());
            })
            ->when($this->district != '', fn($query) => $query->where('district_id', $this->district))
            ->orderBy('scheme_id')
            ->orderBy('payment_date')
            ->lazy();

        foreach ($schemePayments as $payment) {
            $schemeId = $payment->scheme_id;
            if (!isset($result[$schemeId])) {
                $result[$schemeId] = [
                    'scheme' => $payment->scheme?->name,
                    'work_status' => $payment->scheme?->work_status,
                    'operating_status' => $payment->scheme?->operating_status,
                    'district' => $payment->scheme?->district?->name,
                    'panchayat' => $payment->panchayat?->panchayat_name ?? '-',
                    'block' => $payment->scheme?->block_names ?? '-',
                    'apdcl' => $payment->scheme?->consumer_no ?? '-',
                    'amount' => $payment->amount_paid,
                    'fhtc' => $payment->scheme?->planned_fhtc,
                    'Chemical' => ['amount' => 0, 'date' => 'No'],
                    'Electricity_Bill' => ['amount' => 0, 'date' => 'No'],
                    'Jalmitra_Salary' => ['amount' => 0, 'date' => 'No'],
                    'Maintenance' => ['amount' => 0, 'date' => 'No'],
                    'Other' => ['amount' => 0, 'date' => 'No'],
                ];
            }

            // Determine the category and sum the amount
            switch ($payment->amount_for->value) {
                case 'Chemical':
                    $result[$schemeId]['Chemical']['amount'] += $payment->amount_paid;
                    $result[$schemeId]['Chemical']['date'] = 'Yes (' . date('M', strtotime($payment->payment_date)) . ')';
                    break;
                case 'Electricity_Bill':
                    $result[$schemeId]['Electricity_Bill']['amount'] += $payment->amount_paid;
                    $result[$schemeId]['Electricity_Bill']['date'] = 'Yes (' . date('M', strtotime($payment->payment_date)) . ')';
                    break;
                case 'Jalmitra_Salary':
                    $result[$schemeId]['Jalmitra_Salary']['amount'] += $payment->amount_paid;
                    $result[$schemeId]['Jalmitra_Salary']['date'] = 'Yes (' . date('M', strtotime($payment->payment_date)) . ')';
                    break;
                case 'Maintenance':
                    $result[$schemeId]['Maintenance']['amount'] += $payment->amount_paid;
                    $result[$schemeId]['Maintenance']['date'] = 'Yes (' . date('M', strtotime($payment->payment_date)) . ')';
                    break;
                case 'Other':
                    $result[$schemeId]['Other']['amount'] += $payment->amount_paid;
                    $result[$schemeId]['Other']['date'] = 'Yes (' . date('M', strtotime($payment->payment_date)) . ')';
                    break;
            }
            $result[$schemeId][$payment->amount_for->value . '_status'] = $result[$schemeId][$payment->amount_for->value]["date"];
            $result[$schemeId][$payment->amount_for->value . '_amount'] = $result[$schemeId][$payment->amount_for->value]["amount"];
        }

        // Convert associative array to indexed array
        return array_values($result);
    }

    public function render()
    {

        return view('livewire.panchayat-payment.index', [
            'payments' => $this->panchayatPaymentsData(),
        ]);
    }
}
