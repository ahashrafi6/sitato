<template>
    <div>
        <div class="mb-4 text-left">
            <a @click="updateFaqs" v-show="!loading && lists.length > 0" class="btn btn-green cursor-pointer">ذخیره سوالات</a>
        </div>
        <create v-on:add-faq="addFaq"></create>
        <faq v-for="faq in lists" :faq="faq" v-on:delete-faq="deleteFaq"></faq>

    </div>
</template>

<script>
    import Faq from './Faq';
    import Create from './Create';

    export default {
        props: ['faqs', 'model' , 'id'],

        components: {
            Faq,
            Create,
        },

        data() {
            return {
                lists: [],
                isEditing: false,
                loading: false,
            }
        },
        methods: {
            showForm() {
                this.isEditing = true;
            },
            hideForm() {
                this.isEditing = false;
            },
            deleteFaq(faq) {
                const Index = this.lists.indexOf(faq);
                this.lists.splice(Index, 1);
            },
            addFaq(data) {
                this.lists.push(data);
            },
            updateFaqs() {
                this.loading = true;

                if (this.lists.length > 0) {
                    axios.post('/update-faqs', {
                        'faqs': this.lists,
                        'model': this.model,
                        'id': this.id,
                    }).then(response => {
                        if (response.data.operator) {
                            this.loading = false;
                            toastr.success('با موفقیت ذخیره شد');
                        }
                    });
                }
            },
        },
        created() {
           this.lists = this.faqs.length === 0 ? [] : this.faqs;
        },
    }
</script>
