<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum ContractorGrievanceTypes: string
{
    use EnumToArray;

    case BILL_RELATED_ISSUE = "bill related issue";
    case SITE_RELATED_ISSUE = "site related issue";
    case ISSUE_WITH_CITIZEN = "issue with citizen";
    case ISSUE_WITH_OFFICE = "issue with office";
}
