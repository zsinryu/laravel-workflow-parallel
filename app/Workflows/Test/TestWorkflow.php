<?php

namespace App\Workflows\Test;


use Workflow\ActivityStub;
use Workflow\ChildWorkflowStub;
use Workflow\Workflow;

class TestWorkflow extends Workflow
{
    public function execute(mixed $inputs): mixed
    {
        yield ActivityStub::make(TestActivity::class, [
            'index' => 0,
        ]);

        foreach ([1] as $key => $i) {
            $results[] = yield ChildWorkflowStub::make(TestChildWorkflow::class, [
                'index' => $i,
            ]);
        }

        echo 'TestWorkflow finished';

        return [
            'Workflow' => 'TestWorkflow',
            'inputs' => $inputs,
            'outputs' => $results,
        ];
    }
}
