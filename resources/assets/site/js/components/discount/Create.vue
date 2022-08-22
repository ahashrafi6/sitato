<template>

    <div class="dir-rtl">
        <div class="grid grid-cols-12 gap-3 mt-5 mb-8">
            <div class="col-span-12 lg:col-span-8 mb-3 lg:mb-0">
                <h4 class="text-2xl font-bold mb-2 dark:text-white">ایجاد کد تخفیف</h4>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-3">

            <div class="col-span-12 mb-3 lg:mb-0">
                <alert-error v-for="item in create_form.errors.all()" :key="item[0]" :form="create_form">{{
                        item[0]
                    }}
                </alert-error>
            </div>

            <div class="col-span-12 lg:col-span-6 mb-3 lg:mb-0">
                <label class="block font-medium text-sm text-gray-700 dark:text-white">کد تخفیف</label>
                <input required v-model="create_form.code" type="text" name="code"
                       class="rounded-md shadow-sm border-gray-300 focus:border-primary-100 transition block mt-1 w-full"
                       placeholder="مثلا noroz">
                <span class="text-xs text-gray-600">تنها کاراکتر های [a-z] ، [0-9] و ( - _) قابل قبول هستند!</span>
            </div>
            <div class="col-span-12  lg:col-span-6 mb-3 lg:mb-0">
                <label class="block font-medium text-sm text-gray-700 dark:text-white">درصد تخفیف</label>
                <input required v-model="create_form.discount" name="discount" type="text"
                       class="rounded-md shadow-sm border-gray-300 focus:border-primary-100 transition block mt-1 w-full"
                       placeholder="مثلا 20">
            </div>
            <div class="col-span-12  lg:col-span-6 mb-3 lg:mb-0">
                <label class="block font-medium text-sm text-gray-700 dark:text-white">عنوان تخفیف</label>
                <input required v-model="create_form.title" name="title" type="text"
                       class="rounded-md shadow-sm border-gray-300 focus:border-primary-100 transition block mt-1 w-full"
                       placeholder="عنوان یا توضیح کوتاه">

            </div>

            <div class="col-span-12  lg:col-span-6 mb-3 lg:mb-0">
                <label class="block font-medium text-sm text-gray-700 dark:text-white">ظرفیت استفاده کل</label>
                <input v-model="create_form.capacity" name="capacity" type="text"
                       class="rounded-md shadow-sm border-gray-300 focus:border-primary-100 transition block mt-1 w-full"
                       placeholder="مثلا 10">
            </div>
            <div class="col-span-12  lg:col-span-6 mb-3 lg:mb-0">
                <label class="block font-medium text-sm text-gray-700 dark:text-white">ظرفیت استفاده هر کاربر</label>
                <input v-model="create_form.capacity_per_user" name="capacity_per_user" type="text"
                       class="rounded-md shadow-sm border-gray-300 focus:border-primary-100 transition block mt-1 w-full"
                       placeholder="مثلا 2">
            </div>


            <div class="col-span-12  lg:col-span-6 mb-3 lg:mb-0">
                <label class="block font-medium text-sm text-gray-700 dark:text-white">محصول</label>

                <v-select multiple v-model="create_form.products" label="fa_title" dir="rtl"
                          :options="products" :filterable="false">
                </v-select>
            </div>

            <div class="col-span-12  lg:col-span-6 mb-3 lg:mb-0">
                <label class="block font-medium text-sm text-gray-700 dark:text-white">تاریخ شروع</label>

                <date-picker placeholder="انتخاب تاریخ" locale="fa,en" format="YYYY-M-D HH:mm"
                             v-model="create_form.start_at" name="start_at" type="datetime"></date-picker>
            </div>
            <div class="col-span-12  lg:col-span-6 mb-3 lg:mb-0">
                <label class="block font-medium text-sm text-gray-700 dark:text-white">تاریخ انقضا</label>

                <date-picker placeholder="انتخاب تاریخ" locale="fa,en" format="YYYY-M-D HH:mm"
                             v-model="create_form.expire_at" name="expire_at" type="datetime"></date-picker>
            </div>


        </div>

        <div class="flex justify-end mt-3">
            <button type="submit" @click="store" :disabled="create_form.busy" class="btn btn-primary">
                ایجاد
            </button>
        </div>

    </div>

</template>

<script>
export default {

    props: ['products'],

    data() {
        return {

            create_form: new Form({
                title: '',
                code: '',
                discount: '',
                capacity: '',
                capacity_per_user: '',
                products: '',
                start_at: '',
                expire_at: '',
            }),
        }
    },
    methods: {

        store() {
            this.create_form.post('/profile/discounts').then(({data}) => {
                if (data.operator) {
                    window.location = '/profile/discounts';
                }
            });
        }
    },
}
</script>
