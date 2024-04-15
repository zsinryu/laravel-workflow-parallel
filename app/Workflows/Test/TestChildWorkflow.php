<?php

namespace App\Workflows\Test;


use Workflow\ActivityStub;
use Workflow\ChildWorkflowStub;
use Workflow\Workflow;

class TestChildWorkflow extends Workflow
{
    public function execute(mixed $inputs): mixed
    {
        $workflows = [];

        yield ActivityStub::make(TestActivity::class, [
            'index' => 0,
        ]);

        foreach ([11,12] as $key => $i) {
            $workflows[] = ChildWorkflowStub::make(TestChildChildWorkflow::class, [
                'index' => $i,
            ]);

            usleep(100);
        }

        $results = yield ChildWorkflowStub::all($workflows);

        return [
            'ChildWorkflow' => 'TestChildWorkflow',
            'inputs' => $inputs,
            'outputs' => $results,
        ];
    }
}
