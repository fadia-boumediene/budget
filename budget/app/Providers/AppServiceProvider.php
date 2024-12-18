<?php

namespace App\Providers;
use App\Models\Action;


use App\Models\initPort;
use App\Models\Operation;
use App\Models\Programme;
use Illuminate\Support\Facades\Schema;
use App\Models\SousAction;
use App\Models\Portefeuille;
use App\Models\ModificationT;
use App\Models\SousOperation;
use App\Models\SousProgramme;
use App\Models\ConstruireDPIA;
use App\Models\ConstruireDPIC;
use App\Models\GroupOperation;
use App\Observers\ActionObserver;
use App\Observers\InitPortObserver;
use App\Observers\SousProgObserver;
use App\Observers\OperationObserver;
use App\Observers\ProgrammeObserver;
use Illuminate\Support\Facades\File;
use App\Observers\SousActionObserver;
use App\Observers\PortefeuilleObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Observers\ModificationTObserver;
use App\Observers\sousoperationObserver;
use App\Observers\ConstruireDPIAObserver;
use App\Observers\ConstruireDPICObserver;
use App\Observers\GroupOperationObserver;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Portefeuille::observe(PortefeuilleObserver::class);
        ConstruireDPIC::observe(ConstruireDPICObserver::class);
        Programme::observe(ProgrammeObserver::class);
        SousProgramme::observe(SousProgObserver::class);
        initPort::observe(InitPortObserver::class);
        Action::observe(ActionObserver::class);
        SousAction::observe(SousActionObserver::class);
        Schema::defaultStringLength(191);
        GroupOperation::observe(GroupOperationObserver::class);
        Operation::observe(OperationObserver::class);
        SousOperation::observe(sousoperationObserver::class);
        SousOperation::observe(sousoperationObserver::class);
        ModificationT::observe(ModificationTObserver::class);
        //ConstruireDPIA::observe(ConstruireDPIAObserver::class);

    }

}
