<?php

namespace App\Observers;
use Illuminate\Database\Eloquent\Model;
use App\Models\Action;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActionObserver
{
     /**
     * Enregistrer une action lorsque le modèle est créé.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function created(Action $action): void
    {

        //\Log::info('action created: ' . get_class($action));
        $this->logActivity('created', $action);
    }

   /**
     * Enregistrer une action lorsque le modèle est mis à jour.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function updated(Action $action): void
    {
          // Récupérer les changements effectués sur le modèle
          $changes = $action->getChanges();

          // Récupérer les données originales avant la mise à jour
          $original = $action->getOriginal();

          // Enregistrer les changements dans les logs
          \Log::info("Modifications sur le modèle action", $changes);

          // Utilisez logActivity pour enregistrer l'action avec les données
          $this->logActivity('updated', $action, $changes, $original);
    }


    /**
     * Enregistrer une action lorsque le modèle est supprimé.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function deleted(Action $action): void
    {
        $this->logActivity('deleted', $action);

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
