<?php

namespace App\Workflows\Test;


use Workflow\ActivityStub;
use Workflow\Workflow;

class TestChildChildWorkflow extends Workflow
{
    public function execute(mixed $inputs): mixed
    {
        $activities = [];

        if ($inputs['index'] === 11) {
            usleep(30000);
        }

        foreach ([1,2,3] as $key => $i) {
            $activities[] = ActivityStub::make(TestActivity::class, [
                'index' => $i,
            ]);
        }

        usleep(3000);

        $results = yield ActivityStub::all($activities);

        return [
            'ChildWorkflow' => 'TestChildWorkflow',
            'inputs' => $inputs,
            'outputs' => $results,
        ];
    }
}
