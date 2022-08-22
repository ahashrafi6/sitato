<template>
    <div class='card'>
        <div class="p-2" v-show="!isEditing">
            <h5> {{ product.product_id[0].label }} </h5>

            <a class="btn btn-success text-white" @click="showForm">
                        ویرایش
           </a>
           <a class="btn btn-danger text-white" @click="deleteProduct(product)">
                        حذف
            </a>
        </div>

        <div v-show="isEditing">

               <div class="col-12 col-sm-6">

                <label>محصولات مرتبط</label>
                <v-select multiple v-model="product.product_id" label="label" dir="rtl" @search="searchProduct" :options="products" :filterable="false"
                        placeholder="نام محصول را جستجو کنید...">
                </v-select>

             </div>

            <div class="col-12 mb-3">
                      <input class="form-control" v-model="product.discount" placeholder="درصد تخفیف"></input>
            </div>
       

                    <a class="btn btn-success text-white" @click="hideForm">
                        ویرایش
                    </a>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['product'],

        data() {
            return {
                isEditing: false,

                products: [],
            };
        },
        methods: {
            searchProduct(search, loading) {
            if (search.length === 3) {
                loading(true);
                axios.post('/dashboard/products-search-vue', {
                    'q': search,
                }).then(response => {
                    this.products = response.data.items;
                    loading(false);
                }).catch(error => {
                    console.log('خطا در جستجو محصولات')
                });
            }
        },

            showForm() {
                this.isEditing = true;
            },
            hideForm() {
                this.isEditing = false;
            },
            deleteProduct(product) {
                this.$emit('delete-product', product);
            },
        },
    };
</script>