<?php

namespace App\Observers;
use Illuminate\Database\Eloquent\Model;

use App\Models\SousAction;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
class SousActionObserver
{
    /**
     * Handle the SousAction "created" event.
     */
    public function created(SousAction $sousAction): void
    {
        //\Log::info('sousAction created: ' . get_class($sousAction));
        $this->logActivity('created', $sousAction);
    }
   /**
     * Enregistrer une action lorsque le modèle est mis à jour.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function updated(SousAction $sousAction): void
    {
        // Récupérer les changements effectués sur le modèle
        $changes = $sousAction->getChanges();
        // Récupérer les données originales avant la mise à jour
        $original = $sousAction->getOriginal();
        // Enregistrer les changements dans les logs
        \Log::info("Modifications sur le modèle sousAction", $changes);
        // Utilisez logActivity pour enregistrer la sousAction avec les données
        $this->logActivity('updated', $sousAction, $changes, $original);
    }

    /**
     * Enregistrer une action lorsque le modèle est supprimé.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function deleted(SousAction $sousAction): void
    {
        $this->logActivity('deleted', $sousAction);
    }
   /**
     * Enregistrer l'activité dans la table logs.
     *
     * @param string $action
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array|null $changed
     * @param array|null $original
     * @return void
     */
    protected function logActivity(string $action, Model $model, array $changed = null, array $original = null)
    {
        // Construire les données pour les logs
        $data = [
            'action' => $action,
            'model' => get_class($model),
            'model_id' => $model->getKey(),
            'ip_address' => Request::ip(),
        ];

        // Si l'action est une mise à jour, séparer les données
        if ($action === 'updated' && $changed) {
            $data['original'] = $original; // Données avant modification
            $data['changed'] = $changed; // Données après modification
        } else {
            $data['original'] = $model->getAttributes(); // Pour les autres actions (created, deleted)
        }

        // Enregistrer les logs dans la table
        Log::create($data);

        // Log supplémentaire pour le débogage (facultatif)
        \Log::info("Action: {$action}, Model: {$model->getMorphClass()}, Log Data: " . json_encode($data));
    }
}
