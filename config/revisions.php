<?php

return [

    /*
    |---------------------------------------------------------------------------
    | Enable / Disable Revisions
    |---------------------------------------------------------------------------
    |
    | Set this option to false to turn off revision logging. This can be helpful
    | in development environments to speed up requests, particularly when
    | creating test data through console commands.
    |
    */

    'enabled' => (bool) env('REVISIONS_ENABLED', false),

    /*
    |---------------------------------------------------------------------------
    | Revision Connection
    |---------------------------------------------------------------------------
    |
    | This will be the database connection used to log revisions. If not
    | specified, the default connection will be used.
    |
    */

    'connection' => env('REVISIONS_CONNECTION') ?: null,

    /*
    |---------------------------------------------------------------------------
    | Revision Retention
    |---------------------------------------------------------------------------
    |
    | Set this option to a positive, non-zero integer to enable pruning of old
    | revisions. Any revisions older than the retention value (in days) will be
    | pruned daily.
    |
    */

    'retention' => env('REVISIONS_RETENTION') ?: null,

];
