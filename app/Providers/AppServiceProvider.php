<?php

namespace App\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->resolving(Schedule::class, function($schedule){
            //fetch all the active tasks
            $tasks = app('App\Task')->where('is_active', true)->get();
            // schedule the tasks
            foreach($tasks as $task){
                $event = $schedule->exec($task->command);
                $event->cron($task->expression)->before(function() use ($event){
                    $event->start = microtime(true);
                })->after(function() use ($event, $task){
                    $elapsed_time = microtime(true) - $event->start;
                    if(file_exists(storage_path('task-'.sha1($task->command . $task->expression)))){
                        $output = file_get_contents(storage_path('task-'.sha1($task->command . $task->expression)));
                        $task->results()->create([
                            'duration' => $elapsed_time * 1000,
                            'result' => $output
                        ]);
                        unlink(storage_path('task-'.sha1($task->command . $task->expression)));
                    }
                })->sendOutputTo(storage_path('task-'.sha1($task->command . $task->expression)));

                if($task->dont_overlap){
                    $event->withoutOverlapping();
                }

                if($task->run_in_maintenance){
                    $event->evenInMaintenanceMode();
                }

            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
