<?php

$spaces = [
    'driver'   => 's3',
    'key'      => env('DO_SPACES_KEY'),
    'secret'   => env('DO_SPACES_SECRET'),
    'endpoint' => env('DO_SPACES_ENDPOINT'),
    'region'   => env('DO_SPACES_REGION'),
    'bucket'   => env('DO_SPACES_BUCKET'),
];

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
        ],

        'logos' => array_merge($spaces, ['root' => 'jjm/logos']),
        'profile' => array_merge($spaces, ['root' => 'jjm/profile']),
        'comments' => array_merge($spaces, ['root' => 'jjm/comments']),
        'uploads' => array_merge($spaces, ['root' => 'jjm/uploads', 'visibility' => 'public']),
        'helpdesk' => array_merge($spaces, ['root' => 'jjm/helpdesk', 'visibility' => 'public']),
        'subtaskreports' => array_merge($spaces, ['root' => 'jjm/subtaskreports', 'visibility' => 'public']),
        'activity' => array_merge($spaces, ['root' => 'jjm/activity']),
        'wuc' => array_merge($spaces, ['root' => 'jjm/wuc']),
        'workorderdocs' => array_merge($spaces, ['root' => 'jjm/workorderdocs', 'visibility' => 'public']),
        'beneficiaries' => array_merge($spaces, ['root' => 'jjm/beneficiaries', 'visibility' => 'public']),
        'canaltracking' => array_merge($spaces, ['root' => 'jjm/canal', 'visibility' => 'public']),
        'canaltrackingGeoJson' => array_merge($spaces, ['root' => 'jjm/canaltrackingGeoJson', 'visibility' => 'public']),
        'reports' => array_merge($spaces, ['root' => 'jjm/reports', 'visibility' => 'public']),
        'banner' => array_merge($spaces, ['root' => 'jjm/banner', 'visibility' => 'public']),
        'office' => array_merge($spaces, ['root' => 'jjm/office', 'visibility' => 'public']),
        'grievances' => array_merge($spaces, ['root' => 'jjm/grievances', 'visibility' => 'public']),
        'pipeline' => array_merge($spaces, ['root' => 'jjm/pipe_line', 'visibility' => 'public']),
        'flowmeter' => array_merge($spaces, ['root' => 'jjm/flowmeter', 'visibility' => 'public']),
        'flowmeterScan' => array_merge($spaces, ['root' => 'jjm/flowmeter-scan', 'visibility' => 'public']),
        'esrComplaint' => array_merge($spaces, ['root' => 'jjm/esrComplaint', 'visibility' => 'public']),
        'backups' => array_merge($spaces, ['root' => 'jjm/backups', 'visibility' => 'public']),
        'asset' => array_merge($spaces, ['root' => 'jjm/asset', 'visibility' => 'public']),
    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
