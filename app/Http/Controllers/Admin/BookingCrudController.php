<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BookingRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BookingCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BookingCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Booking::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/booking');
        CRUD::setEntityNameStrings('booking', 'bookings');

        // if (!backpack_user()->can('bookings.create')) {
        //     CRUD::denyAccess('create');
        // }
        // if (!backpack_user()->can('bookings.update')) {
        //     CRUD::denyAccess('update');
        // }
        CRUD::denyAccess('create');
        CRUD::denyAccess('update');

        if (!backpack_user()->can('bookings.delete')) {
            CRUD::denyAccess('delete');
        }

        if (!backpack_user()->can('bookings.index')) {
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
        // CRUD::column('id');
        CRUD::column('booking_time');
        CRUD::column('charge');
        CRUD::column('duration');
        CRUD::column('customer_id');
        CRUD::column('server_id');
        CRUD::column('promocode_id');
        CRUD::column('name');
        CRUD::column('email');
        CRUD::column('phone');
        // CRUD::column('stripe_client_secret');
        // CRUD::column('stripe_id');
        CRUD::column('payment_status');
        // CRUD::column('deleted_at');
        // CRUD::column('created_at');
        // CRUD::column('updated_at');

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
        CRUD::setValidation(BookingRequest::class);

        // CRUD::field('id');
        CRUD::field('booking_time');
        CRUD::field('charge');
        CRUD::field('duration');
        CRUD::field('customer_id');
        CRUD::field('server_id');
        CRUD::field('promocode_id');
        CRUD::field('name');
        CRUD::field('email');
        CRUD::field('phone');
        // CRUD::field('stripe_client_secret');
        // CRUD::field('stripe_id');
        CRUD::field('payment_status');
        // CRUD::field('deleted_at');
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
