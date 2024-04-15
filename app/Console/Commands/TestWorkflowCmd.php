<?php

namespace App\Console\Commands;

use App\Workflows\Simple\SimpleWorkflow;
use App\Workflows\Test\TestWorkflow;
use Illuminate\Console\Command;
use Workflow\WorkflowStub;

class TestWorkflowCmd extends Command
{
    protected $signature = 'workflow:test';

    protected $description = 'Runs a workflow';

    public function handle()
    {
        $workflow = WorkflowStub::make(TestWorkflow::class);
        $workflow->start([
            'test' => 'test',
        ]);
        while ($workflow->running()) {
            usleep(100);
        }
        $this->info(print_r($workflow->output(), true));
    }
}
