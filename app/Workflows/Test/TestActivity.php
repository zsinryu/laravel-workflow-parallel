<?php

namespace App\Workflows\Test;

use Workflow\Activity;

class TestActivity extends Activity
{
    public function execute(mixed $inputs): mixed
    {
        usleep(30000);
        return ['Activity' => 'TestActivity', 'inputs' => $inputs, 'outputs' => 'TestActivityOutputs'];
    }
}
