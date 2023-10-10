<?php

namespace App\Http\Middleware;

use Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function checkLangStored()
    {
        if (Cookie::get('lang')) {
            App::setLocale(Cookie::get('lang'));
        } else {
            Cookie::queue(Cookie::forever("lang", "ar"));
            App::setLocale("ar");
        }

    }
    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param \Illuminate\Http\Request $request
     * @return array
     */

    public function share(Request $request): array
    {

        $this->checkLangStored();
        $auth = $request->user();
        return array_merge(parent::share($request), [
            'appName' => __('admin/main.edarah'),
            'lang' => app()->getLocale(),
            'isDark' => Cookie::get('dark-mode'),
            'auth' => fn() => $auth ?
            [
                'id' => $auth->id,
                'name' => $auth->name,
                'email' => $auth->email,
                'permissionsOnModels' => $auth->permissionsOnModels(['User']),
            ] : null,
            'routes' => [
                'app' => route('admin.index'),
                'login' => route('admin.login'),
                'authenticate' => route('admin.authenticate'),
                'logout' => route('admin.logout'),
                'changeLang' => route('admin.changeLang', ':lang'),
                'darkToggle' => route('admin.darkToggle'),
                'users' => route('admin.users.index'),

            ],
            'flashMessage' => fn() => [
                'success' => $request->session()->get('success'),
                'error' => $request->session()->get('error'),
            ],

        ]);
    }
}
