<template>
    <div class="dir-rtl">
        <div class="grid grid-cols-12 gap-3 mt-5 mb-8">
            <div class="col-span-12 lg:col-span-8 mb-3 lg:mb-0">
                <h4 class="text-2xl font-bold mb-2 dark:text-white">ویرایش کد تخفیف</h4>
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
                <input disabled v-model="code" type="text" name="code"
                       class="rounded-md bg-gray-200 shadow-sm border-gray-300 focus:border-primary-100 transition block mt-1 w-full"
                       placeholder="مثلا noroz">
            </div>
            <div class="col-span-12  lg:col-span-6 mb-3 lg:mb-0">
                <label class="block font-medium text-sm text-gray-700 dark:text-white">درصد تخفیف</label>
                <input disabled v-model="discount" name="discount" type="text"
                       class="rounded-md bg-gray-200 shadow-sm border-gray-300 focus:border-primary-100 transition block mt-1 w-full"
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
                          :options="product_lists" :filterable="false">
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
                ویرایش
            </button>
        </div>

    </div>
</template>

<script>
export default {
    props: ['product_lists' , 'id' , 'title' , 'code' , 'discount' , 'capacity' , 'capacity_per_user' , 'products' , 'start_at' , 'expire_at'],

    data() {
        return {
            create_form: new Form({
                title: '',
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
            this.create_form.patch(`/profile/discounts/${this.id}`).then(({data}) => {
                if (data.operator) {
                    window.location = '/profile/discounts';
                }
            });
        },

    },
    created() {
        this.create_form.title = this.title;
        this.create_form.products = this.products;
        this.create_form.capacity = this.capacity;
        this.create_form.capacity_per_user = this.capacity_per_user;
        this.create_form.start_at = this.start_at;
        this.create_form.expire_at = this.expire_at;
    },
}
</script>
