<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeComponentServiceProvider extends ServiceProvider
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
        // Admin
        Blade::component('_layouts.master', 'cms-master');

        Blade::component('_layouts.header', 'cms-header');
        Blade::component('_layouts.left_sidebar', 'cms-left-sidebar');
        Blade::component('_layouts.right_sidebar', 'cms-right-sidebar');
        Blade::component('_layouts.footer', 'cms-footer');

        // UI Elements
        Blade::component('_components.ui-elements.breadcrumb', 'breadcrumb');
        Blade::component('_components.ui-elements.error', 'error');
        Blade::component('_components.ui-elements.success', 'success');
        Blade::component('_components.ui-elements.team-card', 'team-card');

        //Radio Elements
        Blade::component('_components.ui-elements.radio-base', 'radio-base');
        Blade::component('_components.radio-elements.radio-input-fields', 'radio-field');

        // Form Elements
        Blade::component('_components.ui-elements.form-base', 'form-base');
        Blade::component('_components.form-elements.input-field', 'input-field');
        Blade::component('_components.form-elements.select-field', 'select-field');
        Blade::component('_components.form-elements.text-area-field', 'text-area-field');
        Blade::component('_components.form-elements.file-field', 'file-field');
        Blade::component('_components.form-elements.button', 'button');
        Blade::component('_components.form-elements.switch', 'switch');
        Blade::component('_components.form-elements.file-browser-image', 'file-browser-image');
        Blade::component('_components.form-elements.file-gallery-image', 'file-gallery-image');
        Blade::component('_components.form-elements.select-2', 'select-searchable');
    }
}
