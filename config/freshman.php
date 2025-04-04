<?php

return [

    'imagekit_public_key' => env('IMAGEKIT_PUBLIC_KEY'),
    'imagekit_private_key' => env('IMAGEKIT_PRIVATE_KEY'),
    'imagekit_endpoint' => env('IMAGEKIT_ENDPOINT'),

    'roles' => [
        'super-admin' => 'Super Administrator',
        'admin' => 'Administrator',

        'admin-viewer' => 'Admin Viewer',
        'head-office' => 'Chief Engineer Office',

        'superitendent-engineer' => 'Superintendent Engineer',
        'executive-engineer' => 'Executive Engineer',
        'add-chief-engineer' => "Add. Chief Engineer",
        'sdo' => 'SDO',
        'tpa-admin' => 'TPA Admin',
        // 'tpi' => 'TPI',
        'lab-admin' => 'Lab Admin',
        'officer' => 'Officer',
        'accountant' => 'Accountant',
        'staff' => 'Staff',
        'third-party' => 'Third Party',
        'contractor' => 'Contractor',
        'section-officer' => 'Section Officer',
        'call-center' => 'Call Center',
        'dpmu' => 'DPMU User',
        'panchayat' => 'Panchayat',
        'jal-mitra' => 'Jal Mitra',
        'jal-bondhu-shg' => 'Jal Bondhu SHG',
        'wuc' => 'WUC',
        'citizen' => 'Citizen',
        'inspector' => 'Inspector',
        'asrlm-block' => "ASRLM Block",
        'block-user' => "Block User",
        'ceo_zp' => 'CEO-ZP',
        'isa-coordinator' => 'ISA Coordinator',
        'lab-technical-officer' => 'LAB Technical Officer',
        'lab-nodal-officer' => 'LAB Nodal Officer',
        'geology-ho' => 'Geology (H.O.)',
        'lab-ho' => 'Lab (H.O.)',
        'district-jaldoot-cell' => 'District Jaldoot Cell',
        'state-isa' => 'State ISA',
        'state-jaldoot-cell' => 'State Jaldoot Cell',
        'iec-specialist' => 'IEC Specialist',
        'panchayat_commissioner' => 'Panchayat Commissioner',
        'tech-support' => 'Tech-Support',
        'gis-expert' => 'GIS Expert',
        'DC' => 'DC',
        'wuc-auditor' => 'WUC Auditor',
        'iot' => 'IOT',
        'iot-vendor' => 'IOT-Vendor',
    ],

    'permissions' => [
        'create-user',
        'update-user',
        'delete-user',
        'delete-scheme',
    ],

    'browsershot_api_key' => env('BROWSERSHOT_API_KEY'),
    'browsershot_api_secret' => env('BROWSERSHOT_API_SECRET'),
    'browsershot_api_endpoint' => env('BROWSERSHOT_API_ENDPOINT'),

    'global_node_modules_path' => env('BROWSERSHOT_NODE_MODULES_PATH'),
    'global_node_path' => env('BROWSERSHOT_NODE_PATH'),
    'global_npm_path' => env('BROWSERSHOT_NPM_PATH'),
    'chromium_path' => env('PUPPETEER_CHROME_PATH'),

    'razor_pay_merchant_id' => env('RAZOR_PAY_MERCHANT_ID'),
    'razor_pay_key' => env('RAZOR_PAY_KEY'),
    'razor_pay_secret' => env('RAZOR_PAY_SECRET'),
    'razor_pay_webhook_secret' => env('RAZOR_PAY_WEBHOOK_SECRET'),

    'meta' => [
        'title' => 'JJM Portal',
        'description' => 'JJM Portal',
    ],

    'grievance_create' => env('GRIEVANCE_CREATE'),
    'grievance_track' => env('GRIEVANCE_TRACK'),

    'openweather_api_key' => env('OPENWEATHER_API_KEY'),

    'office_types' => [
        'head_office' => 'Head Office',
        'circle_office' => 'Circle Office',
        'division_office' => 'Division Office',
        'zonal_office' => 'Zonal Office',
    ],

    'months' => [
        '01' => 'JAN',
        '02' => 'FEB',
        '03' => 'MAR',
        '04' => 'APR',
        '05' => 'MAY',
        '06' => 'JUN',
        '07' => 'JUL',
        '08' => 'AUG',
        '09' => 'SEP',
        '10' => 'OCT',
        '11' => 'NOV',
        '12' => 'DEC',
    ],

    'paymentMonths' => [
        '1' => 'JAN',
        '2' => 'FEB',
        '3' => 'MAR',
        '4' => 'APR',
        '5' => 'MAY',
        '6' => 'JUN',
        '7' => 'JUL',
        '8' => 'AUG',
        '9' => 'SEP',
        '10' => 'OCT',
        '11' => 'NOV',
        '12' => 'DEC',
    ],

    'image_tags' => [
        'Source',
        'Treatment_Plant',
        'Under_Ground_Reservoir',
        'Pump_house',
        'Boundary_wall',
        'Staff_quarter',
        'Elevated_service_Reservoir',
        'LDS',
        'APDCL',
        'Generator_set',
        'Raw_water_Pump',
        'Clear_water_pump',
        'Internal_Connection',
        'Beautification',
    ],

    'pipe_type' => [
        'RWPM',
        'RWGM',
        'CWRM',
        'CWPM',
        'Distribution',
    ],

    'pipe_size' => [
        '700',
        '600',
        '350',
        '300',
        '250',
        '225',
        '200',
        '180',
        '160',
        '150',
        '140',
        '125',
        '110',
        '100',
        '90',
        '80',
        '75',
        '65',
        '63',
        '50',
        '40',
        '35',
        '32',
        '25',
        '15',
    ],

    'pipe_size_color' => [
        '15' => '#a83b74',
        '25' => '#f39dbb',
        '32' => '#3e75ab',
        '35' => '#f9fc2f',
        '40' => '#a985fe',
        '50' => '#1B1B1B',
        '63' => '#1f77b4',
        '65' => '#387c49',
        '75' => '#ff7f0e',
        '80' => '#2ca02c',
        '90' => '#d62728',
        '100' => '#FA5661',
        '110' => '#9467bd',
        '125' => '#8c564b',
        '140' => '#e377c2',
        '150' => '#0CB43A',
        '160' => '#7f7f7f',
        '180' => '#bcbd22',
        '200' => '#17becf',
        '225' => '#f0f8ff',
        '250' => '#faebd7',
        '300' => '#00ffff',
        '350' => '#7fffd4',
        '600' => '#f0ffff',
        '700' => '#f5f5dc',
    ],

    'pipe_quality' => [
        "HDPE",
        "PVC/UPVC",
        "OPVC",
        "MS",
        "DI",
        "CI",
        "GI",
        "Others",
    ],

    'apps' => [
        'OFFICER_APP',
        'CONTRACTOR_APP',
        'JALMITRA_APP',
        'WUC_APP',
    ],

    'drilling_types' => [
        'rotary',
        'reverse_rotary',
        'odex_rig',
        'dth',
        'hand_boring',
    ],

    'hole_diameters' => [
        "7.2", "8.0", "8.5", "10", "12", "14", "16", "18", "20",
    ],

    'casing_sizes' => [
        "4", "6", "8", "10", "12", "14",
    ],

    'compressor_capacity_units' => [
        "cfm",
        "psi",
    ],

    'daily_flowmeter_status' => [
        'Not_Installed',
        'Working',
        'Not_Working',
    ],

    'funding_agencies' => [
        'SAGY',
        'JJM',
        'NRDWP',
        'NWQSM',
        'NNP',
        'SWAJAL',
    ],
];
