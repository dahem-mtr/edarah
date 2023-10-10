<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;
use App\Models\{User, Permission};

class UpdateUsersPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateUsersPermissions';

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'Update users permissions';

    /**
     *  modelsUpdated
     *
     * @var array
     */

    public  $modelsUpdated = [];
    /**
     * Execute the console command.
     *
     * @return array
     */


    public function models()
    {
        $models = [];
        foreach (File::allFiles(app_path('Models')) as $class) {
            $model = str_replace(".php", "", $class->getFilename());
            $actions = app("App\Models\\" . $model)->actions;
            if ($actions) {
                $models[$model] = $actions;
            }
        }
        return $models;
    }

    public function oldModelsDelete($models)
    {
        $q = Permission::whereNotIn('model', array_keys($models));
        $oldModels = array_unique($q->pluck('model')->toArray());
        $q->delete();

        if ($oldModels) {
            $this->warn("Deleted models that previously had permissions");
            $this->warn(" >  " . implode(", ", $oldModels));
            $this->warn(" The permissions of the old models were deleted and they were withdrawn from the roles");
            return true;
        }

        return false;
    }
    public function deleteOldPermissions($models)
    {


        foreach ($models as $model => $permissions) {
            $q = Permission::where('model', $model)->whereNotIn('name', $permissions)->get();

            if (count($q) > 0) {
                $this->modelsUpdated[$model]['deleted'] = $q->pluck('name')->toArray();
                $q->toQuery()->delete();
            }
        }

    }
    public function createNewPermissions($models)
    {

        foreach ($models as $model => $permissions) {

            $PermissionArray = Permission::where('model', $model)->pluck('name')->toArray();
            $newPermissions = [];
            $arr = [];

            foreach ($permissions as $permission) {
                if (!in_array($permission, $PermissionArray)) {
                    $newPermissions[] = ['name' => $permission, 'model' => $model];
                    $arr[] = $permission;
                }
            }
            if (count($newPermissions) > 0) {
                Permission::insert($newPermissions);
                $this->modelsUpdated[$model]['created'] = $arr;
            }

        }



    }

    public function updatedPermissions($models)
    {
        $this->deleteOldPermissions($models);
        $this->createNewPermissions($models);


        if ($this->modelsUpdated) {
            $this->newLine();
            $this->line("Models permissions updated");

            foreach ($this->modelsUpdated as $model => $permissions) {
                if (!empty($permissions['deleted']))
                    $this->warn($model . ' removed permissions: [' . implode(",", $permissions['deleted']) . ']');
                if (!empty($permissions['created']))
                    $this->info($model . ' created permissions: [' . implode(",", $permissions['created']) . ']');

            }
            return true;
        }
        return false;

    }

    public function handle()
    {


        $models = $this->models();
       $isUpdated = $this->oldModelsDelete($models);

        $isUpdated = $this->updatedPermissions($models);


        if (!$isUpdated) {
            $this->line("nothing here to update");
        }


    }

}
