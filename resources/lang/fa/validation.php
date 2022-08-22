<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    "accepted"         => ":attribute باید پذیرفته شده باشد.",
    "active_url"       => "آدرس :attribute معتبر نیست",
    "after"            => ":attribute باید تاریخی بعد از :date باشد.",
    'after_or_equal' => ':attribute باید برابر یا بعد از تاریخ :date باشد.',
    "alpha"            => ":attribute باید شامل حروف الفبا باشد.",
    "alpha_dash"       => ":attribute باید شامل حروف الفبا و عدد و خظ تیره(-) باشد.",
    "alpha_num"        => ":attribute باید شامل حروف الفبا و عدد باشد.",
    "array"            => ":attribute باید شامل آرایه باشد.",
    "before"           => ":attribute باید تاریخی قبل از :date باشد.",
    'before_or_equal' => ':attribute باید برابر یا بعد از تاریخ :date باشد.',
    'between' => [
        "numeric" => ":attribute باید بین :min و :max باشد.",
        "file"    => ":attribute باید بین :min و :max کیلوبایت باشد.",
        "string"  => ":attribute باید بین :min و :max کاراکتر باشد.",
        "array"   => ":attribute باید بین :min و :max آیتم باشد.",
    ],
    "boolean"          => "The :attribute field must be true or false",
    "confirmed"        => ":attribute با تاییدیه مطابقت ندارد.",
    "date"             => ":attribute یک تاریخ معتبر نیست.",
    'date_equals' => ':attribute باید برابر با تاریخ :date باشد.',
    "date_format"      => ":attribute با الگوی :format مطاقبت ندارد.",
    "different"        => ":attribute و :other باید متفاوت باشند.",
    "digits"           => ":attribute باید :digits رقم باشد.",
    "digits_between"   => ":attribute باید بین :min و :max رقم باشد.",
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    "email"            => "فرمت :attribute معتبر نیست.",
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    "exists"           => ":attribute وارد شده، معتبر نیست.",
    'file' => ':attribute باید یک فایل باشد.',
    'filled' => ':attribute باید یک مقدار داشته باشد.',
    'gt' => [
        'numeric' => ':attribute باید بیشتر از :value باشد.',
        'file' => ':attribute باید بزرگ تر از :value کیلوبایت باشد.',
        'string' => ':attribute باید بیشتر از :value کاراکتر باشد.',
        'array' => ':attribute باید بیشتر از :value آیتم داشته باشد.',
    ],
    'gte' => [
        'numeric' => ':attribute باید بیشتر یا برابر :value باشد.',
        'file' => ':attribute باید بزرگ تر یا برابر :value کیلوبایت باشد.',
        'string' => ':attribute باید بیشتر یا برار :value کاراکتر باشد.',
        'array' => ':attribute باید شامل :value آیتم یا بیشنر باشد.',
    ],
    "image"            => ":attribute باید تصویر باشد.",
    "in"               => ":attribute انتخاب شده، معتبر نیست.",
    "integer"          => ":attribute باید نوع داده ای عددی (integer) باشد.",
    'in_array' => 'The :attribute field does not exist in :other.',
    "ip"               => ":attribute باید IP آدرس معتبر باشد.",
    'ipv4' => ':attribute باید یک آدرس معتبر IPv4 باشد.',
    'ipv6' => ':attribute باید یک ادرس معتبر IPv6 باشد.',
    'json' => ':attribute باید یک رشته Json معتبر باشد.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        "numeric" => ":attribute نباید بزرگتر از :max باشد.",
        "file"    => ":attribute نباید بزرگتر از :max کیلوبایت باشد.",
        "string"  => ":attribute نباید بیشتر از :max کاراکتر باشد.",
        "array"   => ":attribute نباید بیشتر از :max آیتم باشد.",
    ],
    "mimes"            => ":attribute باید یکی از فرمت های :values باشد.",
    'mimetypes' => ":attribute باید یکی از فرمت های :values باشد.",
    'min' => [
        "numeric" => ":attribute نباید کوچکتر از :min باشد.",
        "file"    => ":attribute نباید کوچکتر از :min کیلوبایت باشد.",
        "string"  => ":attribute نباید کمتر از :min کاراکتر باشد.",
        "array"   => ":attribute نباید کمتر از :min آیتم باشد.",
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    "not_in"           => ":attribute انتخاب شده، معتبر نیست.",
    'not_regex' => 'The :attribute format is invalid.',
    "numeric"          => ":attribute باید شامل عدد باشد.",
    'password' => 'پسورد نامعتبر است',
    'present' => 'The :attribute field must be present.',
    "regex"            => ":attribute یک فرمت معتبر نیست",
    "required"         => "فیلد :attribute الزامی است",
    "required_if"      => "فیلد :attribute هنگامی که :other برابر با :value است، الزامیست.",
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    "required_with"    => ":attribute الزامی است زمانی که :values موجود است.",
    "required_with_all"=> ":attribute الزامی است زمانی که :values موجود است.",
    "required_without" => ":attribute الزامی است زمانی که :values موجود نیست.",
    "required_without_all" => ":attribute الزامی است زمانی که :values موجود نیست.",
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    "same"             => ":attribute و :other باید مانند هم باشند.",
    "size"             => array(
        "numeric" => ":attribute باید برابر با :size باشد.",
        "file"    => ":attribute باید برابر با :size کیلوبایت باشد.",
        "string"  => ":attribute باید برابر با :size کاراکتر باشد.",
        "array"   => ":attribute باسد شامل :size آیتم باشد.",
    ),
    "starts_with" => ":attribute باید با :values آغاز شود",
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    "unique"           => ":attribute قبلا انتخاب شده است.",
    "url"              => "فرمت آدرس :attribute اشتباه است.",
    'uploaded' => 'The :attribute failed to upload.',
    'uuid' => ':attribute باید یک UUID معتبر باشد.',
    "exists_code"      => "کد ارسالی در سیستم وجود ندارد",
    "expire_code"      => "اعتبار کد ارسالی به پایان رسیده است",
    "exists_phone"     => "چنین شماره ای در سیستم ثبت نشده است",
    "used"             => "این کد قبلا مورد استفاده قرار گرفته است",
    'phone' => 'لطفا شماره موبایل ایران با فرمت صحیح وارد نمایید',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        "name" => "نام",
        "username" => "شناسه",
        "email" => "ایمیل",
        "first_name" => "نام",
        "last_name" => "نام خانوادگی",
        "password" => "رمز عبور",
        "password_confirmation" => "تاییدیه ی رمز عبور",
        "city" => "شهر",
        "country" => "کشور",
        "address" => "نشانی",
        "phone" => "شماره موبایل",
        "mobile" => "تلفن همراه",
        "age" => "سن",
        "sex" => "جنسیت",
        "gender" => "جنسیت",
        "day" => "روز",
        "month" => "ماه",
        "year" => "سال",
        "hour" => "ساعت",
        "minute" => "دقیقه",
        "second" => "ثانیه",
        "title" => "عنوان",
        "text" => "متن",
        "content" => "محتوا",
        "description" => "توضیحات",
        "excerpt" => "گلچین کردن",
        "date" => "تاریخ",
        "time" => "زمان",
        "available" => "موجود",
        "size" => "اندازه",
        "body" => "متن",
        "bodyReply" => "متن",
        "imageUrl" => "تصویر",
        "videoUrl" => "آدرس ویدیو",
        "slug" => "نامک",
        "tags" => "تگ ها",
        "category" => "دسته",
        "story" => "داستان",
        'number' => 'شماره قسمت',
        'price' => 'مبلغ',
        'course_id' => 'دوره مورد نظر',
        'fileUrl' => 'آدرس فایل',
        'enSlug' => 'نامک انگلیسی',
        'percent' => 'درصد',
        'discount_code' => 'کد تخفیف',
        'priority' => 'اولویت',
        'product' => 'آیتم خریداری شده',
        'file' => 'فایل',
        'type' => 'نوع',
        'id' => 'انتخاب آیتم',
        'department' => 'دپارتمان',
        'fa_title' => 'عنوان',
        'en_title' => 'عنوان لاتین',
        'h1' => 'عنوان سئو',
        'icon' => 'آیکون',
        'image' => 'تصویر',
        'code' => 'کد',
        'discount' => 'درصد تخفیف',
        'start_at' => 'تاریخ آغاز',
        'end_at' => 'تاریخ پایان',
        'user_id' => 'کاربر(صاحب اثر)',
        'domain' => 'آدرس دامنه',
        'author_name' => 'نام فروشگاه',
        'author_slug' => 'آدرس فروشگاه',
        'card_name' => 'نام صاحب حساب',
        'card_meli' => 'کد ملی صاحب حساب',
        'bank_name' => 'نام بانک',
        'card_number' => 'شماره کارت',
        'card_serial' => 'شماره کارت',
        'card_sheba' => 'شماره شبا',
        'files' => 'فایل ها',
        'desired' => 'مبلغ قابل برداشت',
        'mini_cover' => 'تصویر کوچک',
        'cover' => 'کاور اول',
        'cover2' => 'کاور دوم',
        'demo' => 'دمو',
        'version' => 'نسخه',
        'access' => 'نوع لایسنس',
        'main_file' => 'فایل اصلی',
        'cash_file' => 'فایل لایسنس نقدی',
        'subscribe_file' => 'فایل لایسنس اشتراک',
        'help_file' => 'فایل راهنما',
        'cash' => 'نقدی',
        'subscribe' => 'اشتراک',
        'full' => 'کامل',
        'expireDescription' => 'توضیحات',
        'expire_at' => 'تاریخ انقضا',
        'off' => 'قیمت تخفیف',
        'products' => 'محصولات',
        'message' => 'پیام',
    ],

];
