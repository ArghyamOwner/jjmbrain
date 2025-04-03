<?php

namespace App\Http\Livewire\PanchayatPayment;

use App\Enums\PanchayatPaymentTypes;
use App\Enums\PanchayatPaymentTypesCeoZp;
use App\Enums\PanchayatPaymentTypesPanchayat;
use App\Models\PanchayatPayment;
use App\Models\Scheme;
use App\Traits\InteractsWithBanner;
use Carbon\Carbon;
use Livewire\Component;

class Create extends Component
{
    use InteractsWithBanner;

    public $scheme;
    public $schemeId;
    public $panchayat_id;
    public $wuc_id;
    // public $wuc_ack;
    public $amountPaid;
    public $amount_for;
    public $payment_date;
    public $transaction_id;
    public $payment_made_on;
    // public $created_by;

    public function mount(Scheme $scheme)
    {
        $this->scheme = $scheme->loadMissing('panchayats', 'wucs');
        $this->schemeId = $scheme->id;
    }

    public function save()
    {
        $validatedData = $this->validate([
            'panchayat_id' => ['required'],
            'wuc_id' => ['required'],
            // 'wuc_ack' => ['required'],
            'amountPaid' => ['required'],
            'amount_for' => ['required'],
            'payment_date' => ['required', 'date', 'before_or_equal:today'],
            'transaction_id' => ['required'],
            'payment_made_on' => ['required', 'date', 'before_or_equal:today'],
            // 'created_by' => ['required'],
        ], [], [
            'payment_date' => 'Payment for Month',
            'payment_made_on' => 'Date of Payment',
        ]);

        $carbonDate = Carbon::parse($validatedData['payment_date']);
        $month = $carbonDate->format('n');
        $year = $carbonDate->format('Y');
        $exists = PanchayatPayment::query()
            ->where('month', $month)
            ->where('year', $year)
            ->where('scheme_id', $this->schemeId)
            ->where('amount_for', $validatedData['amount_for'])
            ->exists();

        if ($exists) {
            return $this->notify($validatedData['amount_for'] . ' Payment for the month already exists', 'error');
        }

        $amountPaid = str_replace(',', '', $validatedData['amountPaid']);

        if ($validatedData['amount_for'] == 'Jalmitra_Salary') {
            if ($amountPaid < 6500) {
                return $this->notify('Salary Must be grated than 6500', 'error');
            }
        }

        if ($validatedData['amount_for'] == 'Chemical') {
            if ($amountPaid < 500) {
                return $this->notify('Chemical payment should not be less then 500', 'error');
            }
        }

        $this->scheme->panchayatPayments()->create($validatedData + [
            'jalmitra_id' => $this->scheme->user_id,
            'district_id' => $this->scheme->district_id,
            'amount_paid' => $amountPaid,
            'month' => $month,
            'year' => $year,
        ]);

        $this->banner('Scheme details saved.');
        return redirect()->route('schemes.show', [$this->schemeId, 'tab' => 'details']);
    }

    public function getPanchayatPaymentTypesProperty()
    {
        if (auth()->user()->isCeoZp()) {
            return PanchayatPaymentTypesCeoZp::cases();
        }
        if (auth()->user()->isPanchayat()) {
            return PanchayatPaymentTypesPanchayat::cases();
        }
        return PanchayatPaymentTypes::cases();
    }

    public function render()
    {
        return view('livewire.panchayat-payment.create', [
            'currentDate' => date('Y-m-d'),
            'panchayatOptions' => $this->scheme->panchayats?->pluck('panchayat_name', 'id')->all(),
            'wucOptions' => $this->scheme->wucs?->pluck('name', 'id')->all(),
        ]);
    }
}
