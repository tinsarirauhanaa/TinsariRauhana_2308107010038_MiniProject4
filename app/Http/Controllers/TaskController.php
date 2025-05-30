<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            if (!Auth::check()) {
                \Log::error('User not authenticated in TaskController@index');
                return redirect()->route('login');
            }

            $today = now()->toDateString();
            \Log::info('Today: ' . $today);
            \Log::info('Logged in user ID: ' . Auth::id());

            $tasks = Task::where('user_id', Auth::id())
                         ->where('date', $today)
                         ->orderBy('time')
                         ->get();
            \Log::info('Tasks fetched: ' . json_encode($tasks));

            return view('dashboard', [
                'tasks' => $tasks,
                'today' => now()->locale('id')->isoFormat('D MMMM YYYY')
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in TaskController@index: ' . $e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Terjadi kesalahan saat memuat jadwal.');
        }
    }

    public function calendar()
    {
        try {
            if (!Auth::check()) {
                \Log::error('User not authenticated in TaskController@calendar');
                return redirect()->route('login');
            }

            $tasks = Task::where('user_id', Auth::id())
                         ->orderBy('date')
                         ->orderBy('time')
                         ->get();
            \Log::info('Tasks fetched for calendar: ' . json_encode($tasks));

            return view('calendar', [
                'tasks' => $tasks
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in TaskController@calendar: ' . $e->getMessage());
            return redirect()->route('calendar')->with('error', 'Terjadi kesalahan saat memuat kalender.');
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'task_name' => 'required|string|max:255',
                'task_desc' => 'required|string',
                'date' => 'required|date',
                'time' => 'required',
            ]);

            $task = Task::create([
                'user_id' => Auth::id(),
                'title' => $validated['task_name'],
                'description' => $validated['task_desc'],
                'date' => $validated['date'],
                'time' => $validated['time'],
                'color' => 'pink', // Default ke pink
            ]);

            \Log::info('Task created: ' . json_encode($task));

            return response()->json([
                'success' => true,
                'message' => 'Jadwal berhasil ditambahkan!',
                'task' => $task
            ], 201);
        } catch (\Exception $e) {
            \Log::error('Error creating task: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan jadwal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, Task $task)
    {
        try {
            if ($task->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses untuk mengedit jadwal ini.'
                ], 403);
            }

            $validated = $request->validate([
                'task_name' => 'required|string|max:255',
                'task_desc' => 'required|string',
                'date' => 'required|date',
                'time' => 'required',
            ]);

            $task->update([
                'title' => $validated['task_name'],
                'description' => $validated['task_desc'],
                'date' => $validated['date'],
                'time' => $validated['time'],
                'color' => 'pink', 
            ]);

            \Log::info('Task updated: ' . $task->id);

            return response()->json([
                'success' => true,
                'message' => 'Jadwal berhasil diupdate!',
                'task' => $task
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Error updating task: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate jadwal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Task $task)
    {
        try {
            if ($task->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses untuk menghapus jadwal ini.'
                ], 403);
            }

            $task->delete();

            \Log::info('Task deleted: ' . $task->id);

            return response()->json([
                'success' => true,
                'message' => 'Jadwal berhasil dihapus!'
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Error deleting task: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus jadwal: ' . $e->getMessage()
            ], 500);
        }
    }
}