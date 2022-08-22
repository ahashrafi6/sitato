<template>
    <div class="card p-3">
        <div>
            <a class="btn btn-primary text-white" @click="openForm" v-show="!isCreating">
                محصول جدید
            </a>
        </div>
        <div v-show="isCreating">

             <div class="col-12 col-sm-6">

                <label>محصولات مرتبط</label>
                <v-select multiple v-model="product_id" label="label" dir="rtl" @search="searchProduct" :options="products" :filterable="false"
                        placeholder="نام محصول را جستجو کنید...">
                </v-select>

             </div>

            <div class="col-12 mb-3">
                <input class="form-control" v-model="discount" placeholder="درصد تخفیف"></input>
            </div>
       

            <a class="btn btn-success text-white" @click="sendForm">
                ایجاد
            </a>
            <a class="btn btn-danger text-white" @click="closeForm">
                لغو
            </a>

        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                product_id: '',
                discount: '',
                isCreating: false,

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

            openForm() {
                this.isCreating = true;
            },
            closeForm() {
                this.isCreating = false;
            },
            sendForm() {
                if (this.product_id.length > 0 && this.discount.length > 0) {
                    const product_id = this.product_id;
                    console.log(product_id)
                    const discount = this.discount;
                    const data = {
                        product_id,
                        discount
                    };
                    this.$emit('add-product', data);
                    this.product = '';
                    this.discount = '';
                }
                this.isCreating = false;
            },
        },
    };
</script>