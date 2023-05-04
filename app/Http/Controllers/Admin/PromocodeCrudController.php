<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PromocodeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PromocodeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PromocodeCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Promocode::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/promocode');
        CRUD::setEntityNameStrings('promocode', 'promocodes');

        if (!backpack_user()->can('promocodes.create')) {
            CRUD::denyAccess('create');
        }
        if (!backpack_user()->can('promocodes.update')) {
            CRUD::denyAccess('update');
        }

        if (!backpack_user()->can('promocodes.delete')) {
            CRUD::denyAccess('delete');
        }

        if (!backpack_user()->can('promocodes.index')) {
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
        CRUD::column('id');
        CRUD::column('code');
        CRUD::column('start_date');
        CRUD::column('end_date');
        CRUD::column('discount');
        CRUD::column('created_at');
        CRUD::column('updated_at');

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
        CRUD::setValidation(PromocodeRequest::class);

        // CRUD::field('id');
        CRUD::field('code');
        CRUD::field('start_date');
        CRUD::field('end_date');
        // CRUD::field('discount')->type('number');
        CRUD::addField(['name' => 'discount', 'type' => 'number', 'label' => 'Discount (Percentage)']);
        // CRUD::field('created_at');
        // CRUD::field('updated_at');

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
