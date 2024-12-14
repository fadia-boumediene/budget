<?php

namespace App\Observers;

use App\Models\ConstruireDPIA;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
class ConstruireDPIAObserver
{
     /**
     * Enregistrer une action lorsque le modèle est créé.
     *
     * @param Model $model
     * @return void
     */
    public function created(ConstruireDPIA $construireDPIA): void
    {
         //\Log::info('construireDPIA created: ' . get_class($construireDPIA));
         $this->logActivity('created', $construireDPIA);
    }

   /**
     * Enregistrer une action lorsque le modèle est mis à jour.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function updated(ConstruireDPIA $construireDPIA): void
    {
          // Définir l'attribut à exclure
            $excludedAttributes = ['date_modification_dpia'];

            // Récupérer les changements effectués sur le modèle, en excluant les attributs spécifiés
            $changes = array_diff_key($construireDPIA->getChanges(), array_flip($excludedAttributes));

            // Récupérer les données originales avant la mise à jour, en excluant les attributs spécifiés
            $original = array_diff_key($construireDPIA->getOriginal(), array_flip($excludedAttributes));

            // Vérifier s'il reste des changements significatifs
            if (!empty($changes)) {
                // Enregistrer les changements dans les logs
                \Log::info("Modifications sur le modèle ConstruireDPIA", $changes);

                // Utilisez logActivity pour enregistrer l'activité avec les données filtrées
                $this->logActivity('updated', $construireDPIA, $changes, $original);
            }
    }
     /**
     * Enregistrer une action lorsque le modèle est supprimé.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function deleted(ConstruireDPIA $construireDPIA): void
    {
        $this->logActivity('deleted', $construireDPIA);

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
