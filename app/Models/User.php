<?php

namespace App\Models;

use App\Enums\AssignmentTaskStatus;
use App\Traits\WithRoles;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use WithRoles;
    use HasApiTokens;
    use HasUlids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'department_id',
        'district_id',
        'panchayat_id',
        'userable_type',
        'userable_id',
        'email',
        'password',
        'photo',
        'gender',
        'phone',
        'otp',
        'designation',
        'dob',
        'about',
        'role',
        'permissions',
        'meta',
        'last_online_at',
        'email_verified_at',
        'blocked_at',
        'parent_id',
        'doj',
        'joining_document',
        'blocked_by',
        'last_app_login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_online_at' => 'datetime',
        'blocked_at' => 'datetime',
        'last_app_login' => 'datetime',
        'permissions' => 'array',
        'meta' => 'array',
        'dob' => 'date',
        'doj' => 'date',
    ];

    protected $appends = [
        'photo_url',
        'joining_document_url',
        'user_status',
        'user_status_color',
    ];

    /**
     * Get all of the owning userable models.
     */
    public function userable()
    {
        return $this->morphTo();
    }

    public function link()
    {
        return route('admin.users.show', $this->id);
    }

    public function getPhotoUrlAttribute()
    {
        return $this->photo
        ? Storage::disk('profile')->url($this->photo)
        : 'https://api.dicebear.com/7.x/initials/svg/seed=' . urlencode(trim($this->name));
        // : 'https://avatars.dicebear.com/api/initials/'. urlencode(trim($this->name)) .'.png?&width=64&height=64';
    }

    public function scopeActive($query)
    {
        return $query->whereNull('blocked_at');
    }

    public function getJoiningDocumentUrlAttribute()
    {
        return $this->joining_document ? Storage::disk('uploads')->url($this->joining_document) : null;
    }

    public function contractor()
    {
        return $this->hasOne(ContractorDetail::class);
    }

    public function blockedBy()
    {
        return $this->belongsTo(User::class, 'blocked_by');
    }
    
    public function panchayat()
    {
        return $this->belongsTo(Panchayat::class, 'panchayat_id');
    }

    public function workorders()
    {
        return $this->hasMany(Workorder::class, 'contractor_id');
    }

    // Tasks
    public function assignmentTask()
    {
        return $this->hasMany(AssignmentTask::class);
    }

    public function assignmentTaskCompleted()
    {
        return $this->hasMany(AssignmentTask::class)->where('status', AssignmentTaskStatus::COMPLETED);
    }

    public function assignmentTaskOngoing()
    {
        return $this->hasMany(AssignmentTask::class)->where('status', AssignmentTaskStatus::ONGOING);
    }

    public function assignmentTaskNotStarted()
    {
        return $this->hasMany(AssignmentTask::class)->where('status', AssignmentTaskStatus::NOT_STARTED);
    }

    // offices / circles
    public function offices()
    {
        return $this->belongsToMany(Circle::class);
    }

    public function getOfficeNamesAttribute()
    {
        return $this->offices()->exists() ? $this->offices()->pluck('name')->implode(', ') : null;
    }

    public function divisions()
    {
        return $this->belongsToMany(Division::class);
    }

    public function getDivisionNamesAttribute()
    {
        return $this->divisions()->exists() ? $this->divisions()->pluck('name')->implode(', ') : null;
    }

    public function subdivisions()
    {
        return $this->belongsToMany(Subdivision::class);
    }

    public function getSubdivisionNamesAttribute()
    {
        return $this->subdivisions()->exists() ? $this->subdivisions()->pluck('name')->implode(', ') : null;
    }

    public function likes(): HasMany
    {
        return $this->hasMany(NewsLike::class);
    }

    public function getPhoneFormattedAttribute()
    {
        if ($this->phone) {
            $part1 = substr($this->phone, 0, 4);
            $part2 = substr($this->phone, 4, 3);
            $part3 = substr($this->phone, 7, 3);

            $formattedPhoneNumber = implode(' ', [$part1, $part2, $part3]);

            return $formattedPhoneNumber; // Output: 1234-567-890
        }

        return null;
    }

    public function getUserStatusAttribute()
    {
        return !is_null($this->blocked_at) ? 'blocked' : 'active';
    }

    public function getUserStatusColorAttribute()
    {
        return match ($this->user_status) {
            'blocked' => 'danger',
            'active' => 'success',
            default => 'info'
        };
    }

    public function districts()
    {
        return $this->belongsToMany(District::class);
    }

    public function getDistrictNamesAttribute()
    {
        return $this->districts()->exists() ? $this->districts()->pluck('name')->implode(', ') : null;
    }

    public function districtsThroughDivision(): HasManyThrough
    {
        return $this->hasManyThrough(District::class, Division::class);
    }

    public function blocks()
    {
        return $this->belongsToMany(Block::class);
    }

    public function getBlockNamesAttribute()
    {
        return $this->blocks()->exists() ? $this->blocks()->pluck('name')->implode(', ') : null;
    }

    public function scheme()
    {
        return $this->hasOne(Scheme::class);
    }

    public function parentSchemes()
    {
        return $this->schemes()->whereNull('parent_id');
    }

    public function schemes()
    {
        return $this->belongsToMany(Scheme::class);
    }

    public function latestSurvey()
    {
        return $this->hasOne(Survey::class)->latestOfMany();
    }

    /**
     * Get all of the WUCs for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function wucs(): HasManyThrough
    {
        return $this->hasManyThrough(Wuc::class, District::class, '', 'district_user.district_id');
    }

    public function wucMember()
    {
        return $this->hasOne(WucMember::class);
    }

    public function userDetail()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }

    public function labs()
    {
        return $this->belongsToMany(Lab::class);
    }

    public function latestSchemeActivity()
    {
        return $this->hasOne(SchemeActivity::class)->latestOfMany();
    }
}
