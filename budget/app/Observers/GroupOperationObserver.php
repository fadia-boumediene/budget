<?php

namespace App\Observers;
use App\Models\GroupOperation;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class GroupOperationObserver
{
     /**
     * Enregistrer une action lorsque le modèle est créé.
     *
     * @param Model $model
     * @return void
     */
    public function created(GroupOperation $groupOperation): void
    {
        //\Log::info('groupOperation created: ' . get_class($groupOperation));
        $this->logActivity('created', $groupOperation);
    }

   /**
     * Enregistrer une action lorsque le modèle est mis à jour.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function updated(GroupOperation $groupOperation): void
    {
        //
    }

     /**
     * Enregistrer une action lorsque le modèle est supprimé.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function deleted(GroupOperation $groupOperation): void
    {
        $this->logActivity('deleted', $groupOperation);

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
