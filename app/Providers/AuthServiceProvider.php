<?php 

namespace App\Providers;

use App\Models\Company;
use App\Models\User;
use App\Policies\CompanyPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Company::class => CompanyPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
