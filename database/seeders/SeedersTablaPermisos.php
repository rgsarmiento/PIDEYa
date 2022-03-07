<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//spatie
use Spatie\Permission\Models\Permission;

class SeedersTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            //tabla roles
             'roles.index',
             'roles.crear',
             'roles.editar',
             'roles.eliminar',
            //tabla companies
            'companies.index',
            'companies.crear',
            'companies.editar',
            'companies.eliminar',
             //tabla company_has_users
            'company_has_users.index',
            'company_has_users.crear',
            'company_has_users.editar',
            'company_has_users.eliminar',
            //tabla documentos
            'documents.index',
            'documents.editar',
            'documents.eliminar',
            'documents.download',
            

        ];
        foreach($permisos as $permiso){
            Permission::create(['name'=>$permiso]);
        }
    }
}
