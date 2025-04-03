<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WucMember extends Model
{
    use HasFactory;
    use HasUlids;

    const TYPE_EXECUTIVE_COMMITTEE = 'executive_committee';
    const TYPE_INVITED_MEMBERS = 'invited_members';

    const DESIGNATION_PRESIDENT = 'president';
    const DESIGNATION_VICE_PRESIDENT = 'vice_president';
    const DESIGNATION_SECRETARY = 'secretary';
    const DESIGNATION_TREASURER = 'treasurer';
    const DESIGNATION_MEMBER = 'member';

    const DESIGNATION_GP_PRESIDENT = "gp_president";
    const DESIGNATION_WARD_MEMBER = "ward_member";
    const DESIGNATION_PHED_SO = "phed_so";

    protected $appends = [
        'designation_name',
    ];

    public static function getDesignationOptions()
    {
        return [
            self::DESIGNATION_PRESIDENT => "President",
            self::DESIGNATION_VICE_PRESIDENT => "Vice President",
            self::DESIGNATION_SECRETARY => "General Secretary",
            self::DESIGNATION_TREASURER => "Treasurer",
            self::DESIGNATION_MEMBER => "General Member",
            self::DESIGNATION_GP_PRESIDENT => "GP President",
            self::DESIGNATION_WARD_MEMBER => "Ward Member",
            self::DESIGNATION_PHED_SO => "PHED Sectional Officer",
        ];
    }

    public function getDesignationNameAttribute()
    {
        $list = self::getDesignationOptions();
        return isset($list[$this->designation]) ? $list[$this->designation] : 'Not Defined';
    }

    protected $fillable = [
        'wuc_id',
        'name',
        'phone',
        'email',
        'type',
        'designation',
        'user_id',
    ];

    public function wuc()
    {
        return $this->belongsTo(Wuc::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
