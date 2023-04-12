<title>{{ $title ?: setting_get("website.defaultWebTitle") }}</title>
<meta charset="UTF-8">
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="author" content="arhamroshanar">
<meta name="csrf-token" content="{{ csrf_token() }}">

<!--Meta Tags-->
<meta name="title" content="{{ $metaTitle ?? "today coupons" }}">
<meta name="keywords" content="{{ $metaKeywords ?? "todaycoupon,todaycoupons.com" }}">
<meta name="description" content="{{ $metaDescription ?? "Today Coupon has a best coupons ever" }}">
<meta name="verify-admitad" content="2654948e1c"/>
<meta name="verify-tradedoubler" content="3272097" />
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-2S3JDTLTKY"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'G-2S3JDTLTKY');
</script>
