<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum HelpCategories: string
{
    use EnumToArray;
    
    case GETTING_STARTED = "getting-started";
    case TASK_GUIDELINES = "task-guidelines";
    case USER_ACCOUNT = "user-account";
    case OTHERS = "other";

    public function label(): string
    {
        return match($this) {
            self::GETTING_STARTED => 'Getting Started',
            self::TASK_GUIDELINES => 'Tasks Guidelines',
            self::OTHERS => 'Others'
        };
    }

    public static function toOptions(): array 
    {
        return [
            [
                'id' => static::GETTING_STARTED,
                'icon' => 'setting',
                'name' => 'Getting Started',
                'summary' => 'Everything you need to know to get started and get to work in this portal.'
            ],
            [
                'id' => static::TASK_GUIDELINES,
                'icon' => 'lamp-charge',
                'name' => 'Tasks Guidelines',
                'summary' => 'Guidelines to create a task, subtasks, review questions and so on.'
            ],
            [
                'id' => static::USER_ACCOUNT,
                'icon' => 'users',
                'name' => 'User Account',
                'summary' => 'How to reset password, change password, and so on.'
            ],
            [
                'id' => static::OTHERS,
                'icon' => 'info-circle',
                'name' => 'Others',
                'summary' => 'All miscellaneous informations of the portal.'
            ]
        ];
    }
}
