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
                                    <option v-for="item in type_lists" :value="item.value">
                                        {{ item.text }}
                                    </option>
                                </select>
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
    props: ['id' , 'per_cash' , 'per_subscribe' , 'cash', 'subscribe', 'minute' , 'type'],

    data() {
        return {
              type_lists: [
                { text: 'بروزرسانی فروش', value: 'cash' },
                { text: 'بروزرسانی اشتراک', value: 'subscribe' },
                { text: 'بروزرسانی هردو', value: 'both' },
            ],

            create_form: new Form({
                cash: '',
                subscribe: '',
                per_cash: '',
                per_subscribe: '',
                minute: '',
                type: '',
            }),
        }
    },
    methods: {
        store() {
            this.create_form.patch(`/dashboard/fakeproducts/${this.id}`).then(({data}) => {
                if (data.operator) {
                    window.location = '/dashboard/fakeproducts';
                }
            });
        },

    },
    created() {
        this.create_form.per_cash = this.per_cash;
        this.create_form.per_subscribe = this.per_subscribe;
        this.create_form.cash = this.cash;
        this.create_form.subscribe = this.subscribe;
        this.create_form.type = this.type;
        this.create_form.minute = this.minute;
    },
}
</script>
