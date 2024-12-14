<?php


namespace App\Observers;
use Carbon\Carbon;

use App\Models\Log;
use App\Models\SousProgramme;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class SousProgObserver
{
    /**
     * Enregistrer une action lorsque le modèle est créé.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function created(SousProgramme $sousProgramme): void
    {
        //\Log::info('sousProgramme created: ' . get_class($sousProgramme));
        $this->logActivity('created', $sousProgramme);
    }
  /**
     * Enregistrer une action lorsque le modèle est mis à jour.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function updated(SousProgramme $sousProgramme): void
    {
          // Récupérer les changements effectués sur le modèle
          $changes = $sousProgramme->getChanges();

          // Récupérer les données originales avant la mise à jour
          $original = $sousProgramme->getOriginal();

          // Enregistrer les changements dans les logs
          \Log::info("Modifications sur le modèle sousProgramme", $changes);

          // Utilisez logActivity pour enregistrer l'action avec les données
          $this->logActivity('updated', $sousProgramme, $changes, $original);


    }

    /**
     * Enregistrer une action lorsque le modèle est supprimé.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function deleted(SousProgramme $sousProgramme): void
    {
        $this->logActivity('deleted', $sousProgramme);
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
