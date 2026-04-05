<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Everything delivered in a minutes in all cities clickIt App </title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- main css -->
    <link rel='stylesheet' type='text/css' media='screen' href="{{asset('user/css/style.css')}}">
    <!-- icons cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- tailwinds js  -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- modal js -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
</head>

<body>
    <!-- clickIt header here -->
    <section id="clickIt-header" class="sticky top-0 z-10 bg-white shadow">
        <!-- HEADER BAR -->
        <div class="flex items-center justify-between p-4 md:grid md:grid-cols-4">
            <!-- LOGO -->
            <div class="flex items-center justify-between w-full md:w-auto">
                <h1 class="text-5xl font-extrabold animate-bounce">
                    <a href="/"><span class="text-yellow-500">Click</span>
                        <span class="text-green-500">IT</span></a>
                </h1>
                <!-- MOBILE TOGGLER -->
                <button
                    id="menu-btn" F
                    class="md:hidden text-3xl"
                    onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                    ☰
                </button>
            </div>

            <!-- DELIVERY (DESKTOP) -->
            <div class="hidden md:flex items-center">
                <button
                    type="button"
                    command="show-modal"
                    commandfor="dialog2"
                    class="text-xl font-medium">
                    Delivery in 8 minutes
                </button>
            </div>

            <!-- SEARCH (DESKTOP) -->
            <div class="hidden md:flex">
                <input
                    type="text"
                    placeholder="Search products here..."
                    class="border-2 border-gray-300 rounded-3xl w-full p-2" />
            </div>
            <!-- LOGIN & CART (DESKTOP) -->
            <div class="hidden md:flex gap-4 items-center ms-20">
                <button
                    type="button"
                    command="show-modal"
                    commandfor="dialog1"
                    class="text-xl font-bold">
                    Login
                </button>
                <button
                    type="button"
                    class="p-3 bg-gray-400 rounded-2xl text-white font-bold">
                    <span class="bi bi-cart3"></span> My Cart
                </button>
            </div>
        </div>

        <!-- MOBILE MENU -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200 p-4 space-y-4">
            <!-- DELIVERY -->
            <button
                type="button"
                command="show-modal"
                commandfor="dialog2"
                class="block text-lg font-medium">
                Delivery in 8 minutes
            </button>

            <!-- SEARCH -->
            <input
                type="text"
                placeholder="Search products here..."
                class="border-2 border-gray-300 rounded-3xl w-full p-2" />

            <!-- LOGIN -->
            <button
                type="button"
                command="show-modal"
                commandfor="dialog1"
                class="block text-lg font-bold">
                Login
            </button>
            <!-- CART -->
            <button
                type="button"
                class="w-full p-3 bg-gray-400 rounded-2xl text-white font-bold">
                <span class="bi bi-cart3"></span> My Cart
            </button>
        </div>
    </section>
   
    <!-- clickIt content & banner here  -->
     @yield('content')    
    <footer class="bg-gray-50 border-t border-gray-200 relative">
        <div class="max-w-7xl mx-auto px-4 py-12">

            <!-- Top Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8 text-sm text-gray-700">

                <!-- Logo & Description -->
                <div class="col-span-2">
                    <h2 class="text-2xl font-bold text-green-600">clickIT</h2>
                    <p class="mt-3 text-gray-600 leading-relaxed">
                        clickIT delivers groceries and essentials in minutes. Fast, reliable, and affordable.
                    </p>
                </div>

                <!-- Useful Links -->
                <div>
                    <h3 class="font-semibold text-gray-900 mb-3">Useful Links</h3>
                    <ul class="space-y-2">
                        <li><a href="/about" class="hover:text-green-600">About Us</a></li>
                        <li><a href="/career" class="hover:text-green-600">Careers</a></li>
                        <li><a href="/blogs" class="hover:text-green-600">Blog</a></li>
                        <li><a href="/faq" class="hover:text-green-600">FAQs</a></li>
                    </ul>
                </div>

                <!-- Categories -->
                <div>
                    <h3 class="font-semibold text-gray-900 mb-3">Categories</h3>
                    <ul class="space-y-2">
                        <li><a href="products.html" class="hover:text-green-600">Fruits & Vegetables</a></li>
                        <li><a href="products.html" class="hover:text-green-600">Dairy & Bakery</a></li>
                        <li><a href="products.html" class="hover:text-green-600">Snacks & Beverages</a></li>
                        <li><a href="404.html" class="hover:text-green-600">Personal Care</a></li>
                    </ul>
                </div>

                <!-- Policies -->
                <div>
                    <h3 class="font-semibold text-gray-900 mb-3">Policies</h3>
                    <ul class="space-y-2">
                        <li><a href="/privacy" class="hover:text-green-600">Privacy Policy</a></li>
                        <li><a href="/terms" class="hover:text-green-600">Terms & Conditions</a></li>
                        <li><a href="/404" class="hover:text-green-600">Refund Policy</a></li>
                        <li><a href="/404" class="hover:text-green-600">Security</a></li>
                    </ul>
                </div>

                <!-- App & Social -->
                <div>
                    <h3 class="font-semibold text-gray-900 mb-3">Connect With Us</h3>

                    <!-- Social Icons -->
                    <div class="flex space-x-4 mb-4">
                        <a href="#" class="text-gray-500 hover:text-green-600">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-green-600">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-green-600">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-green-600">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>

                    <!-- App Buttons -->
                    <div class="space-y-2">
                        <button class="w-full bg-black text-white py-2 rounded-lg text-xs">
                            Download on App Store
                        </button>
                        <button class="w-full bg-black text-white py-2 rounded-lg text-xs">
                            Get it on Google Play
                        </button>
                    </div>
                </div>

                <!-- Google Translate -->
                @yield('google_translate')

            </div>

            <!-- Divider -->
            <div class="border-t border-gray-200 mt-10 pt-6">
                <!-- Bottom Bar -->
                <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-500 gap-3">
                    <p>© 2025 clickIT. All rights reserved.</p>
                    <p>Made with ❤️ in India</p>
                </div>
            </div>
        </div>

        <!-- Fixed WhatsApp Button -->
        <a href="https://wa.me/+919998003879" target="_blank" class="fixed bottom-6 right-6 bg-green-600 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-lg animate-bounce z-50 hover:bg-green-700">
            <i class="bi bi-whatsapp text-xl text-white"></i>
        </a>

    </footer>

    <!-- Google Translate Script -->
    <!-- Google Translate script -->
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                    pageLanguage: 'en', // source language
                    includedLanguages: '', // empty = all languages
                    layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL
                },
                'google_translate_element'
            );
        }
    </script>

    <script
        type="text/javascript"
        src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>


    <!-- clickIt login modal  -->
    <el-dialog>
        <dialog id="dialog1" aria-labelledby="dialog-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
            <el-dialog-backdrop class="fixed inset-0 bg-gray-500/75 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></el-dialog-backdrop>

            <div tabindex="0" class="flex min-h-full items-end justify-center p-4 text-center focus:outline-none sm:items-center sm:p-0 -mt-15">
                <el-dialog-panel class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:w-full sm:max-w-lg data-closed:sm:translate-y-0 data-closed:sm:scale-95">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="mt-3 text-center">
                            <h2 class="p-3 bg-amber-500 rounded-4xl w-30 text-white text-center mx-auto text-2xl">clickIt</h2>
                            <h3 class="text-2xl font-bold text-gray-900 text-center">India's last minute app <br />
                                <span class="font-light">Log in or Sign up</span>
                            </h3>
                            <div class="mt-2 p-8">
                                <form>
                                    <div class="mb-3">
                                        <input type="text" placeholder="Enter a mobile for Login *" class="w-full border border-2 border-gray-300 p-3 rounded-2xl">
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" value="Continue" class="bg-gray-600 text-white w-full p-3 rounded-2xl">
                                    </div>
                                    <p>By continuing, you agree to our Terms of service & Privacy policy</p>
                                </form>
                            </div>
                        </div>
                    </div>

                </el-dialog-panel>
            </div>
        </dialog>
    </el-dialog>

    <!-- change location or detect location modal -->
    <el-dialog>
        <dialog id="dialog2" aria-labelledby="dialog-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
            <el-dialog-backdrop class="fixed inset-0 bg-gray-500/75 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></el-dialog-backdrop>

            <div tabindex="0" class="w-180 mt-25 ms-5  justify-center p-4 text-center focus:outline-none sm:items-center sm:p-0">

                <el-dialog-panel class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:w-full sm:max-w-lg data-closed:sm:translate-y-0 data-closed:sm:scale-95">

                    <div class="bg-white px-0 pt-0 pb-0 sm:p-6 sm:pb-4">
                        <div class="mt-3 text-center">
                            <h2 class="p-0  rounded-4xl w-30 text-white ms-3">Change location</h2>
                            <div class="mt-2 p-0">
                                <form>
                                    <div class="mb-3 flex">
                                        <button type="button" class="bg-green-600 text-white w-70 p-3 rounded-xl">Detect my location</button>-<span class="p-2 rounded-full border-2 bg-gray-100">OR</span>-
                                        <button type="button" class="bg-gray-400 text-white w-70 p-3">Search Delivery location</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </el-dialog-panel>
            </div>
        </dialog>
    </el-dialog>
    <!-- clickIt Register modal  -->
    <!-- clickIt forget password modal  -->
</body>

</html>