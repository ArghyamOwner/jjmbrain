<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlowmeterResetData extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['scheme_id', 'value', 'created_by', 'scheme_flowmeter_detail_id'];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function schemeFlowmeterDetail()
    {
        return $this->belongsTo(SchemeFlowmeterDetails::class, 'scheme_flowmeter_detail_id');
    }
}
