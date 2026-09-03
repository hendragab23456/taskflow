<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Projects Statistics
        |--------------------------------------------------------------------------
        */

        $totalProjects = Project::count();

        $activeProjects = Project::where('status', 'active')->count();

        $completedProjects = Project::where('status', 'completed')->count();


        /*
        |--------------------------------------------------------------------------
        | Tasks Statistics
        |--------------------------------------------------------------------------
        */

        $totalTasks = Task::count();

        $pendingTasks = Task::where('status', 'pending')->count();

        $inProgressTasks = Task::where('status', 'in_progress')->count();

        $completedTasks = Task::where('status', 'completed')->count();


        /*
        |--------------------------------------------------------------------------
        | Upcoming Tasks
        |--------------------------------------------------------------------------
        */

        $upcomingTasks = Task::with('project')
            ->whereNotNull('due_date')
            ->whereDate('due_date', '>=', now())
            ->where('status', '!=', 'completed')
            ->orderBy('due_date', 'asc')
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Latest Projects
        |--------------------------------------------------------------------------
        */

        $latestProjects = Project::withCount('tasks')
            ->latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Dashboard View
        |--------------------------------------------------------------------------
        */

        return view('dashboard', compact(
            'totalProjects',
            'activeProjects',
            'completedProjects',

            'totalTasks',
            'pendingTasks',
            'inProgressTasks',
            'completedTasks',

            'upcomingTasks',
            'latestProjects'
        ));
    }
}

