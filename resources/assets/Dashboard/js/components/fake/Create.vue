<template>
    <section>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <alert-error v-for="item in create_form.errors.all()" :key="item[0]" :form="create_form">{{ item[0] }}</alert-error>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label>تعداد فروش</label>
                                    <input v-model="create_form.cash" name="cash" type="text" class="form-control text-left"
                                           placeholder="تعداد" required dir="ltr">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label>تعداد اشتراک</label>
                                    <input v-model="create_form.subscribe" name="subscribe" type="text" class="form-control text-left"
                                           placeholder="تعداد" required dir="ltr">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label>واحد فروش</label>
                                    <input v-model="create_form.per_cash" name="per_cash" type="text" class="form-control text-left"
                                           placeholder="واحد" required dir="ltr">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label>واحد اشتراک</label>
                                    <input v-model="create_form.per_subscribe" name="per_subscribe" type="text" class="form-control text-left"
                                           placeholder="واحد" required dir="ltr">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label>بازه بروزرسانی به دقیقه</label>
                                    <input v-model="create_form.minute" name="minute" type="text" class="form-control text-left"
                                           placeholder="دقیقه" required dir="ltr">
                                </div>
                            </div>
                        </div>
                   
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>نوع</label>
                                <select name=type required class="form-control" v-model="create_form.type">
                                    <option v-for="item in type" :value="item.value">
                                        {{ item.text }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label>محصول مرتبط</label>
                                    <v-select v-model="create_form.product_id" label="label" dir="rtl" @search="searchProduct" :options="products" :filterable="false"
                                              placeholder="نام محصول را جستجو کنید...">
                                    </v-select>
                                </div>
                            </div>
                        </div>


                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                            <button type="submit" @click="store" :disabled="create_form.busy" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">
                                ایجاد
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {

    data() {
        return {
            type: [
                { text: 'بروزرسانی فروش', value: 'cash' },
                { text: 'بروزرسانی اشتراک', value: 'subscribe' },
                { text: 'بروزرسانی هردو', value: 'both' },
            ],

            products: [],

            create_form: new Form({
                cash: '',
                dubdcribe: '',
                per_cash: '',
                per_subscribe: '',
                minute: '',
                type: '',
                product_id: '',
            }),
        }
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

        store() {
            this.create_form.post('/dashboard/fakeproducts').then(({data}) => {
                if (data.operator) {
                    window.location = '/dashboard/fakeproducts';
                }
            });
        }
    },
}
</script>
