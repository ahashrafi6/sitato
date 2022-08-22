<template>
    <div class="col-12 my-4">
        <label><h4 class="d-inline-block ml-2">محصولات پکیج</h4><a @click="updateProduct"
                                                                    v-show="!loading && lists.length > 0"
                                                                    class="btn btn-warning text-white">
            ذخیره
        </a>
            <a v-show="!loading" @click="deleteProduct" class="btn btn-secondary text-white">
                حذف کامل
            </a>
            <span>{{ message }}</span>
        </label>
        <product v-for="product in lists" :product="product" v-on:delete-product="deleteProduct"></product>
        <create v-on:add-product="addProduct"></create>
    </div>
</template>

<script>
    import Product from './Product';
    import Create from './Create';

    export default {
        props: ['products', 'model' , 'id'],

        components: {
            Product,
            Create,
        },

        data() {
            return {
                lists: [],
                isEditing: false,
                loading: false,
                message: '',
            }
        },
        methods: {
            showForm() {
                this.isEditing = true;
            },
            hideForm() {
                this.isEditing = false;
            },
            deleteProduct(product) {
                const Index = this.lists.indexOf(product);
                this.lists.splice(Index, 1);
            },
            addProduct(data) {
                this.lists.push(data);
            },
            updateProduct() {
                this.loading = true;
                this.message = "در حال آپدیت...";

                if (this.lists.length > 0) {
                    axios.post('/dashboard/update-bundle', {
                        'products': this.lists,
                        'model': this.model,
                        'id': this.id,
                    }).then(response => {
                        if (response.data.operator) {
                            this.loading = false;
                            this.message = "ذخیره شد!";
                        }
                    });
                }
            },
            deleteProduct() {
                this.loading = true;
                this.message = "در حال حذف...";

                axios.post('/dashboard/delete-bundle', {
                    'model': this.model,
                    'id': this.id,
                }).then(response => {
                    if (response.data.operator) {
                        this.products = [];
                        this.lists = [];
                        this.loading = false;
                        this.message = "حذف شد!";
                    }
                });
            }
        },
        created() {
           this.lists = this.products.length === 0 ? [] : this.products;
        },
    }
</script>