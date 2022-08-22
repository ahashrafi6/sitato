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
                                    <label>عنوان</label>
                                    <input v-model="create_form.title" name="title" type="text" class="form-control text-left"
                                           placeholder="عنوان" required dir="ltr">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label>کد تخفیف</label>
                                    <input v-model="create_form.code" name="code" type="text" class="form-control text-left"
                                           placeholder="کد" required dir="ltr">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label>درصد تخفیف</label>
                                    <input v-model="create_form.discount" name="discount" type="text" class="form-control" placeholder="درصد"
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label>ظرفیت کل</label>
                                    <input v-model="create_form.capacity" name="capacity" type="text" class="form-control" placeholder="ظرفیت کل">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label>ظرفیت برای هر کاربر</label>
                                    <input v-model="create_form.capacity_per_user" name="capacity_per_user" type="text" class="form-control"
                                           placeholder="ظرفیت برای هر کاربر">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>نوع</label>
                                <select name=type required class="form-control" v-model="create_form.type">
                                    <option v-for="item in type_lists" :value="item.value">
                                        {{ item.text }}
                                    </option>
                                </select>
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
    props: ['id' , 'title' , 'code' , 'discount' , 'capacity' , 'capacity_per_user' , 'type' , 'start_at' , 'expire_at'],

    data() {
        return {
            type_lists: [
                { text: 'تخفیف سبد خرید', value: 'cash' },
                { text: 'تخفیف اشتراک', value: 'subscribe' },
            ],

            create_form: new Form({
                title: '',
                code: '',
                discount: '',
                capacity: '',
                capacity_per_user: '',
                type: '',
                start_at: '',
                expire_at: '',
            }),
        }
    },
    methods: {
        store() {
            this.create_form.patch(`/dashboard/discounts/${this.id}`).then(({data}) => {
                if (data.operator) {
                    window.location = '/dashboard/discounts';
                }
            });
        },

    },
    created() {
        this.create_form.title = this.title;
        this.create_form.type = this.type;
        this.create_form.code = this.code;
        this.create_form.discount = this.discount;
        this.create_form.capacity = this.capacity;
        this.create_form.capacity_per_user = this.capacity_per_user;
        this.create_form.start_at = this.start_at;
        this.create_form.expire_at = this.expire_at;
    },
}
</script>
