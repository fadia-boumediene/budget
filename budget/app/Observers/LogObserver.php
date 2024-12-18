<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use App\Models\Portefeuille;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LogObserver
{
     /**
     * Enregistrer une action lorsque le modèle est créé.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    /*public function created(Model $model)

    {    \Log::info('Model created: ' . get_class($model));
        $this->logActivity('created', $model);
    }*/

    public function created(Portefeuille $portefeuille)
{
    \Log::info('Portefeuille created: ' . get_class($portefeuille));
    $this->logActivity('created', $portefeuille);
}

    /**
     * Enregistrer une action lorsque le modèle est mis à jour.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function updated(Portefeuille $portefeuille)
    {

        // Récupérer les changements effectués sur le modèle
        $changes = $portefeuille->getChanges();

        // Vous pouvez maintenant utiliser la variable $changes
        // Par exemple, enregistrer dans les logs ou dans une base de données
        \Log::info("Modifications sur le modèle Portefeuille", $changes);

        // Si vous avez une méthode pour loguer l'activité (logActivity), vous pouvez l'utiliser
        $this->logActivity('updated', $portefeuille, $changes);
    }

    /**
     * Enregistrer une action lorsque le modèle est supprimé.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function deleted(Model $model)
    {
        $this->logActivity('deleted', $model);
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
        // Assurez-vous que vous récupérez les changements du modèle
    $changes = $model->getChanges();

    // Vérifiez si des changements existent
    if (!empty($changes)) {
        // Loggez l'action et les changements
        \Log::info("Action: {$action}, Model: {$model->getMorphClass()}, Changes: " . json_encode($changes));
    } else {
        // Si pas de changements, vous pouvez loguer différemment
        \Log::info("Action: {$action}, Model: {$model->getMorphClass()}, No changes detected.");
    }
        $data = [
            'action' => $action,
            'model' => get_class($model),
            'model_id' => $model->getKey(),
            'original' => $model->getAttributes(),  // Données de l'enregistrement
            'ip_address' => Request::ip(),
        ];

        // Si l'action est une mise à jour, ajouter les changements
        if ($action === 'updated') {
            $data['changed'] = $changed;
            $data['original'] = $original;
        }

        // Créer un enregistrement dans la table logs
        Log::create($data);
    }
}
