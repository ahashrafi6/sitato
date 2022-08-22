// global alert
Livewire.on('success-alert', postId => {
    toastr.success('عملیات با موفقیت انجام شد');
});
Livewire.on('fail-alert', postId => {
    toastr.error('خطایی رخ داد! مجدد تلاش کنید');
});
Livewire.on('trial-licence-exist', postId => {
    toastr.error('قبلا برای این دامنه لایسنس دریافت کردید و قادر به دریافت لایسنس آزمایشی نیستید');
});
Livewire.on('verify-code-send', postId => {
    toastr.success('کد تایید به شماره موبایل شما ارسال شد، تا دریافت صبور باشید');
});
Livewire.on('verify-code-wrong', postId => {
    toastr.error('کد تایید وارد شده اشتباه است');
});
Livewire.on('comment-send', postId => {
    toastr.success('با موفقیت ثبت شد و پس از تایید نمایش داده خواهد شد');
});
Livewire.on('like-success', postId => {
    toastr.success('امتیاز شما با موفقیت ثبت شد');
});
Livewire.on('auth-require', postId => {
    toastr.warning('ابتدا باید وارد حساب کاربری خود شوید');
});
Livewire.on('like-exist', postId => {
    toastr.warning('قبلا امتیاز خود را ثبت کرده اید');
});
