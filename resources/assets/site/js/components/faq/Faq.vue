<template>
    <div>
        <div class="bg-white dark:bg-gray-700 rounded-md shadow-sm p-2 mb-2" v-show="!isEditing">
            <h5 class="mb-3 dark:text-white">{{ faq.title }}</h5>

            <div class="flex items-center gap-2">
                <a class="btn btn-blue text-sm cursor-pointer" @click="showForm">ویرایش</a>
                <a class="btn btn-red text-sm cursor-pointer" @click="deleteFaq(faq)">حذف</a>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-700 rounded-md shadow-sm p-3 mb-4" v-show="isEditing">

                    <input type='text' class="mb-2 rounded-md shadow-sm border-gray-300 focus:border-primary-100 transition block mt-1 w-full" v-model="faq.title" placeholder="عنوان">
                    <textarea class="mb-2 w-full rounded-md focus:ring-0 border-gray-200 transition text-sm leading-loose text-gray-500" v-model="faq.desc" placeholder="توضیحات..."></textarea>
                    <a class="btn btn-blue cursor-pointer" @click="hideForm">ویرایش</a>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['faq'],

        data() {
            return {
                isEditing: false,
            };
        },
        methods: {
            showForm() {
                this.isEditing = true;
            },
            hideForm() {
                this.isEditing = false;
            },
            deleteFaq(faq) {
                this.$emit('delete-faq', faq);
            },
        },
    };
</script>
