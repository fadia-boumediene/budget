<?php

namespace App\Services;


use App\Models\ConstruireDPIA;

class dpialog
{
    public function ConstruireDpia($userId, $employeeId, $action, $macAddress)
    {
        Log::create([
            'action' => $action,
            'id_nin' => $employeeId,
            'id' => $userId,
            'adresse_mac' => $macAddress,
            'date_action' => now(),
        ]);
    }


   
}
