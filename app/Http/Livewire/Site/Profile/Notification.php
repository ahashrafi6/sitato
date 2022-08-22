<?php

namespace App\Http\Livewire\Site\Profile;

use Livewire\Component;

class Notification extends Component
{
    public $notifications;

    public function mount()
    {
        $this->notifications = auth()->user()->notifications;
    }

    public function updatedNotifications($value, $key)
    {
        $user = auth()->user();
        $notifications = $user->notifications;
        $notifications[$key] = $value;
        $user->notifications = $notifications;
        $user->save();

        $this->emit('success-alert');
    }


    public function render()
    {
        return <<<'blade'
             <div>
        <div class="bg-yellow-100 rounded-md text-sm p-5 mb-8">
            در ادامه میتوانید اعلان ها مختلف موجود را مدیریت کنید. تا در بهترین حالت این اطلاع رسانی ها را دریافت کنید.
        </div>

                <table class="border-collapse table-fixed w-full text-sm">
                    <thead>
                    <tr>
                        <th class="border-b dark:border-gray-600 font-medium p-4 pl-8 pt-0 pb-3 text-right dark:text-white">
                            عملیات
                        </th>
                        <th class="border-b dark:border-gray-600 font-medium p-4 pt-0 pb-3 text-right dark:text-white">
                            پیامک
                        </th>
                        <th class="border-b dark:border-gray-600 font-medium p-4 pr-8 pt-0 pb-3 text-right dark:text-white">
                            ایمیل
                        </th>
                        <th class="border-b dark:border-gray-600 font-medium p-4 pr-8 pt-0 pb-3 text-right dark:text-white">
                            اعلانات سایت
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-700 transition duration-500">
                    <tr>
                        <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                            ورود به سایت
                            <span class="text-xs text-red-400">بزودی</span>
                        </td>

                        <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                            <input type="checkbox"
                                   disabled
                                   class="cursor-not-allowed bg-gray-100 rounded border-gray-300 text-primary-400 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                        </td>
                        <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                            <input type="checkbox"
                                   disabled
                                   class="cursor-not-allowed bg-gray-100 rounded border-gray-300 text-primary-400 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                        </td>
                        <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                            <input type="checkbox"
                                   disabled
                                   class="cursor-not-allowed bg-gray-100 rounded border-gray-300 text-primary-400 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                            خرید محصول
                        </td>

                        <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                            <input wire:model="notifications.cart_sms" type="checkbox"
                                   class="cursor-pointer rounded border-gray-300 text-primary-400 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                        </td>
                        <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                            <input wire:model="notifications.cart_email" type="checkbox"
                                   class="cursor-pointer rounded border-gray-300 text-primary-400 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                        </td>
                        <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                          <input type="checkbox"
                                   disabled
                                   class="cursor-not-allowed bg-gray-100 rounded border-gray-300 text-primary-400 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                        </td>
                    </tr>

                    <tr>
                        <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                            دریافت پاسخ تیکت
                        </td>

                        <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                            <input  wire:model="notifications.ticket_reply_sms" type="checkbox"
                                   class="cursor-not-allowed bg-gray-100 rounded border-gray-300 text-primary-400 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                        </td>
                        <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                            <input wire:model="notifications.ticket_reply_email" type="checkbox"
                                   class="cursor-pointer rounded border-gray-300 text-primary-400 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                        </td>
                        <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                            <input wire:model="notifications.ticket_reply_database" type="checkbox"
                                   class="cursor-pointer rounded border-gray-300 text-primary-400 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                        </td>
                    </tr>
                    <tr>
                        <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                            یادآوری سررسید تمدید سرور
                        </td>

                        <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                            <input wire:model="notifications.server_factor_sms" type="checkbox"
                                   class="cursor-not-allowed bg-gray-100 rounded border-gray-300 text-primary-400 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                        </td>
                        <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                            <input wire:model="notifications.server_factor_email" type="checkbox"
                                   class="cursor-pointer rounded border-gray-300 text-primary-400 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                        </td>
                        <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                            <input wire:model="notifications.server_factor_database" type="checkbox"
                                   class="cursor-pointer rounded border-gray-300 text-primary-400 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                        </td>
                    </tr>
                    </tbody>
                </table>

        </div>
        blade;
    }
}
