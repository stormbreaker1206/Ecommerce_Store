<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Acme Store - @yield('title')</title>
    <link rel="stylesheet" href="/css/all.css">
    <script src="https://use.fontawesome.com/45b0e255c2.js"></script>
    <script src="https://unpkg.com/vue"></script>


</head>

<body data-page-id="@yield('data-page-id')">



    @yield('body')
</div>

<script src="/js/all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/foundation-sites@6.5.0-rc.3/dist/js/foundation.min.js" integrity="sha256-l1HhyJ0nfWQPdwsVJLNq8HfZNb3i1R9M82YrqVPzoJ4= sha384-NH8utV74bU+noXiJDlEMZuBe34Bw/X66sw22frHkgIs8R1QKWc8ckxYB4DheLjH4 sha512-JMs3Y+JjY+DhwVOPeJhkLM/0FeK9ANxvuYiHGpGp7Q2kMlmNEN/2v6TkrXdirxqB3DHxPlQ8iMxvb/eSPCF5CA==" crossorigin="anonymous"></script>

<script>

    $(document).foundation();

</script>

@yield('stripe-checkout')
@yield('paypal-checkout')
</body>

</html>
