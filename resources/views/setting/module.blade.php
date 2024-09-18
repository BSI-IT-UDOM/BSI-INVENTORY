@extends('layouts.setting')

@section('content')
<div class="max-w-screen-lg mx-auto p-6 space-y-4 bg-gray-100 border-2 mb-2">
    <div class="container mx-auto p-4">
        <div class="overflow-hidden rounded-lg shadow-lg bg-white">
            <form action="#">
                <table class="min-w-full bg-white border border-zinc-200">
                    <thead>
                        <tr class="bg-zinc-100">
                            <th class="p-4 border-b border-zinc-200 text-left">Module</th>
                            <th class="p-4 border-b border-zinc-200 bg-green-500 text-white">Admin</th>
                            <th class="p-4 border-b border-zinc-200 bg-red-500 text-white">Owner</th>
                            <th class="p-4 border-b border-zinc-200 bg-blue-500 text-white">Inventory</th>
                            <th class="p-4 border-b border-zinc-200 bg-yellow-500 text-white">Seller</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Dashboard Module -->
                        <tr>
                            <td class="p-4 border-b border-zinc-200">Dashboard</td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="dashboard-admin" checked class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="dashboard-owner" checked class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="dashboard-inventory" class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="dashboard-seller" class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                        </tr>
                        <!-- Inventory Module -->
                        <tr class="bg-zinc-100">
                            <td class="p-4 border-b border-zinc-200">Inventory</td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="inventory-admin" checked class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="inventory-owner" checked class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="inventory-inventory" class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="inventory-seller" class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                        </tr>
                        <!-- Suppliers Module -->
                        <tr>
                            <td class="p-4 border-b border-zinc-200">Suppliers</td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="suppliers-admin" checked class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="suppliers-owner" checked class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="suppliers-inventory" class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="suppliers-seller" class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                        </tr>
                        <!-- Items Module -->
                        <tr class="bg-zinc-100">
                            <td class="p-4 border-b border-zinc-200">Items</td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="items-admin" checked class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="items-owner" checked class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="items-inventory" class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="items-seller" class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                        </tr>
                        <!-- Orders Module -->
                        <tr>
                            <td class="p-4 border-b border-zinc-200">Orders</td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="orders-admin" checked class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="orders-owner" checked class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="orders-inventory" class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="orders-seller" class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                        </tr>
                        <!-- POS Module -->
                        <tr class="bg-zinc-100">
                            <td class="p-4 border-b border-zinc-200">POS</td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="pos-admin" checked class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="pos-owner" class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="pos-inventory" class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="pos-seller" class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                        </tr>
                        <!-- Products Module -->
                        <tr>
                            <td class="p-4 border-b border-zinc-200">Products</td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="products-admin" checked class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="products-owner" checked class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="products-inventory" class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="products-seller" class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                        </tr>
                        <!-- Add-ons Module -->
                        <tr class="bg-zinc-100">
                            <td class="p-4 border-b border-zinc-200">Add-ons</td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="addons-admin" checked class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="addons-owner" checked class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="addons-inventory" class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="addons-seller" class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                        </tr>
                        <!-- Sales Module -->
                        <tr>
                            <td class="p-4 border-b border-zinc-200">Sales</td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="sales-admin" checked class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="sales-owner" checked class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="sales-inventory" class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="sales-seller" class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                        </tr>
                        <!-- Reports Module -->
                        <tr class="bg-zinc-100">
                            <td class="p-4 border-b border-zinc-200">Reports</td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="reports-admin" checked class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="reports-owner" checked class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="reports-inventory" class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="reports-seller" class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                        </tr>
                        <!-- Accounting Module -->
                        <tr>
                            <td class="p-4 border-b border-zinc-200">Accounting</td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="accounting-admin" checked class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="accounting-owner" checked class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="accounting-inventory" class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="accounting-seller" class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                        </tr>
                        <!-- Settings Module -->
                        <tr class="bg-zinc-100">
                            <td class="p-4 border-b border-zinc-200">Settings</td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="settings-admin" checked class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="settings-owner" checked class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="settings-inventory" class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                            <td class="p-4 border-b border-zinc-200 text-center">
                                <input type="checkbox" name="settings-seller" class="form-checkbox w-4 h-4 text-teal-500">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-end mt-6 mr-2 mb-2">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection