<template>
    <div class="mb-4">
        <div class="mb-4">
            <a class="btn btn-primary text-white cursor-pointer" @click="openForm" v-show="!isCreating">سوال جدید</a>
        </div>
        <div class="bg-white dark:bg-gray-700 rounded-md shadow-sm p-3" v-show="isCreating">
            <input class="mb-2 rounded-md shadow-sm border-gray-300 focus:border-primary-100 transition block mt-1 w-full"
                   v-model="titleFaq" type='text' placeholder="عنوان">
            <textarea
                class="mb-2 w-full rounded-md focus:ring-0 border-gray-200 transition text-sm leading-loose text-gray-500"
                v-model="descriptionFaq" placeholder="توضیحات"></textarea>

          <div class="flex items-center gap-3">
              <a class="btn btn-blue cursor-pointer" @click="sendForm">ایجاد</a>
              <a class="btn btn-gray cursor-pointer" @click="closeForm">لغو</a>
          </div>

        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            titleFaq: '',
            descriptionFaq: '',
            isCreating: false,
        };
    },
    methods: {
        openForm() {
            this.isCreating = true;
        },
        closeForm() {
            this.isCreating = false;
        },
        sendForm() {
            if (this.titleFaq.length > 0 && this.descriptionFaq.length > 0) {
                const title = this.titleFaq;
                const desc = this.descriptionFaq;
                const data = {
                    title,
                    desc
                };
                this.$emit('add-faq', data);
                this.titleFaq = '';
                this.descriptionFaq = '';
            }
            this.isCreating = false;
        },
    },
};
</script>
