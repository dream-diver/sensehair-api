<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CareerApplicationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CareerApplicationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CareerApplicationCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\CareerApplication::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/career-application');
        CRUD::setEntityNameStrings('career application', 'career applications');

        if (!backpack_user()->can('users.create')) {
            CRUD::denyAccess('create');
        }
        if (!backpack_user()->can('users.update')) {
            CRUD::denyAccess('update');
        }

        if (!backpack_user()->can('users.delete')) {
            CRUD::denyAccess('delete');
        }

        if (!backpack_user()->can('users.index')) {
            CRUD::denyAccess('list');
        }
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('type');
        CRUD::column('employment');
        CRUD::column('hrsWeek');
        CRUD::column('weekDays');
        CRUD::column('firstName');
        CRUD::column('lastName');
        CRUD::column('dob');
        CRUD::column('email');
        CRUD::column('phone');
        CRUD::column('address');
        CRUD::column('zip');
        CRUD::column('city');
        CRUD::column('education1');
        CRUD::column('education2');
        CRUD::column('education3');
        CRUD::column('exp1');
        CRUD::column('exp2');
        CRUD::column('exp3');
        CRUD::column('motivation');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CareerApplicationRequest::class);

        CRUD::field('type');
        CRUD::field('employment');
        CRUD::field('hrsWeek');
        CRUD::field('weekDays');
        CRUD::field('firstName');
        CRUD::field('lastName');
        CRUD::field('dob');
        CRUD::field('email');
        CRUD::field('phone');
        CRUD::field('address');
        CRUD::field('zip');
        CRUD::field('city');
        CRUD::field('education1');
        CRUD::field('education2');
        CRUD::field('education3');
        CRUD::field('exp1');
        CRUD::field('exp2');
        CRUD::field('exp3');
        CRUD::field('motivation');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
