<?php

namespace App\Console\Commands;

use App\Workflows\Simple\SimpleWorkflow;
use Illuminate\Console\Command;
use Workflow\WorkflowStub;

class SimpleWorkflowCmd extends Command
{
    protected $signature = 'workflow:simple';

    protected $description = 'Runs a workflow';

    public function handle()
    {
        $workflow = WorkflowStub::make(SimpleWorkflow::class);
        $workflow->start();
        while ($workflow->running()) {
            usleep(100);
        }
        $this->info($workflow->output());
    }
}
