<?php

namespace App\Observers;

use App\Models\sousoperation;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
class sousoperationObserver
{
     /**
     * Enregistrer une action lorsque le modèle est créé.
     *
     * @param Model $model
     * @return void
     */
    public function created(sousoperation $sousoperation): void
    {
                //\Log::info('sousoperation created: ' . get_class($sousoperation));
                $this->logActivity('created', $sousoperation);
    }

   /**
     * Enregistrer une action lorsque le modèle est mis à jour.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function updated(sousoperation $sousoperation): void
    {
         // Définir les attributs à exclure
        $excludedAttributes = ['date_update_SOUSoperation', 'date_insert_SOUSoperation'];

        // Récupérer les changements effectués sur le modèle, en excluant les attributs spécifiés
        $changes = array_diff_key($sousoperation->getChanges(), array_flip($excludedAttributes));

        // Récupérer les données originales avant la mise à jour, en excluant les attributs spécifiés
        $original = array_diff_key($sousoperation->getOriginal(), array_flip($excludedAttributes));

        // Vérifier s'il reste des changements significatifs
        if (!empty($changes)) {
            // Enregistrer les changements dans les logs
            \Log::info("Modifications sur le modèle sousoperation", $changes);
            // Utilisez logActivity pour enregistrer l'activité avec les données filtrées
            $this->logActivity('updated', $sousoperation, $changes, $original);
        }
    }

     /**
     * Enregistrer une action lorsque le modèle est supprimé.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function deleted(sousoperation $sousoperation): void
    {
        $this->logActivity('deleted', $sousoperation);
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
