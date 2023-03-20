<!DOCTYPE html>
<html>

<head>
    <x-app.master />

</head>
<style>
    body {
        overflow: hidden;
    }
</style>

<div class="container-fluid dashboard mx-auto bg-light transition-all ease-in-out delay-500">
    <div class="row">
        <div class="col-md-12">
            <div class="p-5 overflow-auto" style="max-height: 100vh;">

                <header class="p-3 mb-3 border-bottom">
                    <div class="container">
                        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                            <a href="/"
                                class="d-flex display-6 align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                                XM
                            </a>
                        </div>
                    </div>
                </header>

                @yield('content')
            </div>
        </div>
    </div>
</div>


</body>

</html>
