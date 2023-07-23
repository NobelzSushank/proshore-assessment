<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\RedirectResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function setPageTitle($title, $subTitle)
    {
        view()->share(['pageTitle' => $title, 'subTitle' => $subTitle]);
    }

    protected function responseRedirect(
        $route,
        $message,
        $type = 'info',
        $error = false,
        $withOldInputWhenError = false
    ): RedirectResponse {
        // If there is an error with input, return else, redirect to the route provided.
        return ($error && $withOldInputWhenError)
            ? redirect()->back()->withInput()->with($type, $message)
            : redirect()->route($route)->with($type, $message);
    }

    protected function responseRedirectBack(
        $message,
        $type = 'info',
        $error = false,
        $withOldInputWhenError = false
    ): RedirectResponse {
        return redirect()->back()->with($type, $message);
    }
}
