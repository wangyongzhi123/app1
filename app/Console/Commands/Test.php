<?php

namespace App\Console\Commands;

use App\Service\BeiSen\AttendanceService;
use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $attendanceService = new AttendanceService();
//        $attendanceService->getAttendanceOpen('2024-07-1',$page=1,$pageSize=200);
        $attendanceService->setData('2024-08-1',1,200);

    }
}
