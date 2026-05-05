<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Task;

class CalendarService
{
    private string $webhookUrl;

    public function __construct()
    {
        $this->webhookUrl = env('MAKE_COM_CALENDAR_WEBHOOK', '');
    }

    /**
     * Créer un événement calendrier via Make.com
     */
    public function createCalendarEvent(Task $task): bool
    {
        if (!$this->webhookUrl) {
            \Log::warning('MAKE_COM_CALENDAR_WEBHOOK non configuré');
            return false;
        }

        try {
            $response = Http::timeout(10)->post($this->webhookUrl, [
                'action' => 'create_event',
                'task_id' => $task->id,
                'title' => $task->title,
                'description' => $task->description,
                'assigned_to' => $task->username,
                'date' => $task->task_date,
                'created_by' => auth()->user()?->email ?? 'system',
                'calendar_types' => ['google', 'outlook'], // ou spécifier un seul type
            ]);

            if ($response->successful()) {
                \Log::info("Événement calendrier créé pour la tâche {$task->id}");
                return true;
            }

            \Log::error("Erreur Make.com : {$response->status()}");
            return false;
        } catch (\Exception $e) {
            \Log::error("Erreur création événement : {$e->getMessage()}");
            return false;
        }
    }

    /**
     * Mettre à jour un événement calendrier
     */
    public function updateCalendarEvent(Task $task): bool
    {
        if (!$this->webhookUrl) {
            return false;
        }

        try {
            Http::timeout(10)->post($this->webhookUrl, [
                'action' => 'update_event',
                'task_id' => $task->id,
                'title' => $task->title,
                'date' => $task->task_date,
                'status' => $task->completed_at ? 'completed' : 'pending',
            ]);

            return true;
        } catch (\Exception $e) {
            \Log::error("Erreur mise à jour événement : {$e->getMessage()}");
            return false;
        }
    }

    /**
     * Supprimer un événement calendrier
     */
    public function deleteCalendarEvent(Task $task): bool
    {
        if (!$this->webhookUrl) {
            return false;
        }

        try {
            Http::timeout(10)->post($this->webhookUrl, [
                'action' => 'delete_event',
                'task_id' => $task->id,
            ]);

            return true;
        } catch (\Exception $e) {
            \Log::error("Erreur suppression événement : {$e->getMessage()}");
            return false;
        }
    }
}
