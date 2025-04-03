<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum WaterDisruptionStatus: string
{

    use EnumToArray;

    case CLOSED = 'closed';
    case RESOLVED = 'resolved';
    case APPROVED = 'approved';
    case PENDING = 'pending';


    public static function toArray(): array
    {
        return [
            self::PENDING->value => self::PENDING->label(),
            self::APPROVED->value => self::APPROVED->label(),
            self::RESOLVED->value => self::RESOLVED->label(),
            self::CLOSED->value => self::CLOSED->label(),
        ];
    }


    public function color(): string
    {
        return match ($this) {
            self::CLOSED => 'success',
            self::RESOLVED => 'info',
            self::APPROVED => 'warning',
            self::PENDING => 'danger',
            default => 'secondary',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::CLOSED => 'Resolved',
            self::RESOLVED => 'Resolution Approval Pending',
            self::APPROVED => 'Waiting for Resolution',
            self::PENDING => 'Pending at SDO for Approval',
            default => '--',
        };
    }
}
