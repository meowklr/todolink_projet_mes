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

        // Formater la date correctement avec heure à 09:00 (format ISO 8601)
        $dateTime = $task->task_date;
        try {
            if ($dateTime instanceof \DateTime) {
                // Ajouter l'heure 09:00:00
                $dateTime->setTime(9, 0, 0);
                $dateString = $dateTime->format('Y-m-d\TH:i:s\Z');
            } else {
                // Convertir la string en DateTime et ajouter l'heure
                $date = new \DateTime($dateTime);
                $date->setTime(9, 0, 0);
                $dateString = $date->format('Y-m-d\TH:i:s\Z');
            }
        } catch (\Exception $e) {
            // Fallback: utiliser juste la date en YYYY-MM-DD
            $dateString = substr((string)$dateTime, 0, 10);
        }

        // Trouver l'email du collaborateur si disponible et valide
        $assignedEmail = null;
        try {
            if (!empty($task->username)) {
                $user = \App\Models\User::where('name', $task->username)
                    ->orWhere('username', $task->username)
                    ->first();
                if ($user && filter_var($user->email ?? '', FILTER_VALIDATE_EMAIL)) {
                    $assignedEmail = $user->email;
                }
            }
        } catch (\Exception $e) {
            \Log::warning("Impossible de récupérer l'email du collaborateur: " . $e->getMessage());
        }

        $payload = [
            'action' => 'create_event',
            'task_id' => $task->id,
            'title' => (string)$task->title,
            'description' => (string)($task->description ?? 'Pas de description'),
            'assigned_to' => (string)$task->username,
            'assigned_email' => $assignedEmail,
            'date' => $dateString, // Format ISO 8601: 2026-05-06T09:00:00Z (9h du matin à la date limite)
            'created_by' => auth()->user()?->email ?? 'system@app.com',
            'calendar_types' => ['google', 'outlook'],
            'timestamp' => now()->toIso8601String(),
        ];

        \Log::info('🔗 Appel Make.com webhook', [
            'url' => $this->webhookUrl,
            'task_id' => $task->id,
            'date' => $dateString,
        ]);

        try {
            $response = Http::timeout(10)->post($this->webhookUrl, $payload);

            \Log::info('📨 Réponse Make.com', [
                'status' => $response->status(),
                'headers' => $response->headers(),
                'body' => substr($response->body(), 0, 500),
            ]);

            if ($response->successful()) {
                \Log::info("✅ Événement calendrier créé pour la tâche {$task->id}");
                return true;
            }

            \Log::error("❌ Erreur Make.com : {$response->status()}", [
                'body' => $response->body(),
                'task_id' => $task->id,
            ]);
            return false;
        } catch (\Exception $e) {
            \Log::error("❌ Erreur création événement", [
                'exception' => $e->getMessage(),
                'task_id' => $task->id,
                'trace' => $e->getTraceAsString(),
            ]);
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
