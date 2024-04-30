<?php

namespace App\Providers\Filament;

use Filament\Facades\Filament;
use Filament\Panel;
use Illuminate\Support\ServiceProvider;

abstract class PanelProvider extends ServiceProvider
{
     abstract function panel(Panel $panel):Panel;

    public function register(): void
    {
        Filament::registerPanel(
            $this->panel(Panel::make())

        );
    }
}
