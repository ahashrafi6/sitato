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
                                <label>وضعیت</label>
                                <select name="status" required class="form-control" v-model="create_form.status">
                                    <option v-for="item in type_status" :value="item.value">
                                        {{ item.text }}
                                    </option>
                                </select>
                            </div>
                        </div>


                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label>قیمت تخفیف</label>
                                    <input v-model="create_form.price" name="price" type="text" class="form-control text-left"
                                           placeholder="قیمت" required dir="ltr">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label>ظرفیت کل</label>
                                    <input v-model="create_form.capacity" name="capacity" type="text" class="form-control text-left"
                                           placeholder="تعداد ظرفیت کل" required dir="ltr">
                                </div>
                            </div>
                        </div>


                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label>تاریخ شروع</label>
                                    <date-picker placeholder="انتخاب تاریخ" locale="fa,en" format="YYYY-M-D HH:mm" v-model="create_form.start_at" name="start" type="datetime"></date-picker>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label>تاریخ انقضا</label>
                                    <date-picker placeholder="انتخاب تاریخ" locale="fa,en" format="YYYY-M-D HH:mm" v-model="create_form.expire_at" name="expire" type="datetime"></date-picker>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                            <button type="submit" @click="store" :disabled="create_form.busy" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">
                                ویرایش
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
    props: ['slug' , 'price' , 'status' , 'start_at' , 'expire_at' , 'capacity'],

    data() {
        return {
            type_status: [
                { text: 'غیر فعال', value: '0' },
                { text: 'فعال', value: '1' },
            ],

            create_form: new Form({
                price: '',
                status: '',
                start_at: '',
                expire_at: '',
                capacity: '',
            }),
        }
    },
    methods: {
        store() {
            this.create_form.patch(`/dashboard/products/${this.slug}/amazing`).then(({data}) => {
                if (data.operator) {
                    window.location = '/dashboard/products';
                }
            });
        },

    },
    created() {
        this.create_form.price = this.price;
        this.create_form.status = this.status;
        this.create_form.start_at = this.start_at;
        this.create_form.expire_at = this.expire_at;
        this.create_form.capacity = this.capacity;
    },
}
</script>
